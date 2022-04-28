<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
	<head>
		<title>@yield('title','Dashboard')</title>
		@include('dashboard.include.meta')
		@include('dashboard.include.fonts')
		@include('dashboard.include.css')
		@stack('css')
	</head>
	<body 
		@auth('admin')
			class="horizontal-layout horizontal-menu 2-columns menu-expanded" 
		@else
			class=" horizontal-layout horizontal-menu 2-columns menu-expanded blank-page blank-page"
		@endauth
		data-open="hover"
		data-menu="horizontal-menu" 
		data-col="2-columns"
	>
		@auth('admin')
			@include('dashboard.include.navbar')
  			{{-- @include('dashboard.include.sidebar') --}}
			<div class="app-content content">
				@yield('content')
			</div>
		@else
			<div class="app-content content">
				@yield('content')
			</div>
		@endauth
 		@include('dashboard.include.js')
		@stack('script')
	</body>
</html>