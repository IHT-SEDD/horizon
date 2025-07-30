@extends('layouts.app')

@section('main')
<div class="max-w-full mx-auto sm:px-6 lg:px-8">
 <!-- Header -->
 @include('sales.partials.header')

 <!-- Contents -->
 <div class="w-full px-3">
  <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-4 px-5 w-full space-y-12">
   <!-- Information -->
   @include('sales.partials.information')

   <!-- Table products -->
   <x-datatable idTable="sales-order-detail-table">
    <th>No</th>
    <th>Product Name</th>
    <th>Description</th>
    <th>Quantity</th>
    <th>Delivered</th>
    <th>Invoiced</th>
    <th>Unit</th>
    <th>Tag</th>
    <th>Price</th>
    <th>Tax</th>
    <th>Discount</th>
    <th>Subtotal</th>
   </x-datatable>

   <!-- Sub Information -->
   @include('sales.partials.sub-information')
  </div>
 </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/datatable/datatable-tailwind.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/datatable/datatable.js') }}"></script>
<script src="{{ asset('plugins/datatable/datatable-tailwind.js') }}"></script>
<script src="{{ asset('plugins/moment.min.js') }}"></script>
<script src="{{ asset('plugins/dayjs.min.js') }}"></script>

<script src="{{ asset('js/global/datatable.js') }}"></script>
<script src="{{ asset('js/global/utils.js') }}"></script>

<script src="{{ asset('js/sales/detail.js') }}"></script>
@endsection