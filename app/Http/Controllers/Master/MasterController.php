<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\ModelResolver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class MasterController extends Controller
{
    protected ModelResolver $resolver;

    public function __construct(ModelResolver $resolver)
    {
        $this->resolver = $resolver;
    }

    public function index($model)
    {
        $viewpath = 'masters.' . $model;
        $modelName = Str::headline($model);
        return view($viewpath, compact('modelName', 'model'));
    }

    public function datatable(Request $request, $model)
    {
        try {
            $modelClass = $this->resolver->resolve($model);

            if (!class_exists($modelClass)) {
                return response()->json(['error' => 'Model not found.'], 404);
            }

            $dataRelations = request()->input('with', []);

            $data = $modelClass::query();

            if (!empty($dataRelations)) {
                $data->with($dataRelations);
            }

            return DataTables::of($data)->make(true);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request, $model)
    {
        DB::beginTransaction();
        try {
            $modelClass = $this->resolver->resolve($model);

            $validator = $modelClass::validate($request);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $modelClass::create($validator->validated());

            DB::commit();

            return response()->json([
                'message' => $model . ' data added successfully!'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            
            return response()->json([
                'message' => 'Theres an error on our side',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function select($model)
    {
        try {
            $modelClass = $this->resolver->resolve($model);

            if (!class_exists($modelClass)) {
                return response()->json(['error' => 'Model not found.'], 404);
            }

            $query = $modelClass::select('id', 'name');

            if ($model === 'tax') {
                $query = $modelClass::select('id', 'name', 'value');
            }

            $table = (new $modelClass)->getTable();

            if (Schema::hasColumn($table, 'is_active')) {
                $query->where('is_active', 1);
            }

            $data = $query->get();

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
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
