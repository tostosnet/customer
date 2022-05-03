<?php
$page_title = 'Dashboard';
$breadcrumb = ["Home", $page_title];
?>
@push('scripts')
    
    <!-- Theme JS files -->
    <link href="{{ asset('css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css"> -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/support.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userdash_1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user-dash3.css') }}">
    

    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <!-- <script type="text/JavaScript" src="{{ asset('js/main.js') }}"></script> -->
    <script src="{{ asset('support.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('js/plugins/notifications/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/plugins/notifications/pnotify.min.js') }}"></script>

    <script src="{{ asset('js/demo_pages/dashboard.js') }}"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')

@section('content')

    <!-- Content area -->
    <div class="content m-2">

        <!-- Dashboard content -->
                <div class="cards-container pt-2" style="width: 100%;">
                    <div class="cards2">
                        <div class="card-one" style="background-color: rgb(6, 6, 56); border-radius: .7rem; height: 18rem;">
                            <ul style="padding-left: 1rem; padding-top: .7rem;">
                                <li><i class="icon-meter-slow mr-3" style="font-size: 1.1em; color: rgb(128, 241, 128);"></i>Automobile</li>
                                <li><i class="icon-iphone mr-3" style="font-size: 1.1rem; color: rgb(128, 241, 128);"></i>Phones & Tablets</li>
                                <li><i class="icon-headphones mr-3" style="font-size: 1.1rem; color: rgb(128, 241, 128);"></i>Electronics</li>
                                <li><i class="icon-screen3 mr-3" style="font-size: 1.1rem; color: rgb(128, 241, 128);"></i>Computing</li>
                                <li><i class="icon-home7 mr-3" style="font-size: 1.1rem; color: rgb(128, 241, 128);"></i>Home & Office</li>
                                <li><i class="icon-man-woman mr-3" style="font-size: 1.1rem; color: rgb(128, 241, 128);"></i>Fashion</li>
                                <li><i class="icon-calculator mr-3" style="font-size: 1.1rem; color: rgb(128, 241, 128);"></i>Gaming</li>
                                <li><i class="icon-list2 mr-3" style="font-size: 1.1rem; color: rgb(128, 241, 128);"></i>Other categories</li>
                                

                                
                            </ul>
                        </div>
                        
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="card-two d-flex justify-content-between" style=" background-color: #ff8315; border-radius: .7rem;">
            <div class="img-text d-flex" style="flex-direction: column; line-height: 1px;">
                <h1 > NOW ON PAYFORMAT</h1>
                <div class="under" style="border-bottom: 3px solid #ffe008; width: 60%;"></div>
                <h3 style="color: #eef9ff;">The latest</h3>
                <h3 style="line-height: .3rem;"><span style="color: rgb(6, 6, 56); font-weight: 600;">iPhone 13 pro max</span></h3>
                <h3 style="font-weight: 600; color: #eef9ff;">&<span style="color: rgb(6, 6, 56); font-weight: 600;"> macbook laptops</span></h3>
                <div class="under" style="border-bottom: 3px solid #ffe008; width: 60%;"></div>
                <h1 style=" line-height: 2rem; color: #eef9ff; font-weight: 600;">UP TO <span style="color: rgb(6, 6, 56); font-weight: 700;">25%</span> OFF</h1>
            </div>
            <img src="assets/images/APPLE DEVICES.png" height="91%" width="48%" style="margin-top: 4.8%; background-color: rgb(230, 215, 178); border-radius: .8rem;">
            <div class="shop-btn">
                <a href="#"> Shop Now</a>
                <div class="icon4" style=" background-color: #0a99dc; position: absolute; right: 0; border-radius: 1.1rem; color: rgb(6, 6, 56);">
                    <i class="icon-arrow-right8" style="font-size: 1.1rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-item">
        <div class="card-two d-flex justify-content-between" style="background-color: #ff8315; border-radius: .7rem;">
            <div class="img-text d-flex" style="flex-direction: column; line-height: 1px;">
                <h1>
                    NOW ON PAYFORMAT
                </h1>
                <div class="under" style="border-bottom: 3px solid #ffe008; width: 60%;"></div>
                <h3 style="color: #eef9ff;">The latest</h3>
                <h3 style="line-height: .3rem;"><span style="color: rgb(6, 6, 56); font-weight: 600;">iPhone 13 pro max</span></h3>
                <h3 style="font-weight: 600; color: #eef9ff;">&<span style="color: rgb(6, 6, 56); font-weight: 600;"> macbook laptops</span></h3>
                <div class="under" style="border-bottom: 3px solid #ffe008; width: 60%;"></div>
                <h1 style=" line-height: 2rem; color: #eef9ff; font-weight: 600;">UP TO <span style="color: rgb(6, 6, 56); font-weight: 700;">25%</span> OFF</h1>
            </div>
            <img src="assets/images/laptop.png" height="91%" width="48%" style="margin-top: 4.8%; background-color: rgb(230, 215, 178); border-radius: .8rem;">
            <div class="shop-btn">
                <a href="#"> Shop Now</a>
                <div class="icon4" style=" background-color: #0a99dc; position: absolute; right: 0; border-radius: 1.1rem; color: rgb(6, 6, 56);">
                    <i class="icon-arrow-right8" style="font-size: 1.1rem;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel-item">
        <div class="card-two d-flex justify-content-between" style="background-color: #ff8315; border-radius: .7rem;">
            <div class="img-text d-flex" style="flex-direction: column; line-height: 1px;">
                <h1>
                    NOW ON PAYFORMAT
                </h1>
                <div class="under" style="border-bottom: 3px solid #ffe008; width: 60%;"></div>
                <h3 style="color: #fff;">The latest</h3>
                <h3 style="line-height: .3rem;"><span style="color: rgb(6, 6, 56); font-weight: 600;">iPhone 13 pro max</span></h3>
                <h3 style="font-weight: 600; color: #fff;">&<span style="color: rgb(6, 6, 56); font-weight: 600;"> macbook laptops</span></h3>
                <div class="under" style="border-bottom: 3px solid #ffe008; width: 60%;"></div>
                <h1 style=" line-height: 2rem; color: #fff; font-weight: 600;">UP TO <span style="color: rgb(6, 6, 56); font-weight: 700;">25%</span> OFF</h1>
            </div>
            <img src="assets/images/APPLE DEVICES.png" height="91%" width="48%" style="margin-top: 4.8%; background-color: rgb(230, 215, 178); border-radius: .8rem;">
            <div class="shop-btn">
                <a href="#"> Shop Now</a>
                <div class="icon4" style=" background-color: #0a99dc; position: absolute; right: 0; border-radius: 1.1rem; color: rgb(6, 6, 56);">
                    <i class="icon-arrow-right8" style="font-size: 1.1rem;"></i>
                </div>
            </div>
        </div>
    </div>
  </div>
  <a class="carousel-control-prev pr-5" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next pl-5" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                        
                    </div>

                    <div class="box-section" >
                        <div class="box-header" style="background-color: rgb(6, 6, 56);">
                           <div class="lists">
                               <h6>Flash sales <span class="line"></span></h6>
                               <h6>Free Delivery <span class="line line2"></span></h6>
                               <h6>Time Left: 23 : 15 : 42</h6>
                           </div>
                            
                            <div class="see">
                                <h6>SEE ALL</h6>
                                <i class="icon-arrow-right32 ml-3" style="color: #eef9ff;"></i>
                                
                            </div>
                        </div>
                        
                        <div class="card-row">
                            <div class="card-box d-flex flex-column align-items-center" style="background-color: #eef9ff; height: 17rem;">
                                <h4>Samsung HD TV</h4>
                                <div class="imgbox" style="width: 150px; height: 150px;">
                                    <img src="assets/images/tv.png" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <h5 style="font-weight: 500;">₦424,000</h5>
                                <div class="icon2" style="color: #ff8315;">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="card-box-footer text-center d-flex align-items-center justify-content-center" style="background-color: rgb(44, 228, 44); height: 2.5rem; width: 100%; margin-top: .7rem; color: #eef9ff; font-size: .8rem;">
                                    <i class="icon-cart2 text-center" style="font-size: 1rem; margin-right: .5rem;"></i>
                                    <h4 style="font-size: .9rem; margin-left: .3rem; margin-top: .3rem;">Add to cart</h4>
                                </div>
                            </div>
                            <div class="card-box d-flex flex-column align-items-center" style="background-color: #eef9ff; height: 17rem;">
                                <h4>Samsung HD TV</h4>
                                <div class="imgbox" style="width: 150px; height: 150px;">
                                    <img src="assets/images/tv.png" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <h5 style="font-weight: 500;">₦424,000</h5>
                                <div class="icon2" style="color: #ff8315;">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="card-box-footer text-center d-flex align-items-center justify-content-center" style="background-color: rgb(44, 228, 44); height: 2.5rem; width: 100%; margin-top: .7rem; color: #eef9ff; ">
                                    <i class="icon-cart2 text-center" style="font-size: 1rem; margin-right: .5rem;"></i>
                                    <h4 style="font-size: .9rem; margin-left: .3rem; margin-top: .3rem;">Add to cart</h4>
                                </div>
                            </div>
                            <div class="card-box d-flex flex-column align-items-center" style="background-color: #eef9ff; height: 17rem;">
                                <h4>Samsung HD TV</h4>
                                <div class="imgbox" style="width: 150px; height: 150px;">
                                    <img src="assets/images/tv.png" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <h5 style="font-weight: 500;">₦424,000</h5>
                                <div class="icon2" style="color: #ff8315;">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="card-box-footer text-center d-flex align-items-center justify-content-center" style="background-color: rgb(44, 228, 44); height: 2.5rem; width: 100%; margin-top: .7rem; color: #eef9ff; font-size: .8rem;">
                                    <i class="icon-cart2 text-center" style="font-size: 1rem; margin-right: .5rem;"></i>
                                    <h4 style="font-size: .9rem; margin-left: .3rem; margin-top: .3rem;">Add to cart</h4>
                                </div>
                            </div>
                            <div class="card-box d-flex flex-column align-items-center" style="background-color: #eef9ff; height: 17rem;">
                                <h4>Samsung HD TV</h4>
                                <div class="imgbox" style="width: 150px; height: 150px;">
                                    <img src="assets/images/tv.png" style="width: 100%; height: 100%; object-fit: contain;">
                                </div>
                                <h5 style="font-weight: 500;">₦424,000</h5>
                                <div class="icon2" style="color: #ff8315;">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="card-box-footer text-center d-flex align-items-center justify-content-center" style="background-color: rgb(44, 228, 44); height: 2.5rem; width: 100%; margin-top: .7rem; color: #eef9ff; font-size: .8rem;">
                                    <i class="icon-cart2 text-center" style="font-size: 1rem; margin-right: .5rem;"></i>
                                    <h4 style="font-size: .9rem; margin-left: .3rem; margin-top: .3rem;">Add to cart</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                </div>
        <!-- /dashboard content -->
    </div>
    <!-- /content area -->

@endsection
