@extends('layouts.app')

@section('main')
<div class="max-w-full mx-auto sm:px-6 lg:px-8">

  {{-- === Page Header === --}}
  <div class="py-2 my-3 px-4 w-full flex justify-between items-center">
    {{-- Title --}}
    <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content">New sales order</h1>

    {{-- Action Buttons --}}
    <div class="flex justify-between items-center gap-2">
      {{-- Save --}}
      <button class="btn btn-sm md:btn-md btn-secondary" type="button">
        <i data-lucide="save" width="15" height="15"></i>
        Save
      </button>

      {{-- Discard --}}
      <button class="btn btn-sm md:btn-md btn-error" type="button">
        <i data-lucide="trash" width="15" height="15"></i>
        Discard
      </button>
    </div>
  </div>

  <div class="w-full px-3">
    <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-4 px-3 md:col-span-2">

      {{-- === Quotation Header === --}}
      <div class="px-4 w-full flex md:flex-row flex-col justify-between items-start md:items-center mb-6">
        {{-- Title --}}
        <h2 class="text-lg md:text-xl font-semibold capitalize text-accent-content md:mb-0 mb-3">Quotation Number</h2>

        {{-- Quotation Actions --}}
        <div class="flex justify-between items-center gap-2">
          {{-- Print --}}
          <button class="btn btn-sm btn-outline btn-info" type="button">
            <i data-lucide="printer" width="13" height="13"></i>
            Print
          </button>

          {{-- Confirm Sale --}}
          <button class="btn btn-sm btn-outline btn-success" type="button">
            <i data-lucide="check" width="13" height="13"></i>
            Confirm Sale
          </button>

          {{-- Cancel --}}
          <button class="btn btn-sm btn-outline btn-error" type="button">
            <i data-lucide="x" width="13" height="13"></i>
            Cancel
          </button>
        </div>
      </div>

      {{-- === Customer & Details Section === --}}
      <div class="border-b border-dashed border-base-200">
        <div class="px-4 py-6 w-full flex md:flex-row flex-col justify-between items-start md:gap-4 gap-2">

          {{-- Customer --}}
          <label class="form-control w-full max-w-full">
            <div class="label">
              <span class="label-text capitalize">Customer <span class="text-error text-sm">*</span></span>
            </div>
            <select class="w-full max-w-full tom-select" id="select-one-customer" name="customer_id"></select>
          </label>

          <div class="flex flex-col justify-between items-center gap-2 w-full">
            {{-- Expiration Date --}}
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text capitalize">Expiration Date <span class="text-error text-sm">*</span></span>
              </div>
              <input id="expiration_date_picker" type="text" placeholder=""
                class="input input-bordered input-sm w-full max-w-full" />
            </label>

            {{-- Payment Term --}}
            <label class="form-control w-full">
              <div class="label">
                <span class="label-text capitalize">Payment Term <span class="text-error text-sm">*</span></span>
              </div>
              <select class="w-full max-w-full tom-select" id="select-one-payment-term" name="payment_term_id"></select>
            </label>
          </div>
        </div>
      </div>

      {{-- === Product Table Section === --}}
      <div class="border-b border-dashed border-base-200">
        <div class="px-3 py-6 w-full">
          <button class="btn btn-sm btn-outline btn-secondary-content mb-6" onclick="select_product_modal.showModal()"
            type="button">
            <i data-lucide="plus" width="13" height="13"></i>
            Add Product
          </button>

          <div class="overflow-x-auto">
            <table class="table table-zebra">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Description</th>
                  <th>Qty</th>
                  <th>Unit</th>
                  <th>Tag</th>
                  <th>Price</th>
                  <th>Taxes</th>
                  <th>Discount (%)</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{-- === Description & Price Section === --}}
      <div class="px-4 py-6 w-full flex md:flex-row flex-col justify-between items-center md:gap-4 gap-2">

        {{-- Description --}}
        <label class="form-control w-full max-w-full">
          <div class="label">
            <span class="label-text capitalize">Description</span>
          </div>
          <textarea name="description" placeholder="Type sales order description"
            class="textarea textarea-bordered textarea-md w-full max-w-full"></textarea>
        </label>

        <div class="flex flex-col justify-between items-end gap-2 w-full h-full">
          {{-- Untaxed Amount --}}
          <div class="flex justify-center items-center gap-4">
            <h2 class="text-sm md:text-md font-semibold capitalize text-secondary-content">Untaxed Amount</h2>
            <h2 class="text-sm md:text-md font-semibold capitalize text-secondary-content">000000</h2>
          </div>

          {{-- Taxes --}}
          <div class="flex justify-center items-center gap-4">
            <h2 class="text-sm md:text-md font-semibold capitalize text-secondary-content">Taxes</h2>
            <h2 class="text-sm md:text-md font-semibold capitalize text-secondary-content">000000</h2>
          </div>

          {{-- Total --}}
          <div class="flex justify-center items-center gap-4">
            <h2 class="text-sm md:text-md font-semibold capitalize text-secondary-content">Total</h2>
            <h2 class="text-sm md:text-md font-semibold capitalize text-secondary-content">000000</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<dialog id="select_product_modal" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box">
    <div class="py-3 border-b border-dashed border-base-200">
      <h3 class="text-lg font-bold">Choose Product</h3>
    </div>

    <div class="pb-8 pt-3 grid grid-cols-1 gap-3">
      <!-- Container for product rows -->
      <div id="product-container" class="grid grid-cols-1 gap-3">
        <!-- Product Row (default) -->
        <div class="product-row flex items-center gap-4 w-full">
          <!-- Select Product -->
          <label class="form-control w-full">
            <div class="label">
              <span class="label-text capitalize">Product <span class="text-error text-sm">*</span></span>
            </div>
            <select class="w-full max-w-full tom-select" id="select-one-product" name="product_id[]"></select>
          </label>

          <!-- Quantity -->
          <label class="form-control w-full">
            <div class="label">
              <span class="label-text capitalize">Quantity <span class="text-error text-sm">*</span></span>
            </div>
            <input name="qty[]" id="qty" type="text" placeholder="Input quantity product"
              class="input input-bordered input-sm w-full" />
          </label>

          <!-- Delete Button -->
          <div class="pt-[33px]">
            <button class="btn btn-sm text-base-100 btn-error delete-product" type="button">
              <i data-lucide="trash" width="13" height="13"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Button add other product -->
      <div class="mt-2">
        <button class="btn btn-sm" type="button" id="add_other_product">
          <i data-lucide="plus" width="13" height="13"></i>
          Other products
        </button>
      </div>
    </div>

    <div class="border-t border-dashed border-base-200">
      <div class="modal-action">
        <form method="dialog">
          <button class="btn btn-sm btn-success text-base-100">Done</button>
          <button class="btn btn-sm btn-error text-base-100">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</dialog>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tom-select/tom-select.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.min.js') }}"></script>
<script src="{{ asset('plugins/tom-select/tom-select-complete.min.js') }}"></script>
<script src="{{ asset('js/global/daterangepicker-config.js') }}"></script>
<script src="{{ asset('js/global/tom-select-config.js') }}"></script>
<script src="{{ asset('js/sales/new-sale.js') }}"></script>
@endsection