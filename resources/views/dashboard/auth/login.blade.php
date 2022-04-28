@extends('dashboard.layouts.app')
@section('title','Login')
@section('content')
	<div class="content-wrapper">
		<div class="content-header row">
		</div>
		<div class="content-body">
			<section class="flexbox-container">
				<div class="col-12 d-flex align-items-center justify-content-center">
					<div class="col-md-4 col-10 box-shadow-2 p-0">
						<div class="card border-grey border-lighten-3 m-0">
							<div class="card-header border-0">
								<div class="card-title text-center">
									<div class="p-1">
										<img width="55%" src="{{asset('app-assets/security.svg')}}">
									</div>
								</div>
								<h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
									<span> {{__('dashboard.login to').' '}} {{__('dashboard.dashboard')}}</span>
								</h6>
							</div>
							<div class="card-content">
								<form class="form-horizontal form-simple"  method="POST" action="{{route('dashboard.login')}}" novalidate>
									<div class="card-body">
										@csrf
										@if(session()->has('error-login'))
											<div class="alert bg-danger alert-dismissible mb-2" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">×</span>
												</button>
												{{session()->get('error-login')}}
											</div>
										@endif
										<fieldset class="form-group position-relative has-icon-left mb-0">
											<input 
												type="email" 
												class="form-control form-control-lg input-lg  @error('email') is-invalid @enderror" 
												value="{{ old('email') }}"
												placeholder="{{__('dashboard.your email')}}"
												name="email" 
											>
											<div class="form-control-position">
												<i class="ft-mail" style="font-size: 22px;"></i>
											</div>
											@error('email')
												<span class="invalid-feedback" role="alert"> 
													{{ $message }}
												</span>
											@enderror
										</fieldset>
										<fieldset class="form-group position-relative has-icon-left mt-1">
											<input 
												type="password" 
												class="form-control form-control-lg input-lg  @error('password') is-invalid @enderror" 
												placeholder="{{__('dashboard.password')}}" 
												name="password" 
											>
											<div class="form-control-position">
												<i class="la la-key" style="font-size: 22px;"></i>
											</div>
											@error('password')
												<span class="invalid-feedback" role="alert"> 
													{{ $message }}
												</span>
											@enderror
										</fieldset>
										<div>
											{{__('dashboard.Dont have an account ?')}}
											<a href="{{route('dashboard.register.show')}}">
												{{__('dashboard.Create an account')}}
											</a>
										</div>
									</div>
									<div class="card-footer">
										<button type="submit" class="btn btn-pink btn-lg btn-block"><i class="ft-unlock"></i> {{__('dashboard.login')}}</button>
									</div>
									
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
@endsection

