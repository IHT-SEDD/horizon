<div class="navbar bg-base-100">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        <li><a>Dashboad</a></li>
        <li><a>Sales</a></li>
        <li>
          <a>Master</a>
          <ul class="p-2">
            <li><a>Products</a></li>
            <li><a>Customers</a></li>
            <li><a>Payment Terms</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <a class="btn btn-ghost text-xl">{{ config('app.name') }}</a>
  </div>

  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><a>Dashboard</a></li>
      <li>
        <a href="/sales">Sales</a>
      </li>
      <li>
        <details>
          <summary>Master</summary>
          <ul class="p-2">
            <li><a>Products</a></li>
            <li><a>Customers</a></li>
            <li><a>Payment Terms</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </div>

  <div class="navbar-end">
    {{-- Dropdown Menu ::start --}}
    <div class="dropdown dropdown-end">
      {{-- Button --}}
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img alt="Tailwind CSS Navbar component"
            src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
        </div>
      </div>

      {{-- Menus ::start --}}
      <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        {{-- Profile --}}
        <li>
          <a>Profile</a>
        </li>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <li href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            <a>Logout</a>
          </li>
        </form>
      </ul>
      {{-- Menus ::end --}}
    </div>
    {{-- Dropdown Menu ::start --}}
  </div>
</div>