<ul class="p-2 min-w-48">
 <!-- Customer -->
 <li>
  <a href="{{ url('/master/customer') }}"
   class="{{ request()->is('master/customer*') ? 'font-semibold text-secondary' : '' }}">
   Customers
  </a>
 </li>

 <!-- Payment Term -->
 <li>
  <a href="{{ url('/master/payment-term') }}"
   class="{{ request()->is('master/payment-term*') ? 'font-semibold text-secondary' : '' }}">
   Payment Terms
  </a>
 </li>

 <!-- Tax -->
 <li>
  <a href="{{ url('/master/tax') }}" class="{{ request()->is('master/tax*') ? 'font-semibold text-secondary' : '' }}">
   Taxes
  </a>
 </li>

 <!-- Product -->
 <li>
  <a href="{{ url('/master/product') }}"
   class="{{ request()->is('master/product*') ? 'font-semibold text-secondary' : '' }}">
   Products
  </a>
  <ul>
   <!-- Categories -->
   <li>
    <a href="{{ url('/master/product-category') }}"
     class="{{ request()->is('master/product-category*') ? 'font-semibold text-secondary' : '' }}">
     Categories
    </a>
   </li>

   <!-- Unit -->
   <li>
    <a href="{{ url('/master/product-unit') }}"
     class="{{ request()->is('master/product-unit*') ? 'font-semibold text-secondary' : '' }}">
     Units
    </a>
   </li>
  </ul>
 </li>
</ul>