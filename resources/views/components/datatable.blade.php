@props([
'searchdata' => true,
'idTable' => ''
])

<div>
  @if ($searchdata)
  <div class="flex justify-between items-center py-3 px-2">
    <input type="text" id="search-dt" data-kt-docs-table-filter="search" placeholder="Search..."
      class="input input-bordered input-sm w-full max-w-xs" />
  </div>
  @endif

  <div class="w-full overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'table-zebra table w-full table-auto shadow-none h-full
      rounded-none']) }} id={{ $idTable }}>
      <thead>
        <tr>
          {{ $slot }}
        </tr>
      </thead>
      <tbody class="text-sm">
        {{-- Data will populated here --}}
      </tbody>
    </table>
  </div>
</div>