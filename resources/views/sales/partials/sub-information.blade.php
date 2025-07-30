<div class="grid grid-cols-1 md:grid-cols-3 w-full space-y-6 pt-10 border-t border-dashed border-base-300">
 <!-- Description -->
 <div class="flex flex-col md:justify-between items-start gap-1 md:col-span-2 md:max-w-2xl w-full">
  <h1 class="text-md md:text-lg font-semibold capitalize text-accent-content">Description</h1>
  <!-- Description Skeleton -->
  <div class="hidden" id="description_skeleton">
   <div class="skeleton h-12 w-60"></div>
  </div>
  <!-- Description Wrapper -->
  <div class="hidden" id="description_wrapper">
   <p class="text-xs md:text-sm font-medium text-accent-content description"></p>
  </div>
 </div>
 <!-- Pricing -->
 <div class="flex flex-col w-full">
  <!-- Untaxed Amount -->
  <div class="flex md:flex-row flex-col md:justify-between items-center">
   <h1 class="text-md md:text-lg font-semibold capitalize text-accent-content">
    Untaxed Amount
   </h1>
   <!-- Untaxed Amount Skeleton -->
   <div class="hidden" id="untaxed_amount_skeleton">
    <div class="skeleton h-4 w-32"></div>
   </div>
   <!-- Untaxed Amount Wrapper -->
   <div class="hidden" id="untaxed_amount_wrapper">
    <p class="text-xs md:text-sm font-medium text-accent-content untaxed_amount"></p>
   </div>
  </div>
  <!-- Tax Amount -->
  <div class="flex md:flex-row flex-col md:justify-between items-center gap-1 md:gap-4">
   <h1 class="text-md md:text-lg font-semibold capitalize text-accent-content">
    Tax Amount
   </h1>
   <!-- Tax Amount Skeleton -->
   <div class="hidden" id="tax_amount_skeleton">
    <div class="skeleton h-4 w-32"></div>
   </div>
   <!-- Tax Amount Wrapper -->
   <div class="hidden" id="tax_amount_wrapper">
    <p class="text-xs md:text-sm font-medium text-accent-content tax_amount"></p>
   </div>
  </div>
  <!-- Total Amount -->
  <div class="flex md:flex-row flex-col md:justify-between items-center gap-1 md:gap-4">
   <h1 class="text-md md:text-lg font-semibold capitalize text-accent-content">
    Total Amount
   </h1>
   <!-- Total Amount Skeleton -->
   <div class="hidden" id="total_amount_skeleton">
    <div class="skeleton h-4 w-32"></div>
   </div>
   <!-- Total Amount Wrapper -->
   <div class="hidden" id="total_amount_wrapper">
    <p class="text-xs md:text-sm font-medium text-accent-content total_amount"></p>
   </div>
  </div>
 </div>
</div>