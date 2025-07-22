@extends('layouts.master')

@section('table')
<x-datatable>
 <th>No</th>
 <th>Name</th>
 <th>Value</th>
 <th>Description</th>
 <th>Active Status</th>
 <th>Created At</th>
</x-datatable>
@endsection

@section('form')
<div class="flex flex-col w-full justify-start items-center gap-3">
 <!-- Name -->
 <label class="form-control w-full max-w-full">
  <div class="label">
   <span class="label-text capitalize">{{ $modelName }} name <span class="text-error text-sm">*</span></span>
  </div>
  <input name="name" type="text" placeholder="Input {{ $modelName }} name"
   class="input input-bordered input-md w-full max-w-full" />
 </label>

 <!-- Value -->
 <label class="form-control w-full max-w-full">
  <div class="label">
   <span class="label-text capitalize">{{ $modelName }} value <span class="text-error text-sm">*</span></span>
  </div>
  <input name="value" type="text" placeholder="Input {{ $modelName }} value"
   class="input input-bordered input-md w-full max-w-full" />
 </label>

 <!-- Description -->
 <label class="form-control w-full max-w-full">
  <div class="label">
   <span class="label-text capitalize">{{ $modelName }} description</span>
  </div>
  <textarea name="description" placeholder="Type {{ $modelName }} description"
   class="textarea textarea-bordered textarea-md w-full max-w-full"></textarea>
 </label>

 <!-- Active Status -->
 <div class="form-control w-full max-w-full">
  <label class="label cursor-pointer">
   <span class="label-text">Is {{ $modelName }} Active?</span>
   <input type="hidden" name="is_active" value="0">
   <input type="checkbox" checked="checked" class="checkbox" name="is_active" value="1" />
  </label>
 </div>

 <button class="btn btn-block btn-secondary text-secondary-content mt-5" type="submit">
  Submit data of {{ $modelName }}
 </button>
</div>
@endsection