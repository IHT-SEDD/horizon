<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sales.index');
    }

    public function datatable(Request $request, $model)
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
