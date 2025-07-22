@props([
'searchdata' => true,
])

<div class="overflow-auto h-full w-auto px-1">
  @if ($searchdata)
  <div class="flex justify-between items-center py-3 px-2">
    <input type="text" id="search-dt" data-kt-docs-table-filter="search" placeholder="Search..."
      class="input input-bordered input-sm w-full max-w-xs" />
  </div>
  @endif

  <table {{ $attributes->merge(['class' => 'table-zebra table w-auto min-w-full table-auto shadow-none h-full
    rounded-none mx-1']) }} id="master-table">
    <thead>
      <tr>
        {{ $slot }}
      </tr>
    </thead>
    <tbody>
      {{-- Data will populated here --}}
    </tbody>
  </table>
</div>