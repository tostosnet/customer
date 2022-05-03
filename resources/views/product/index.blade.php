<?php
$page_title = 'All Products';
$breadcrumb = ["Home", $page_title];
$empty = true;
?>

@push('scripts')
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Theme CSS files -->
    <link href="{{ asset('css/fonts.googleapis.com/css1381.css?family=Roboto:400,300,100,500,700,900') }}" rel="stylesheet" type="text/css">
    <!-- <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset('css/icons/icomoon/fonts/styles.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Theme JS files -->
    <script src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pages/list.js') }}"></script>
    <script src="{{ asset('js/demo_pages/ecommerce_product_list.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/plugins/media/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

<div class='content m-2'>
		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">



				<!-- Content area -->
				<div class="content">

					<!-- Grid -->
                     
                                    
					<div class="row">
                            @if ($products)
                                @foreach ($products as $i => $pro)
                                    @if ($pro->status == 1) {{ $empty = false }}
						<div class="col-xl-3 col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="card-img-actions">
										<a href="<?= asset('storage/'.$pro->fimage) ?>" data-popup="lightbox">
											<img src="<?= asset('storage/'.$pro->fimage) ?>" class="card-img" width="96" alt="">
											<span class="card-img-actions-overlay card-img">
												<i class="icon-plus3 icon-2x"></i>
											</span>
										</a>
									</div>
								</div>

								<div class="card-body text-center">
									<div class="mb-2">
										<h6 class="font-weight-semibold mb-0">
                                            <a class="text-secondary font-weight-semibold" href="<?= route('product.profile', [$pro->id]) ?>"><?= $pro->name . ' ' . $pro->color ?></a>
										</h6>

										<a href="#" class="text-muted"><?= $pro->category->name ?></a>
									</div>

									<h3 class="mb-0 font-weight-semibold"><?= '₦' . $pro->price ?></h3>

									<div>
										<i class="icon-star-full2 font-size-base text-warning"></i>
										<i class="icon-star-full2 font-size-base text-warning"></i>
										<i class="icon-star-full2 font-size-base text-warning"></i>
										<i class="icon-star-full2 font-size-base text-warning"></i>
										<i class="icon-star-full2 font-size-base text-warning"></i>
									</div>

									<div class="text-muted mb-3">85 reviews</div>

									<button type="button" class="btn btn-teal"><i class="icon-cart-add mr-2"></i> Add to cart</button>
								</div>
							</div>
						</div>
                        @endif
                                    
                    @endforeach
                @endif

					</div>
					<!-- /grid -->


					<!-- Pagination -->
					<div class="d-flex justify-content-center pt-3 mb-3">
						<ul class="pagination">
							<li class="page-item disabled"><a href="#" class="page-link"><i class="icon-arrow-left8"></i></a></li>
							<li class="page-item active"><a href="#" class="page-link">1</a></li>
							<li class="page-item"><a href="#" class="page-link">2</a></li>
							<li class="page-item"><a href="#" class="page-link">3</a></li>
							<li class="page-item"><a href="#" class="page-link">4</a></li>
							<li class="page-item"><a href="#" class="page-link">5</a></li>
							<li class="page-item"><a href="#" class="page-link"><i class="icon-arrow-right8"></i></a></li>
						</ul>
					</div>
					<!-- /pagination -->

				</div>
				<!-- /content area -->


				<!-- Footer -->
				<div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top">
					<div class="text-center d-lg-none w-100">
						<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
							<i class="icon-unfold mr-2"></i>
							Footer
						</button>
					</div>

					<div class="navbar-collapse collapse" id="navbar-footer">
						<span class="navbar-text">
							&copy; 2015 - 2018. <a href="#">Limitless Web App Kit</a> by <a href="https://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
						</span>

						<ul class="navbar-nav ml-lg-auto">
							<li class="nav-item"><a href="https://kopyov.ticksy.com/" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
							<li class="nav-item"><a href="https://demo.interface.club/limitless/docs/" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> Docs</a></li>
							<li class="nav-item"><a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov" class="navbar-nav-link font-weight-semibold"><span class="text-pink"><i class="icon-cart2 mr-2"></i> Purchase</span></a></li>
						</ul>
					</div>
				</div>
				<!-- /footer -->

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->


		<!-- Right sidebar -->
		<div class="sidebar sidebar-light sidebar-right sidebar-expand-lg" style="min-height: 100vh">

			<!-- Expand button -->
			<button type="button" class="btn btn-sidebar-expand sidebar-control sidebar-right-toggle">
				<i class="icon-arrow-right13"></i>
			</button>
			<!-- /expand button -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- Header -->
				<div class="sidebar-section sidebar-section-body d-flex align-items-center pb-2">
					<h5 class="mb-0">Filters</h5>
					<div class="ml-auto">
						<button type="button" class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-right-toggle d-none d-lg-inline-flex">
							<i class="icon-transmission"></i>
						</button>

						<button type="button" class="btn btn-outline-light text-body border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-right-toggle d-lg-none">
							<i class="icon-cross2"></i>
						</button>
					</div>
				</div>
				<!-- /header -->


				<!-- Categories -->
				<div class="sidebar-section">
					<div class="sidebar-section-header">
						<span class="font-weight-semibold">Categories</span>
					</div>

					<div class="sidebar-section-body">
						<div class="form-group-feedback form-group-feedback-right">
							<input type="search" class="form-control" placeholder="Search">
							<div class="form-control-feedback">
								<i class="icon-search4 font-size-base text-muted"></i>
							</div>
						</div>
					</div>
                    
					<ul class="nav nav-sidebar">
                    @if ($categories)
                    @foreach ($categories as $i => $cat)

						<li class="nav-item nav-item-submenu pt-0">
							<a href="#" class="nav-link"><?= $cat->name ?><span class="text-muted ml-auto font-weight-normal">39</span></a>
							<ul class="nav nav-group-sub">
								<li class="nav-item"><a href="#" class="nav-link">Hoodies</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Jackets</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Pants</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Shirts</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Sweaters</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Tank tops</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Underwear</a></li>
							</ul>
						</li>
                        @endforeach
                    @endif

						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">Snow wear <span class="text-muted ml-auto font-weight-normal">48</span></a>
							<ul class="nav nav-group-sub">
								<li class="nav-item"><a href="#" class="nav-link">Fleece jackets</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Gloves</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Ski jackets</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Ski pants</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Snowboard jackets</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Snowboard pants</a></li>
								<li class="nav-item"><a href="#" class="nav-link">Technical underwear</a></li>
							</ul>
						</li>
					</ul>

				</div>
				<!-- /categories -->


				<!-- Brands -->
				<div class="sidebar-section">
					<div class="sidebar-section-header">
						<span class="font-weight-semibold">Brands</span>
					</div>

					<div class="sidebar-section-body">
						<div class="form-group form-group-feedback form-group-feedback-left">
							<input type="search" class="form-control" placeholder="Search brand">
							<div class="form-control-feedback">
								<i class="icon-search4 font-size-base text-muted"></i>
							</div>
						</div>

						<div class="overflow-auto" style="max-height: 181px;">
							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">686</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">A.Lab</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Adidas</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">ALIS</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Analog</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Burton</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Atomic</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Armada</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">O'Neill</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Baja</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Baker</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Blue Parks</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Billabong</span>
							</label>

							<label class="custom-control custom-checkbox mb-2">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Bonfire</span>
							</label>

							<label class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-label">Brixton</span>
							</label>
						</div>
					</div>
				</div>
				<!-- /brands -->


			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /right sidebar -->

	</div>
	<!-- /page content -->
</div>

@endsection
