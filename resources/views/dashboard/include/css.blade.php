@if(LaravelLocalization::getCurrentLocaleDirection() == 'ltr')
	<link 
  		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css/vendors.css')}}"
	>
	<link 
		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/vendors/css/extensions/toastr.css')}}"
	>

	<link 
  		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css/app.css')}}"
	>

	<link 
		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css/core/menu/menu-types/horizontal-menu.css')}}"
	>
  	<link 
		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css/core/colors/palette-gradient.css')}}"
	>
	
@else

	<link 
  		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css-rtl/vendors.css')}}"
	>
	<link 
		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/vendors/css/extensions/toastr.css')}}"
	>

	<link 
  		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css-rtl/app.css')}}"
	>

	<link 
		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css-rtl/core/menu/menu-types/horizontal-menu.css')}}"
	>
  	<link 
		rel="stylesheet" 
		type="text/css" 
		href="{{asset(env('ASSETS_BATH').'app-assets/css-rtl/core/colors/palette-gradient.css')}}"
	>
	<link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&display=swap" rel="stylesheet">
	
	<style>
		html{ 
				font-family: 'Cairo', sans-serif !important;
		}
		body{
				font-family: 'Cairo', sans-serif !important;
		}
		h1,h2,h3,h4,h5,h6,span,p,div,section,form,input,ul,ol,li,a{
				font-family: 'Cairo', sans-serif !important;
		}
   </style>
	
@endif
  	