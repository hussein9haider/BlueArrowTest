	<script 
		src="{{asset(env('ASSETS_BATH').'app-assets/vendors/js/vendors.min.js')}}" 
		type="text/javascript">
	</script>
  	<script 
		src="{{asset(env('ASSETS_BATH').'app-assets/vendors/js/ui/jquery.sticky.js')}}"
  		type="text/javascript">
	</script>
  	<script 
  		src="{{asset(env('ASSETS_BATH').'app-assets/js/core/app-menu.js')}}" 
  		type="text/javascript">
	</script>
  	<script 
		src="{{asset(env('ASSETS_BATH').'app-assets/js/core/app.js')}}" 
		type="text/javascript">
	</script>
  	<script 
	  src="{{asset(env('ASSETS_BATH').'app-assets/js/scripts/customizer.js')}}" 
	  type="text/javascript">
	</script>
	<script 
		src="{{asset(env('ASSETS_BATH').'app-assets/vendors/js/extensions/toastr.min.js')}}" 
		type="text/javascript">
	</script>
	@if(session()->has('success'))
		<script> 
			$(document).ready(function () {
				if($('html').data('textdirection') == "ltr"){
					toastr.success("{{session()->get('success')}}",'', {"closeButton": true,"progressBar": true});	
				}else{
					toastr.options.rtl = true;
					toastr.success("{{session()->get('success')}}",'',
					{positionClass: 'toast-top-left', containerId: 'toast-top-left',"closeButton": true,"progressBar": true });
				}
			}); 
		</script>
   @endif


