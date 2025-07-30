@extends('layouts.app')

@section('main')
<div class="max-w-full mx-auto sm:px-6 lg:px-8">
 {{-- Title --}}
 <div class="py-2 my-3 px-4 w-full flex justify-between items-center">
  <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content">Sales Order</h1>

  <div class="flex justify-between items-center">
   <a href="{{ url('sales/add-new') }}" class="btn btn-secondary">
    <i data-lucide="plus"></i>
    Add New
   </a>
  </div>
 </div>

 <div class="w-full px-3">
  {{-- Table --}}
  <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-4 px-3 w-full overflow-visible">
   <x-datatable idTable="sales-order-table">
    <th>No</th>
    <th>Quotation Number</th>
    <th>Customer</th>
    <th>Payment Term</th>
    <th>Products</th>
    <th>Untaxed Amount</th>
    <th>Taxes</th>
    <th>Total</th>
    <th>Status</th>
    <th>Created By</th>
    <th>Created At</th>
    <th>Action</th>
   </x-datatable>
  </div>
 </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/datatable/datatable-tailwind.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tom-select/tom-select.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/datatable.js') }}"></script>
<script src="{{ asset('plugins/datatable/datatable-tailwind.js') }}"></script>
<script src="{{ asset('plugins/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('plugins/tom-select/tom-select-complete.min.js') }}"></script>
<script src="{{ asset('plugins/dayjs.min.js') }}"></script>

<script src="{{ asset('js/global/datatable.js') }}"></script>
<script src="{{ asset('js/global/form-validation.js') }}"></script>
<script src="{{ asset('js/global/daterangepicker-config.js') }}"></script>
<script src="{{ asset('js/global/tom-select-config.js') }}"></script>
<script src="{{ asset('js/global/utils.js') }}"></script>

<script src="{{ asset('js/sales/index.js') }}"></script>
@endsection