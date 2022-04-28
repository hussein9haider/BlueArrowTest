@extends('dashboard.layouts.app')


@section('content')
	<div class="content-wrapper">
		<div class="content-body container mt-4">
			<div 
				@if($note->type == "urgent")
					class="card bg-gradient-y-pink text-white" 
				@elseif ($note->type == "normal")
					class="card bg-gradient-y-primary text-white"
				@else
					class="card bg-gradient-y-amber text-white"
				@endif
			>
				<div class="card-header">
					<h4 class="card-title"></h4>
					<a class="heading-elements-toggle text-white">
						<i class="la la-ellipsis-v font-medium-3"></i>
					</a>
					<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li>
							<a class="delete btn btn-icon btn-table square"  href="#">
								<i class="ft-share-2"></i>
							</a>
						</li>
						
						@auth('admin')
							@if (auth('admin')->user()->id == $note->admin_id)
								<li>
									<a
										type="button" 
										class="delete btn btn-icon btn-table square" 
										data-toggle="modal" 
										data-target="#delete"
										data-url="{{route('dashboard.notes.delete',$note->id)}}"
									>
										<i class="ft-trash"></i>
									</a>
								</li>
							@endif
							
						@endauth
						
					</ul>
					</div>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="row">
							<div 
								@if($note->photo)
									class="col-12 col-lg-4"
								@else
									class="col-0 col-lg-0"
								@endif
							>
								<img width="100%" src="{{$note->photo}}">
							</div>
							<div 
								@if($note->photo)
									class="col-12 col-lg-8"
								@else
									class="col-12 col-lg-12"
								@endif
							>
								<h4 class="card-title text-white">{{$note->title}}</h4>
								<p class="card-text content-text-dot">
									{{$note->content}}
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


