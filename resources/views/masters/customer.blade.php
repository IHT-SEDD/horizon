@extends('layouts.master')

@section('table')
<x-datatable idTable="master-table">
  <th>No</th>
  <th>Name</th>
  <th>Contact</th>
  <th>Phone Mobile</th>
  <th>Email</th>
  <th>Address</th>
  <th>Reffered To (Name - Role)</th>
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

  <!-- Contact & Phone Mobile-->
  <div class="flex md:flex-row flex-col md:justify-between gap-2 w-full">
    <!-- Contact -->
    <label class="form-control w-full max-w-full">
      <div class="label">
        <span class="label-text capitalize">{{ $modelName }} contact</span>
      </div>
      <input name="contact" type="text" placeholder="Input {{ $modelName }} contact"
        class="input input-bordered input-md w-full max-w-full" />
    </label>
    <!-- Phone Mobile -->
    <label class="form-control w-full max-w-full">
      <div class="label">
        <span class="label-text capitalize">{{ $modelName }} Mobile</span>
      </div>
      <input name="phone_mobile" type="text" placeholder="Input {{ $modelName }} mobile"
        class="input input-bordered input-md w-full max-w-full" />
    </label>
  </div>

  <!-- Email -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} email <span class="text-error text-sm">*</span></span>
    </div>
    <input name="email" type="email" placeholder="Input {{ $modelName }} email"
      class="input input-bordered input-md w-full max-w-full" />
  </label>

  <!-- Address -->
  <label class="form-control w-full max-w-full">
    <div class="label">
      <span class="label-text capitalize">{{ $modelName }} address <span class="text-error text-sm">*</span></span>
    </div>
    <textarea name="address" placeholder="Type {{ $modelName }} address"
      class="textarea textarea-bordered textarea-md w-full max-w-full"></textarea>
  </label>

  <!-- Referred To -->
  <div class="flex md:flex-row flex-col md:justify-between gap-2 w-full">
    <label class="form-control w-full max-w-full">
      <div class="label">
        <span class="label-text capitalize">{{ $modelName }} Role Referrer <span class="text-error text-sm">*</span>
        </span>
      </div>
      <input name="referred_to_role" type="text" placeholder="Input {{ $modelName }} role referrer"
        class="input input-bordered input-md w-full max-w-full" />
    </label>
    <label class="form-control w-full max-w-full">
      <div class="label">
        <span class="label-text capitalize">{{ $modelName }} Name Referrer <span class="text-error text-sm">*</span>
        </span>
      </div>
      <input name="referred_to_name" type="text" placeholder="Input {{ $modelName }} name referrer"
        class="input input-bordered input-md w-full max-w-full" />
    </label>
  </div>

  <button class="btn btn-block btn-secondary text-secondary-content mt-5" type="submit">
    Submit data of {{ $modelName }}
  </button>
</div>
@endsection