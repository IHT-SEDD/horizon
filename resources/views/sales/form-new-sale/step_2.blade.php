<div class="hidden" id="form_step_2_wrapper">
  <form action="" class="px-4 py-2 grid grid-cols-1 gap-4 w-full h-full" id="form_step_2">
    @csrf
    <!-- Product Inputs -->
    <div class="max-w-md flex justify-between items-center gap-3">
      <!-- Select Product -->
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text capitalize">Product <span class="text-error text-sm">*</span></span>
        </div>
        <select class="w-full tom-select" id="select-one-product" name="product_id"></select>
      </label>

      <!-- Quantity -->
      <label class="form-control w-full">
        <div class="label">
          <span class="label-text capitalize">Quantity <span class="text-error text-sm">*</span></span>
        </div>
        <input name="quantity" id="quantity" type="text" placeholder="Input quantity product"
          class="input input-bordered input-sm w-full" />
      </label>

      <!-- Add product btn -->
      <div class="pt-[33px]">
        <button class="btn btn-sm btn-secondary" type="submit" id="add_product_btn">
          <i data-lucide="plus" width="13" height="13"></i>
        </button>
      </div>
    </div>

    <!-- Products table -->
    <div class="overflow-x-auto">
      <table class="table table-zebra">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Sales Price</th>
            <th>Tax</th>
            <th>Discount</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="product-table-body">
        </tbody>
      </table>
    </div>

    <!-- Pricing & description -->
    <div class="border-t border-dashed border-base-200 pt-5 mt-3">
      <div class="w-full grid grid-cols-2">
        <!-- Description -->
        <label class="form-control w-full max-w-xs">
          <div class="label">
            <span class="label-text capitalize">Description</span>
          </div>
          <textarea name="description" placeholder="Type sales order description"
            class="textarea textarea-bordered textarea-md w-full max-w-full"></textarea>
        </label>

        <!-- Pricing -->
        <div class="space-y-3 w-full">
          <div class="flex justify-between items-center space-x-4">
            <p class="text-sm font-semibold text-primary-content">Untaxed Amount</p>
            <p class="text-sm font-medium text-primary-content" id="untaxed_amount">Rp. 0</p>
          </div>
          <div class="flex justify-between items-center space-x-4">
            <p class="text-sm font-semibold text-primary-content">Tax Amount</p>
            <p class="text-sm font-medium text-primary-content" id="tax_amount">Rp. 0</p>
          </div>
          <div class="flex justify-between items-center space-x-4">
            <p class="text-sm font-semibold text-primary-content">Total Amount</p>
            <p class="text-sm font-medium text-primary-content" id="total_amount">Rp. 0</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Buttons -->
    <div class="border-t border-dashed border-base-200 pt-5 mt-3">
      <!-- Previous Step to step 1 btn -->
      <button class="btn btn-sm btn-outline btn-secondary" type="button" id="previous_to_step_1">
        <i data-lucide="arrow-left" width="13" height="13"></i>
        Previous
      </button>

      <!-- Final submit btn -->
      <button class="btn btn-sm btn-outline btn-success" type="submit" id="final_submit">
        <i data-lucide="check" width="13" height="13"></i>
        Submit
      </button>

      <!-- Clear form step 2 btn -->
      <button class="btn btn-sm btn-outline btn-error" type="button" id="clear_step_2">
        <i data-lucide="trash" width="13" height="13"></i>
        Clear
      </button>
    </div>
  </form>
</div>