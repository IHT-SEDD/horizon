@extends('layouts.app')

@section('main')
<div class="max-w-full mx-auto sm:px-6 lg:px-8">
  <div class="flex justify-between items-center w-full py-4">
    <!-- Title -->
    <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content py-2 my-3 px-4">New sales order</h1>

    <!-- Stepper -->
    <ul class="steps">
      <li class="step text-sm step-primary" id="step_1">Customer</li>
      <li class="step text-sm" id="step_2">Choose product</li>
      <li class="step text-sm" id="final_step">Final step</li>
    </ul>
  </div>


  <div class="w-full px-3">
    <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-4 px-3 w-full">
      <!-- Form Step 1 :begin -->
      @include('sales.form-new-sale.step_1')
      <!-- Form Step 1 :end -->

      <!-- Form Step 2 :begin -->
      @include('sales.form-new-sale.step_2')
      <!-- Form Step 2 :end -->

      <!-- Form Step 2 :begin -->
      @include('sales.form-new-sale.step_3')
      <!-- Form Step 2 :end -->
    </div>
  </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tom-select/tom-select.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('plugins/tom-select/tom-select-complete.min.js') }}"></script>

<script src="{{ asset('js/global/forms/form-validation.js') }}"></script>
<script src="{{ asset('js/global/forms/wizard-form-config.js') }}"></script>
<script src="{{ asset('js/global/daterangepicker-config.js') }}"></script>
<script src="{{ asset('js/global/tom-select-config.js') }}"></script>
<script src="{{ asset('js/global/utils.js') }}"></script>

<script src="{{ asset('js/sales/new-sale.js') }}"></script>
@endsection