<div class="navbar bg-base-100">
    <div class="navbar-start px-4">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li><a href="{{ url('/dashboard') }}">Sales</a></li>
                <li>
                    <a :class="request()->is('master/*') ? 'bg-base-200 font-semibold text-primary-content' : ''">Master
                        Data</a>
                    <ul class="p-2">
                        <li>
                            <a href="{{ url('/master/customer') }}" :active="request()->is('master/customer/*')">
                                Customers
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/master/product') }}" :active="request()->is('master/product/*')">
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/master/payment-term') }}"
                                :active="request()->is('master/payment-term/*')">
                                Payment Terms
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logos/horizon.png') }}" alt="" style="width:25%; height:25%;">
        </a>
    </div>

    <div class="navbar-center hidden lg:flex z-10">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li><a href="{{ url('/sales') }}">Sales</a></li>
            <li>
                <details>
                    <summary class="{{ request()->is('master/*') ? 'text-secondary font-semibold' : '' }}">
                        Master Data
                    </summary>
                    @include('layouts.partials.master-data-nav')
                </details>
            </li>
        </ul>
    </div>

    <div class="navbar-end">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="m-1">{{ Auth::user()->name }}</div>
            <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                <li><a href="route('profile.edit')">Profile</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a :href="url('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>