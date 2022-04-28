@extends('dashboard.layouts.app')
@push('css')
	<style type="text/css">
		.content-text-dot{
			display: -webkit-box;
			-webkit-line-clamp: 8;
			-webkit-box-orient: vertical;
			overflow: hidden;
		}
		.dropdown-item:active{
			background-color:transparent !important;
		}
		.pagination  .page-link{
			color: #E91E63;
		}
		.pagination .active .page-link{
			z-index: 1;
   		border-color: #C2185B !important;
    		background-color: #E91E63 !important;
    		color: #FFFFFF;
		}
	</style>
@endpush
@section('content')
 <div class="content-wrapper">
      <div class="content-body">	
			<section>
				<div class="row">
					<div class="col-12 col-lg-3">
						<a class="btn btn-pink  dark" href="{{route('dashboard.notes.create')}}">{{__('dashboard.new notes')}}</a>
						<div class="mt-2">
							<div class="dropdown show">
								<div class="dropdown-menu show" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
									<a href="?type=urgent" class="dropdown-item" type="button">
										<span class="mr-1 badge badge-pill badge-default badge-danger badge-glow">
											{{App\Models\Note::where('type','urgent')->count()}}	
										</span> {{__('dashboard.urgent')}}
									</a>
									<a href="?type=normal" class="dropdown-item" type="button">
										<span class="mr-1 badge badge-pill badge-default badge-primary badge-glow">
											{{App\Models\Note::where('type','normal')->count()}}	
										</span> {{__('dashboard.normal')}}
									</a>
									<a href="?type=date" class="dropdown-item" type="button">
									<span class="mr-1 badge badge-pill badge-default badge-warning badge-glow">
										{{App\Models\Note::where('type','date')->count()}}	
									</span> 
										{{__('dashboard.date')}}
									</a>
									<div class="dropdown-divider"></div>
									<a href="?" class="dropdown-item" type="button">
									<span class="mr-1 badge badge-pill badge-default badge-secondary badge-glow">
										{{App\Models\Note::count()}}	
									</span> 
										{{__('dashboard.all')}}
									</a>
								</div>
							</div>
						</div>
						<div>
							{!!$notes->appends(request()->query())->links()!!} 
						</div>
					</div>
					<div class="col-12 col-lg-9">
						<div class="row">
							@foreach ($notes as $note )
								<div class="col-12 col-lg-4">
									<div 
										style="height: 300px;"
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
													<span class="btn btn-icon btn-table square clipboard"
														data-clipboard-text="{{route('dashboard.notes.show',[$note->hash,$note->id])}}"
													>
														<i class="ft-share-2"></i>
													</span>
												</li>
												<li>
													<a href="{{route('dashboard.notes.show',[$note->hash,$note->id])}}" class="btn btn-icon btn-table square" >
														<i class="ft-eye"></i>
													</a>
												</li>
												@if ($note->photo)
												<li>
													<a target="_blank" href="{{$note->photo}}" class="btn btn-icon btn-table square" >
														<i class="ft-image"></i>
													</a>
												</li>
												@endif
												
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
											</ul>
											</div>
										</div>
										<div class="card-content collapse show">
											<div class="card-body">
												<h4 class="card-title text-white">{{$note->title}}</h4>
												<p class="card-text content-text-dot">
													{{$note->content}}
												</p>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</section>
      </div>
    </div>

	<div class="modal animated bounce text-left " id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel36" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0">
                <div class="modal-header  border-0 text-white bg-danger">
                    <h4 class="text-white">{{__('dashboard.delete confirmation')}}</h4>
                    <button type="button" class="btn btn-table close text-white border-0" data-dismiss="modal" aria-label="Close">
                        <i class="la la-close"></i>
                    </button>
                </div>
                <div class="modal-body mt-2 mb-2">
                    <h5>{{__('dashboard.are you sure you want to remove')}}</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-secondary square box-shadow-3 text-white" data-dismiss="modal">{{__('dashboard.close')}}</button>
                    <a href="#" id="delete-a" class="btn btn-danger square box-shadow-3 text-white ">{{__('dashboard.delete')}}</a>
                </div>
            </div>
        </div>
   </div>
@endsection
@push('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
	<script>
		var clipboard = new ClipboardJS('.clipboard');
		clipboard.on('success', function(e) {
			if($('html').data('textdirection') == "ltr"){
				toastr.success("Copied",'', {"closeButton": true,"progressBar": true});	
			}else{
				toastr.options.rtl = true;
				toastr.success("Copied",'',
				{positionClass: 'toast-top-left', containerId: 'toast-top-left',"closeButton": true,"progressBar": true });
			}
    		e.clearSelection();
		});
	</script>
	<script>
    $(document).ready(function () {
        $(document).on('click','.delete', function(){
            var url = $(this).attr('data-url');
            $('#delete-a').attr('href' , url );
        });
    });
    $('#delete-a').click(function(e){
        e.preventDefault();
        $('#delete-a').text("{{__('dashboard.deleting')}}");
        setTimeout(function(){
            location.href = $('#delete-a').attr('href');              
        },1500);//end setTimeout function
    });
   </script>
@endpush