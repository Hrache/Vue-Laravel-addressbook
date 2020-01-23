@extends('layouts.app')

@section('content')
<section class="container d-flex justify-content-center align-items-center" id="loginwrapper">
  <form method="POST" action="{{ route('login') }}" class="project" style="width: 100%;">
    @csrf

    <div class="form-group row">
      <label class="col-md-4 col-form-label text-md-right" for="email">{{ __('E-Mail Address') }}</label>

      <div class="col-md-8">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

      <div class="col-md-8">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>

    <div class="form-group row">
      <div class="col-md-4 offset-md-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

          <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>
      </div>
    </div>

    <div class="form-group row mb-0">
      <div class="col-md-4 offset-md-4">
        <button type="submit" class="btn btn-outline-primary">{{ __('Login') }}</button>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
      </div>
    </div>
  </form>
</section>
@endsection

@push('headstyles')
<style type="text/css">
  #loginwrapper label { color: white !important; }
</style>
@endpush

@push('bodyground')
<script type="text/javascript">
  options.data.pagetitle = "{{ __('Login') }}";
</script>
@endpush