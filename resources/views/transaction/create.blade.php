<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 9 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../../../">
	<meta charset="utf-8" />
    <title>MySoto - APPs -  ver1.0.0</title>
	<meta name="description" content="Login page example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />

	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->


	<!--begin::Page Custom Styles(used by this page)-->
	<link href="{{ asset('assets/css/pages/login/classic/login-6.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Page Custom Styles-->

	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->

	<!--begin::Layout Themes(used by all pages)-->

	<link href="{{ asset('assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Layout Themes-->

	<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body"
	class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-6 login-signin-on login-signin-on d-flex flex-column-fluid" id="kt_login">
			<div class="d-flex flex-column flex-lg-row flex-row-fluid text-center"
				style="background-image: url(assets/media/bg/bg-3.jpg);">
				<!-- <div class="d-flex w-100 flex-center p-15">
					<div class="login-wrapper">
						<div class="text-dark-75">
							<a href="#">
								<img src="{{ asset('assets/media/logos/logo-letter-13.png') }}" class="max-h-75px" alt="" />
							</a>
							<h3 class="mb-8 mt-22 font-weight-bold">JOIN OUR GREAT COMMUNITY</h3>
							<p class="mb-15 text-muted font-weight-bold">
								The ultimate Bootstrap & Angular 6 admin theme framework for next generation web apps.
							</p>
						</div>
					</div>
				</div>

				<div class="login-divider">
					<div></div>
				</div> -->

				<!--begin:Content-->
				<div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
					<div class="login-wrapper">
						<!--begin:Sign In Form-->
						<div class="login-signin">
							<div class="text-center mb-10 mb-lg-20">
								<h2 class="font-weight-bold">Create transaction</h2>
								<p class="text-muted font-weight-bold">Enter your transaction</p>
							</div>
							@if(session('errors'))
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									Something it's wrong:
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
									<ul>
									@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
									</ul>
								</div>
							@endif
							@if(session()->has('message'))
								<div class="alert alert-success">
									{{ session()->get('message') }}
								</div>
							@endif
							@if(session()->has('error'))
								<div class="alert alert-danger">
									{{ session()->get('error') }}
								</div>
							@endif
							<form class="form text-left" id="kt_login_signin_form" method="post" action="{{ route('transaction.store') }}">
								@csrf
								<div class="form-group py-2 m-0">
									<label for="sel1">Journal:</label>
									<select class="form-control" name="journal_id">
										@foreach ($journals as $row)
										<option value="{{ $row->id }}"> {{$row->name}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group py-2 m-0">
									<label for="sel1">Vendor:</label>
									<select class="form-control" name="vendor_id">
										@foreach ($vendors as $row)
										<option value="{{ $row->id }}"> {{ $row->name }} ({{ $row->description }})</option>
										@endforeach
									</select>
								</div>
								<div class="form-group py-2 m-0">
									<label for="sel1">Tanggal Transaksi:</label>
									<input placeholder="ex : 2020 - 12 - 12" type="text" class="form-control datepicker" name="date_at">
								</div>
								<div class="form-group py-2 border-top m-0">
									<label for="sel1">Nama Transaksi:</label>
									<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text"
										name="name" />
								</div>
								<div class="form-group py-2 border-top m-0">
									<label for="sel1">Dekripsi:</label>
									<textarea class="description" name="description"></textarea>
								</div>
								<div class="form-group py-2 border-top m-0">
									<label for="sel1">Nilai Transaksi:</label>
									<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text"
										placeholder="0" name="amount" />
								</div>
								<div class="text-center mt-15">
									<button id="kt_login_signin_submit"
										class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">Save</button>
								</div>
							</form>
						</div>
						<!--end:Sign In Form-->
					</div>
				</div>
				<!--end:Content-->
			</div>
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->

	<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
	<!--begin::Global Config(global config for global JS scripts)-->
	<script>
		var KTAppSettings = {
			"breakpoints": {
				"sm": 576,
				"md": 768,
				"lg": 992,
				"xl": 1200,
				"xxl": 1400
			},
			"colors": {
				"theme": {
					"base": {
						"white": "#ffffff",
						"primary": "#3699FF",
						"secondary": "#E5EAEE",
						"success": "#1BC5BD",
						"info": "#8950FC",
						"warning": "#FFA800",
						"danger": "#F64E60",
						"light": "#E4E6EF",
						"dark": "#181C32"
					},
					"light": {
						"white": "#ffffff",
						"primary": "#E1F0FF",
						"secondary": "#EBEDF3",
						"success": "#C9F7F5",
						"info": "#EEE5FF",
						"warning": "#FFF4DE",
						"danger": "#FFE2E5",
						"light": "#F3F6F9",
						"dark": "#D6D6E0"
					},
					"inverse": {
						"white": "#ffffff",
						"primary": "#ffffff",
						"secondary": "#3F4254",
						"success": "#ffffff",
						"info": "#ffffff",
						"warning": "#ffffff",
						"danger": "#ffffff",
						"light": "#464E5F",
						"dark": "#ffffff"
					}
				},
				"gray": {
					"gray-100": "#F3F6F9",
					"gray-200": "#EBEDF3",
					"gray-300": "#E4E6EF",
					"gray-400": "#D1D3E0",
					"gray-500": "#B5B5C3",
					"gray-600": "#7E8299",
					"gray-700": "#5E6278",
					"gray-800": "#3F4254",
					"gray-900": "#181C32"
				}
			},
			"font-family": "Poppins"
		};
	</script>
	<!--end::Global Config-->

	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<!--end::Global Theme Bundle-->

	<script type="text/javascript">
		$(function(){
			$(".datepicker").datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true,
			});
		});
	</script>
	<script>
		tinymce.init({
			selector:'textarea.description',
			height: 300
		});
	</script>


	<!--begin::Page Scripts(used by this page)-->
	<!-- <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script> -->
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>