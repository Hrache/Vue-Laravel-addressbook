@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
	  <div class="col-md-8">
		  <div class="project">
			  <form method="POST" action="{{ route('register') }}">
				  @csrf

				  <div class="form-group row">
					  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

					  <div class="col-md-6">
						  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

						  @error('name')
							  <span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
							  </span>
						  @enderror
					  </div>
				  </div>

				  <div class="form-group row">
					  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

					  <div class="col-md-6">
						  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

						  @error('email')
							  <span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
							  </span>
						  @enderror
					  </div>
				  </div>

				  <div class="form-group row">
					  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

					  <div class="col-md-6">
						  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

						  @error('password')
							  <span class="invalid-feedback" role="alert">
								  <strong>{{ $message }}</strong>
							  </span>
						  @enderror
					  </div>
				  </div>

				  <div class="form-group row">
					  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

					  <div class="col-md-6">
						  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					  </div>
					</div>

					<div class="form-group row">
					  <div class="col-md-7 offset-md-3">
							<input type="file" id="customFile" name="userphoto" class="rounded" style="width: 100%; line-height: 0.85cm;" /> 
					  </div>
					</div>

				  <div class="form-group row mb-0">
					  <div class="col-md-4 offset-md-6 d-flex justify-content-end">
						  <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
					  </div>
				  </div>
			  </form>
		  </div>
	  </div>
  </div>
</div>
@endsection

@push('bodyground')
<script type="text/javascript">
  options.data.pagetitle = "{{ __('Register') }}";
</script>
@endpush