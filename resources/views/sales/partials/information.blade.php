<div class="grid grid-cols-1 md:grid-cols-3 w-full gap-2 md:gap-4 pb-10 border-b border-dashed border-base-300">
 <!-- Customer -->
 <div class="flex md:flex-row flex-col md:justify-start items-start gap-1 md:gap-4 md:col-span-2 md:max-w-2xl w-full">
  <h1 class="text-lg md:text-xl font-semibold capitalize text-accent-content">Customer</h1>
  <!-- Customer Wrapper -->
  <div class="hidden" id="customer_wrapper">
   <p class="text-md md:text-lg font-medium text-accent-content uppercase customer_name"></p>
   <p class="text-sm md:text-md font-medium text-accent-content customer_address"></p>
  </div>
  <!-- Customer Skeleton -->
  <div class="hidden" id="customer_skeleton">
   <div class="skeleton h-5 w-32 mb-2"></div>
   <div class="skeleton h-8 w-56"></div>
  </div>
 </div>

 <!-- Confirmation Date & Payment Terms -->
 <div class="flex flex-col">
  <!-- Confirmation Date -->
  <div class="flex md:flex-row flex-col md:justify-between items-start">
   <h1 class="text-lg md:text-xl font-semibold capitalize text-accent-content">
    Confirmation Date
   </h1>
   <!-- Confirmation Date Skeleton -->
   <div class="hidden" id="confirmation_date_skeleton">
    <div class="skeleton h-5 w-32"></div>
   </div>
   <!-- Confirmation Date Wrapper -->
   <div class="hidden" id="confirmation_date_wrapper">
    <p class="text-md md:text-lg font-medium text-accent-content confirmation_date"></p>
   </div>
  </div>
  <!-- Expiration Date -->
  <div class="flex md:flex-row flex-col md:justify-between items-start">
   <h1 class="text-lg md:text-xl font-semibold capitalize text-accent-content">
    Expiration Date
   </h1>
   <!-- Expiration Date Skeleton -->
   <div class="hidden" id="expiration_date_skeleton">
    <div class="skeleton h-5 w-32"></div>
   </div>
   <!-- Expiration Date Wrapper -->
   <div class="hidden" id="expiration_date_wrapper">
    <p class="text-md md:text-lg font-medium text-accent-content expiration_date"></p>
   </div>
  </div>
  <!-- Payment Term -->
  <div class="flex md:flex-row flex-col md:justify-between items-start">
   <h1 class="text-lg md:text-xl font-semibold capitalize text-accent-content">
    Payment Term
   </h1>
   <!-- Payment Term Skeleton -->
   <div class="hidden" id="payment_term_skeleton">
    <div class="skeleton h-5 w-32"></div>
   </div>
   <!-- Payment Term Wrapper -->
   <div class="hidden" id="payment_term_wrapper">
    <p class="text-md md:text-lg font-medium text-accent-content payment_term"></p>
   </div>
  </div>
 </div>
</div>