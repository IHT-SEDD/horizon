<div class="py-2 my-3 px-4 w-full flex flex-col md:flex-row md:justify-between md:items-center">
 <!-- Title -->
 <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content md:mb-0 mb-2">Detail Sales Order</h1>
 <!-- Status & Number Skeleton -->
 <div id="status_number_skeleton" class="hidden">
  <div class="flex justify-start md:justify-between items-center gap-1">
   <div class="skeleton h-8 w-28"></div>
   <div class="skeleton h-8 w-28"></div>
  </div>
 </div>

 <!-- Status & Number -->
 <div id="status_number_wrapper" class="hidden">
  <div class="flex justify-start md:justify-between items-center gap-1">
   <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content status_so"></h1>
   <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content so_number"></h1>
  </div>
 </div>
</div>

<!-- Toolbar -->
<div class="w-full px-3 mb-3">
 <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-2 px-3 w-full overflow-visible">
  <ul class="menu bg-base-200/50 lg:menu-horizontal rounded-box gap-2">
   <!-- Print Btn -->
   <li>
    <a class="btn btn-outline btn-primary-content btn-sm">
     <i data-lucide="printer" width="13" height="13"></i>
     Print
    </a>
   </li>
   <!-- Confirm Btn -->
   <li>
    <button id="confirm_btn" class="btn btn-outline btn-success btn-sm">
     <i data-lucide="check" width="13" height="13"></i>
     Confirm
    </button>
   </li>
   <!-- Cancel Btn -->
   <li>
    <button id="cancel_btn" class="btn btn-outline btn-error btn-sm">
     <i data-lucide="x" width="13" height="13"></i>
     Cancel
    </button>
   </li>
   <!-- Lock Btn -->
   <li>
    <button id="lock_btn" class="btn btn-outline btn-info btn-sm">
     <i data-lucide="lock" width="13" height="13"></i>
     Lock
    </button>
   </li>
  </ul>
 </div>
</div>