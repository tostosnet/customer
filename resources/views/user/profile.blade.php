<?php

$page_title = "User Request";
$breadcrumb = ["Home", $page_title];

?>

@push('scripts')
    
    <!-- Theme JS files -->
    <link href="<?= asset('css/profile.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?= asset('js/plugins/forms/inputs/inputmask.js') ?>"></script>
    <script src="<?= asset('js/plugins/tables/datatables/datatables.min.js') ?>"></script>
    <script src="<?= asset('js/plugins/media/glightbox.min.js') ?>"></script>
    <script src="<?= asset('js/pages/profile.js') ?>"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

<div class="content">
    <!-- Customers -->
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Customer info</h6>
        </div>

        
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin" class="rounded-circle" width="110">
                                    <div class="mt-3">
                                        <h4>John Doe</h4>
                                        <p class="text-secondary mb-1">Full Stack Developer</p>
                                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                                        <a href="mailto:opatolaemmanuel@gmail.com" class="btn btn-primary">Message</a>
                                        <a href="tel:080666666" class="btn btn-outline-primary">Call</a>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <ul class="list-group list-group-flush">
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github me-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                                        <span class="text-secondary">bootdey</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter me-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                                        <span class="text-secondary">@bootdey</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram me-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                                        <span class="text-secondary">bootdey</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook me-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                                        <span class="text-secondary">bootdey</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p class="text1">Odewale Wale John </p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p class="text1">Male</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p class="text1">Odewalejohn@gmail.com</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone1</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p class="text1">070655577333</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone2</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p class="text1">070655577333</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <p class="text1">House 21, Sunview side, Home</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="d-flex align-items-center mb-3">Message</h5>
                                        
                                            <p class="request_message" style="font-size: .9rem;">
                                                Hi. My name is mike and I'd like to request an installment sale of your product. 
                                            </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="buttons">
                            <!-- Default dropup button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle d-inline-flex align-items-center h-100" data-bs-toggle="dropdown" id="dropdownMenuClickable" aria-expanded="false" data-bs-auto-close="true" style="margin-left: 23rem;">
                             Approve
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickable">
                              <!-- Dropdown menu links -->
                              <li>
                                <a href="profile" class="dropdown-item" style="font-size: .8rem;">
                                My profile</a></li>
                            <li>
                                <a href="profile" class="dropdown-item"style="font-size: .8rem;">
                                    My profile</a>
                                </li>
                            <li> <a href="#" class="dropdown-item"style="font-size: .8rem;">
                                My balance</a>
                            </li>
    
                            <li><a href="#" class="dropdown-item"style="font-size: .8rem;">
                                Messages</a> 
                            </ul>
                        </div>
                         
                            <!-- <div class="btn-group dropup"> -->
                               
                                <button type="button" class="btn btn-outline-danger dropdown-toggle d-inline-flex align-items-center h-100" data-bs-toggle="dropdown" id="dropdownMenuClickable" aria-expanded="false" data-bs-auto-close="true">
                                    Decline
                                   </button>
                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickable">
                                     <li>
                                         <a href="profile" class="dropdown-item" style="font-size: .8rem;">
                                         My profile</a></li>
                                     <li>
                                         <a href="profile" class="dropdown-item"style="font-size: .8rem;">
                                             My profile</a>
                                         </li>
                                     <li> <a href="#" class="dropdown-item"style="font-size: .8rem;">
                                         My balance</a>
                                     </li>
                                     
                                     <li><a href="#" class="dropdown-item"style="font-size: .8rem;">
                                         Messages</a>      
                                         <li> <a href="#" class="dropdown-item drop"style="font-size: .8rem;">
                                           Other Reasons
                                        </a>
                                        </li>    
                            </div>
                            <div class="reasons-textarea d-none" style="margin-top: 2rem;">
                                <div class="card">
                                    <div class="card-header header-elements-inline">
                                        <h6 class="card-title">State your reasons</h6>
                                    </div>
    
                                    <div class="card-body">
                                        <form action="#">
                                            <textarea name="enter-message" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>
    
                                            <div class="d-flex align-items-center">
                                                <div class="d-inline-flex">
                                                    <a href="#" class="btn btn-light btn-icon btn-sm border-transparent rounded-pill mr-2" data-popup="tooltip" title="" data-original-title="Add photo"><i class="icon-images2 position-static"></i></a>
                                                    
                                                </div>
    
                                                <button type="button" class="btn btn-primary btn-labeled btn-labeled-right ml-auto pl-3 pr-5"  ><b><i class="icon-paperplane"></i></b> Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /inner content -->

@endsection
