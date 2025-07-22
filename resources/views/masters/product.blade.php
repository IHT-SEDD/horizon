@extends('layouts.master')

@section('table')
<x-datatable>
  <th>No</th>
  <th>Name</th>
  <th>Brand / Manufacturer</th>
  <th>Type</th>
  <th>Category</th>
  <th>Unit</th>
  <th>Price</th>
  <th>Created At</th>
</x-datatable>
@endsection

@section('form')
<div class="flex flex-col w-full justify-start items-center gap-3">
  <!-- Name -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} name <span class="text-error text-sm">*</span></span>
    </div>
    <input name="name" type="text" placeholder="Input {{ $modelName }} name"
      class="input input-bordered input-md w-full max-w-full" />
  </label>

  <!-- Brand -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} brand / manufacturer <span
          class="text-error text-sm">*</span></span>
    </div>
    <input name="brand" type="text" placeholder="Input {{ $modelName }} brand / manufacturer"
      class="input input-bordered input-md w-full max-w-full" />
  </label>

  <!-- Type -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} type <span class="text-error text-sm">*</span></span>
    </div>
    <input name="type" type="text" placeholder="Input {{ $modelName }} type"
      class="input input-bordered input-md w-full max-w-full" />
  </label>

  <!-- Category -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} Category <span class="text-error text-sm">*</span></span>
    </div>
    <select class="w-full max-w-full tom-select" id="select-one-category" name="product_category_id"></select>
  </label>

  <!-- Unit -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} Unit <span class="text-error text-sm">*</span></span>
    </div>
    <select class="w-full max-w-full tom-select" id="select-one-unit" name="product_unit_id"></select>
  </label>

  <!-- Price -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} Sales Price <span class="text-error text-sm">*</span></span>
    </div>
    <input name="sales_price" id="input_price" type="text" placeholder="Input {{ $modelName }} sales price"
      class="input input-bordered input-md w-full max-w-full" />
  </label>

  <button class="btn btn-block btn-secondary text-secondary-content mt-5" type="submit">
    Submit data of {{ $modelName }}
  </button>
</div>
@endsection