@extends('layouts.app')

@section('content')
<section id="addnewwrapper" class="project container card p-4 bordered" style="background: rgba(0, 16, 32, 0.65);">
@if (Route::currentRouteName() === 'addresses.edit')
  <form action="{{ route('addresses.update', ['address' => $address]) }}" class="card-body" id="newRecordForm" method="POST">
@else
  <form action="{{ route('addresses.store') }}" method="POST" class="card-body" id="newRecordForm">
@endif
    @csrf

    @if (Route::currentRouteName() === 'addresses.edit')
      @method('PATCH')
    @endif

    <div class="row">
      <label class="six columns" for="first_name" aria-label="First name">
        <span class="label-body red-txt">First name</span>

        <input type="text" name="first_name" id="first_name" class="u-full-width" required="required" tabindex="1" value="{{ !empty($address)? $address->first_name: '' }}" />
      </label>
      <label class="six columns" for="last_name" aria-label="Last name">
        <span class="label-body red-txt">Last name</span>

        <input type="text" name="last_name" id="last_name" class="u-full-width" required="required" tabindex="2" value="{{ !empty($address)? $address->last_name: '' }}" />
      </label>
    </div>
    <div class="row">
      <label for="email" aria-label="Email" class="six columns">
        <span class="label-body red-txt">Email</span>

        <input type="email" id="email" name="email" class="u-full-width" required="required" tabindex="3" value="{{ !empty($address)? $address->email: '' }}" />
      </label>
      <label for="prim_phone" aria-label="Primary phone" class="six columns">
        <span class="label-body red-txt">Primary phone &nbsp; @{{ tel16c }}</span>

        <input type="tel" id="prim_phone" name="prim_phone" class="u-full-width" required="required" tabindex="4" value="{{ !empty($address)? $address->prim_phone: '' }}" v-model="tel16" />
      </label>
    </div>
    <div class="row">
      <div class="six columns">
        <label for="country" aria-label="Country">
          <span class="label-body red-txt">Country</span>

          <input type="text" name="country" class="u-full-width" required="required" tabindex="5" value="{{ !empty($address)? $address->country: '' }}" />
        </label>
        <label for="city" aria-label="City">
          <span class="label-body red-txt">City</span>

          <input type="text" id="city" name="city" class="u-full-width" required="required" tabindex="6" value="{{ !empty($address)? $address->city: '' }}" />
        </label>
      </div>
      <div class="six columns">
        <label for="street" aria-label="Street">
          <span class="label-body red-txt">Street</span>

          <input type="text" id="street" name="street" class="u-full-width" required="required" tabindex="7" value="{{ !empty($address)? $address->street: '' }}" />
        </label>
        <label for="home" aria-label="Home">
          <span class="label-body red-txt">Home/appartment</span>

          <input type="text" name="home" class="u-full-width" required="required" tabindex="8" value="{{ !empty($address)? $address->home: '' }}" />
        </label>
      </div>
    </div>
    <div class="row">
      <label for="sec_phone" aria-label="Secondary phone" class="six columns">
        <span class="label-body text-white">Secondary phone</span>

        <input type="tel" name="sec_phone" class="u-full-width" tabindex="9" value="{{ !empty($address)? $address->sec_phone: '' }}" />
      </label>
      <label for="sec_email" aria-label="Email" class="six columns">
        <span class="label-body text-white">Alternative email</span>

        <input type="email" name="sec_email" class="u-full-width" tabindex="10" value="{{ !empty($address)? $address->sec_email: '' }}" />
      </label>
    </div>
    <div class="row">
      <div class="twelve columns">
        <label for="address2" aria-label="Alternative address">
          <span class="label-body text-white">Alternative address</span>

          <input type="url" name="address2" id="address2" class="u-full-width" tabindex="11" value="{{ !empty($address)? $address->address2: '' }}" />
        </label>
      </div>
    </div>
    <div class="row">
      <div class="twelve columns">
        <label for="fb_account_url" aria-label="Facebook account">
          <span class="label-body text-white">Facebook link</span>

          <input type="url" id="fb_account_url" name="fb_account_url" class="u-full-width" tabindex="12" value="{{ !empty($address)? $address->fb_account_url: '' }}" />
        </label>
      </div>
    </div>
    <div class="row">
      <p class="col-12 d-flex justify-content-end">
        <div class="btn-group">
          <button class="btn btn-primary" type="submit" tabindex="13">Save</button>
          <button class="btn btn-secondary" type="reset" tabindex="14">Reset</button>
          @if (Route::currentRouteName() === 'addresses.edit')
          <button class="btn btn-danger" type="button" tabindex="15" @click="deleteAddress('#deleteform')">Delete</button>
          @endif
        </div>
      </p>
    </div>
  </form>
@if (Route::currentRouteName() === 'addresses.edit')
  <form action="{{ route('addresses.destroy', ['address' => $address]) }}" method="POST" id="deleteform">@csrf @method('delete')</form>
@endif
</section>
@endsection

@push('headlinks')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/skeleton.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}" />
@endpush

@push('headstyles')
  <style type="text/css" media="screen">
    @import url('https://fonts.googleapis.com/css?family=Encode+Sans+Condensed&display=swap');
    body {font-family: 'Encode Sans Condensed', sans-serif;}
    #newRecordForm label > span { font-weight: bold;}
  </style>
@endpush

@push('bodyground')
<script type="text/javascript">
  options.data.tel16= document.querySelector('#prim_phone').value

  Object.assign(options.computed, {
    tel16c() {
      let rex = new RegExp(/[\d\-\ \(\)]{9,16}/isy);
      if (this.tel16 === '') return '';
      else if (rex.test(this.tel16) && this.tel16.length <= 16) return "valid";
      else return "not valid";
    }
  });

@if (Route::currentRouteName() === 'addresses.edit')

  options.methods.deleteAddress = deleteform => {
    document.querySelector(deleteform).submit();
  };

  options.data.pagetitle = "Update address #{{ $address->id }}";
@else
  options.data.pagetitle = "Add new record.";
@endif
</script>
@endpush