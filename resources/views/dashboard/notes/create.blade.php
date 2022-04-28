@extends('dashboard.layouts.app')


@section('content')
	<div class="content-wrapper">
		<div class="content-header row">
			<div class="content-header-left col-12 mb-2 breadcrumb-new">
				<h3 class="content-header-title mb-0 d-inline-block">{{__('dashboard.new note')}}</h3>
						<div class="row breadcrumbs-top d-inline-block">
						<div class="breadcrumb-wrapper col-12">
							<ol class="breadcrumb">
								<li class="breadcrumb-item">
										<a href="{{route('dashboard')}}">{{__('dashboard.dashboard')}}</a>
								</li>
								
								<li class="breadcrumb-item active">
										{{__('dashboard.new note')}}
								</li>
							</ol>
						</div>
				</div>
			</div>
		</div>
		<div class="content-body"><!-- Basic Tables start -->
			<form class="form" action="{{route('dashboard.notes.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-8">
							<div class="card">
								<div class="card-content collapse show">
									<div class="card-body">
										<div class="form-body">
											<div class="form-group">
													<label for="title">{{__('dashboard.title')}} :</label>
													<input 
														type="text"    
														class="form-control @error('title') is-invalid @enderror" 
														placeholder="{{__('dashboard.enter note title')}} "
														name="title"
														value="{{old('title')}}"
													>
													@error('title')
														<span class="invalid-feedback" role="alert"> 
															{{ $message }}
														</span>
													@enderror
											</div>{{--form-group--}}
											<div class="form-group s_c2 ">
												<label >{{__('dashboard.products')}} :</label>
												<select 
													class="form-control @error('type') is-invalid @enderror" 
													name="type"
												>
													<option value="urgent">{{__('dashboard.urgent')}}</option>
													<option value="normal">{{__('dashboard.normal')}}</option>
													<option value="date">{{__('dashboard.date')}}</option>
												</select>
												@error('type')
													<span class="invalid-feedback" role="alert"> 
														{{ $message }}
													</span>
												@enderror
                              	</div>
											<div class="form-group">
													<label for="content">{{__('dashboard.content')}} :</label>
													<textarea 
														class="form-control @error('content') is-invalid @enderror" 
														placeholder="{{__('dashboard.enter note content')}} "
														name="content"
														value="{{old('content')}}"
														rows="4"
													></textarea>
													@error('content')
														<span class="invalid-feedback" role="alert"> 
															{{ $message }}
														</span>
													@enderror
											</div>{{--form-group--}}
										
											<div class="form-actions">
													<button type="submit" class="btn btn-pink pl-4 pr-4">
														{{__('dashboard.save')}}
													</button>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="col-4">
						<div class="card">
							<div class="card-content collapse show">
								
								<div class="card-body">
									<div class="card-title">
										<label for="">{{__('dashboard.photo')}}</label>
									</div>
									<div class="form-body">
										<div class="form-group ">
											<label for="photo">
											<img 
												class="img-thumbnail rounded square  img-fluid" 
												src="{{asset('app-assets/upload.png')}}" itemprop="thumbnail" 
												id="photo_pr"
											>
											</label>
											<input type="file" name="photo" id="photo" style="display: none">
											@error('photo')
												<span class="text-danger" role="alert"> 
														{{ $message }}
												</span>
											@enderror
										</div>  
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('script')
    <script>
		function photoPreview(input , image ) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
				$(image).attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]); // convert to base64 string
			}
		}
		$("#photo").change(function() {
			photoPreview(this , '#photo_pr');
		});
    </script>
@endpush
