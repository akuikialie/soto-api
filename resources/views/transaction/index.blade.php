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
				<!--begin:Content-->
				<div class="d-flex w-100 flex-center p-25 position-relative overflow-hidden">
					<div class="table-responsive">
						<p>
							<h3>Daftar Jurnal</h3>
						</p>
						<table class="table table-striped">
							<thead>
								<tr>
								<th scope="col">#</th>
								<th scope="col">Name</th>
								<th scope="col">Description</th>
								<th scope="col">Amount</th>
								<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($journals as $row)
								<tr>
									<th scope="row"></th>
									<td>{{ $row->name }}</td>
									<td>{{ $row->description }}</td>
									<td>{{ number_format($row->transactions->sum('amount'), 0, '.', ',') }}</td>
									<td>
										<a href="{{ route('transaction.view', ['id' => $row->id])}}">
											<button type="button" class="btn btn-warning">View</button>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<!--end:Content-->
			</div>
		</div>
		<!--end::Login-->
	</div>
	<!--end::Main-->

	<!--begin::Global Theme Bundle(used by all pages)-->
	<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
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


	<!--begin::Page Scripts(used by this page)-->
	<!-- <script src="{{ asset('assets/js/pages/custom/login/login-general.js') }}"></script> -->
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>