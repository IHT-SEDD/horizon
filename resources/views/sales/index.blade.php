@extends('layouts.app')

@section('main')
<div class="max-w-full mx-auto sm:px-6 lg:px-8">
 {{-- Title --}}
 <div class="py-2 my-3 px-4 w-full flex justify-between items-center">
  <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content">Sales</h1>

  <div class="flex justify-between items-center">
   <a href="{{ url('sales/add-new') }}" class="btn btn-secondary">
    <i data-lucide="plus"></i>
    Add New
   </a>
  </div>
 </div>

 <div class="w-full px-3">
  {{-- Table --}}
  <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-4 px-3 md:col-span-2">
   <x-datatable>
    <th>No</th>
    <th>Quotation Number</th>
    <th>Customer</th>
    <th>Payment Term</th>
    <th>Products</th>
    <th>Quantity</th>
    <th>Untaxed Amount</th>
    <th>Taxes</th>
    <th>Total</th>
    <th>Status</th>
    <th>Created At</th>
    <th>Created By</th>
   </x-datatable>
  </div>
 </div>
</div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection