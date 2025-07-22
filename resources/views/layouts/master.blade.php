@extends('layouts.app')

@section('main')
<div class="max-w-full mx-auto sm:px-6 lg:px-8">
 {{-- Title --}}
 <div class="p-6">
  <h1 class="text-xl md:text-3xl font-semibold capitalize text-accent-content">Master Data of {{ $modelName }}</h1>
 </div>

 <div class="w-full flex flex-col md:grid md:grid-cols-3 gap-2 px-3">
  {{-- Table --}}
  <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-4 px-3 md:col-span-2">
   @yield('table')
  </div>

  {{-- Form --}}
  <div class="bg-base-100 rounded-xl shadow-md shadow-base-200 py-4 px-3">
   <div class="py-2 px-4 h-full">
    <h1 class="text-lg md:text-xl font-semibold capitalize text-accent-content mb-5">Add {{ $modelName }}</h1>
    <form id="master-form" method="POST" class="min-h-full">
     @csrf
     @yield('form')
    </form>
   </div>
  </div>
 </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/datatable/datatable-tailwind.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/tom-select/tom-select.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/datatable/datatable.js') }}"></script>
<script src="{{ asset('plugins/datatable/datatable-tailwind.js') }}"></script>
<script src="{{ asset('plugins/tom-select/tom-select-complete.min.js') }}"></script>
<script src="{{ asset('plugins/dayjs.min.js') }}"></script>
<script src="{{ asset('js/global/datatable.js') }}"></script>
<script src="{{ asset('js/global/form-validation.js') }}"></script>
<script src="{{ asset('js/global/form-submit.js') }}"></script>
<script src="{{ asset('js/global/tom-select-config.js') }}"></script>
<script src="{{ asset('js/global/utils.js') }}"></script>
<script src="{{ asset('js/masters/' . $model .'.js') }}"></script>
@endsection