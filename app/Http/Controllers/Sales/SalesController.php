<?php

namespace App\Http\Controllers\Sales;

use App\Exports\SalesOrderExport;
use App\Http\Controllers\Controller;
use App\Services\SalesOrderService;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesProduct;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\DataTables;

class SalesController extends Controller
{
    public function index()
    {
        return view('sales.index');
    }

    public function datatable(Request $request)
    {
        try {
            $dataRelations = request()->input('with', []);

            $data = Sales::query();

            if (!empty($dataRelations)) {
                $data->with($dataRelations);
            }

            return DataTables::of($data)->make(true);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function newSalePage()
    {
        return view('sales.new-sale');
    }

    public function getProductDetail(Request $request)
    {
        // dd($request->all());
        $ids = $request->input('ids');

        if (!is_array($ids)) {
            return response()->json(['error' => 'Invalid data format'], 422);
        }

        $products = Product::with(['category', 'unit'])->whereIn('id', $ids)->get();

        $details = $products->keyBy('id');

        return response()->json($details);
    }

    public function insertSalesOrder(Request $request)
    {
        DB::beginTransaction();

        try {
            // dd($request->all());
            $user = Auth::user();
            $salesData = $request->input('form_step_1.sales_order');
            $products = $request->input('form_step_2.products');

            $salesValidator = Sales::validate($salesData);
            $salesProductValidator = SalesProduct::validate($products);

            if ($salesValidator->fails()) {
                return response()->json([
                    'errors' => $salesValidator->errors()
                ], 422);
            }
            if ($salesProductValidator->fails()) {
                return response()->json([
                    'errors' => $salesProductValidator->errors()
                ], 422);
            }

            $date = now();
            $prefix = 'SO' . $date->format('dmy');
            $year = $date->year;

            $latestSales = Sales::whereYear('created_at', $year)
                ->where('quotation_number', 'like', "SO%")
                ->orderBy('id', 'desc')
                ->first();

            if ($latestSales && preg_match('/SO\d{6}-(\d{4})/', $latestSales->quotation_number, $matches)) {
                $lastNumber = (int) $matches[1];
                $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '0001';
            }

            $quotationNumber = $prefix . '-' . $nextNumber;

            $salesOrder = Sales::create([
                'quotation_number' => $quotationNumber,
                'customer_id' => $salesData['customer_id'],
                'payment_term_id' => $salesData['payment_term_id'],
                'created_by' => $user->id,
                'untaxed_amount' => $salesData['untaxed_amount'],
                'tax_amount' => $salesData['tax_amount'],
                'grand_total' => $salesData['total_amount'],
                'description' => $salesData['description'] ?? null,
                'expiration_date' => $salesData['expiration_date'],
                'status' => 'quotation',
            ]);

            foreach ($products as $product) {
                SalesProduct::create([
                    'sales_id' => $salesOrder->id,
                    'product_id' => $product['id'],
                    'tax_id' => $product['tax_id'],
                    'discount' => $product['discount'],
                    'quantity' => $product['quantity'],
                    'tags' => $product['product_detail']['type'],
                    'subtotal' => $product['subtotal'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Sales order data added successfully!'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Theres an error on our side',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function detailSalesOrderPage()
    {
        return view('sales.detail');
    }

    public function detailSalesOrder($id)
    {
        try {
            $data = Sales::with(['customers', 'paymentTerms'])
                ->select('id', 'quotation_number', 'customer_id', 'payment_term_id', 'confirmation_date', 'expiration_date', 'status', 'description', 'untaxed_amount', 'tax_amount', 'grand_total')
                ->findOrFail($id);

            return response()->json([
                'message' => 'Sales order data fetched successfully!',
                'sales_order' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Theres an error on our side',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function dtSalesOrderProduct($id)
    {
        try {
            $dataRelations = request()->input('with', []);

            $data = SalesProduct::where('sales_id', $id)->get();

            if (!empty($dataRelations)) {
                $data->with($dataRelations);
            }

            return DataTables::of($data)->make(true);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function printSalesOrder($id)
    {
        DB::beginTransaction();

        try {
            $sales = Sales::with(['salesProducts', 'customers', 'paymentTerms'])->findOrFail($id);

            if (!in_array($sales->status, [Sales::STATUS_QUOTATION, Sales::STATUS_CONFIRMED])) {
                DB::rollBack();
                return response()->json(['message' => 'Cannot print. Because this sales order has been: ' . $sales->status], 400);
            }

            return view('prints.sales.' . strtolower($sales->status), [
                'sales' => $sales,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Theres an error on our side',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function exportSalesOrder(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $type = $request->query('type');
            $sales = Sales::with(['salesProducts', 'customers', 'paymentTerms'])->findOrFail($id);

            if (!in_array($sales->status, [Sales::STATUS_QUOTATION, Sales::STATUS_CONFIRMED])) {
                DB::rollBack();
                return response()->json(['message' => 'Sales order cannot to export'], 400);
            }

            DB::commit();

            if ($type === 'pdf') {
                return Pdf::view('exports.pdf.sales.' . strtolower($sales->status), compact('sales'))
                    ->name(strtoupper($sales->status) . '_SALES_ORDER_' . $sales->quotation_number . '.pdf')
                    ->download();
            }

            if ($type === 'excel') {
                return Excel::download(new SalesOrderExport($sales), strtoupper($sales->status) . '_SALES_ORDER_' . $sales->quotation_number . '.xlsx');
            }

            return response()->json(['message' => 'Invalid export type.'], 400);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Theres an error on our side',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function confirmSalesOrder($id, SalesOrderService $service)
    {
        DB::beginTransaction();

        try {
            $sales = Sales::findOrFail($id);
            $updated = $service->updateStatus($sales, Sales::STATUS_CONFIRMED);

            DB::commit();

            return response()->json([
                'message' => 'Sales order confirmed successfully!',
                'data' => [
                    'id' => $updated->id,
                    'status' => $updated->status,
                    'confirmation_date' => $updated->confirmation_date,
                ],
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'Theres an error on our side',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function cancelSalesOrder($id, SalesOrderService $service)
    {
        DB::beginTransaction();

        try {
            $sales = Sales::findOrFail($id);
            $updated = $service->updateStatus($sales, Sales::STATUS_CANCELED);

            DB::commit();

            return response()->json([
                'message' => 'Sales order canceled successfully!',
                'data' => [
                    'id' => $updated->id,
                    'status' => $updated->status,
                ],
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'There was an error',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function lockSalesOrder($id, SalesOrderService $service)
    {
        DB::beginTransaction();

        try {
            $sales = Sales::findOrFail($id);
            $updated = $service->updateStatus($sales, Sales::STATUS_LOCKED);

            DB::commit();

            return response()->json([
                'message' => 'Sales order locked successfully!',
                'data' => [
                    'id' => $updated->id,
                    'status' => $updated->status,
                ],
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'message' => 'There was an error',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}
