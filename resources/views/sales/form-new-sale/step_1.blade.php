<!-- Form Step 1 :begin -->
<div id="form_step_1_wrapper">
  <form action="" class="px-4 py-2 grid grid-cols-2 gap-4" id="form_step_1">
    @csrf
    <!-- Customer Select -->
    <label class="form-control w-full">
      <div class="label">
        <span class="label-text capitalize">Customer <span class="text-error text-sm">*</span></span>
      </div>
      <select class="w-full max-w-full tom-select" id="select-one-customer" name="customer_id"></select>
    </label>

    <!-- Expiration Date -->
    <label class="form-control w-full">
      <div class="label">
        <span class="label-text capitalize">Expiration Date <span class="text-error text-sm">*</span></span>
      </div>
      <input id="expiration_date_picker" name="expiration_date" type="text" placeholder=""
        class="input input-bordered input-sm w-full max-w-full" />
    </label>

    <!-- Payment Term Select -->
    <label class="form-control w-full">
      <div class="label">
        <span class="label-text capitalize">Payment Term <span class="text-error text-sm">*</span></span>
      </div>
      <select class="w-full max-w-full tom-select" id="select-one-payment-term" name="payment_term_id"></select>
    </label>

    <!-- Buttons -->
    <div class="border-t border-dashed border-base-200 pt-5 mt-3 col-span-2">
      <!-- Next Step to step 2 btn -->
      <button class="btn btn-sm btn-outline btn-info" type="submit" id="next_to_step_2">
        <i data-lucide="arrow-right" width="13" height="13"></i>
        Next
      </button>

      <!-- Clear form step 1 btn -->
      <button class="btn btn-sm btn-outline btn-error" type="button" id="clear_step_1">
        <i data-lucide="trash" width="13" height="13"></i>
        Clear
      </button>
    </div>
  </form>
</div>
<!-- Form Step 1 :end -->