<?php
$page_title = 'All Completed Orders';
$breadcrumb = ["Home", $page_title];
$empty = true;
?>

@push('scripts')
    
    <!-- Theme JS files -->
    <script src="assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="assets/js/pages/list.js"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

<div class='content m-2'>
    <!-- <div class="text-right mb-2">
        <a href="/p/create" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="icon-add"></i></b> Add New Product</a>
    </div> -->

    <div class="card">
        <div class="card-header">
            <div class="header-elements-inline">
                <h5 class="card-title font-weight-semibold">All Completed Orders</h5>
                <div class="header-elements">
                    <span>Total completed orders: </span>
                    <span class="font-weight-bold text-danger ml-2">0</span>
                    <div class="list-icons ml-3">
                        <div class="dropdown position-static">
                            <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="icon-cog3"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item"><i class="icon-sync"></i> Update data</a>
                                <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a>
                                <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"><i class="icon-cross3"></i> Clear list</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="datatable-header border-0 pl-0 pr-0">
                <div id="" class="dataTables_filter mb-1"><label><span>Filter:</span>
                        <input type="search" id="search" placeholder="" aria-controls=""></label>
                </div>
                <div class="dataTables_length mb-1">
                    <label><span>Show:</span>
                        <select name="show" id="table_length">
                            <option value="3">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="all">All</option>
                        </select>
                    </label>
                </div>
            </div>

        </div>


        <!-- Tabs content -->
        <!-- <div class="tab-content card-body p-0"> -->

            <!-- Active orders -->
            <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable" id="active-orders-table">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Client Name</th>
                                <th>Product Name</th>
                                <th class=" sort">Number of Payments Made <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th>Start Date</th>
                                <th>Last Payment Date</th>
                                <th class=" sort">Price <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class=" sort">Repay Price <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th>Repay Period</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders)
                                @foreach ($orders as $i => $ord)
                                    @if ($ord->status == 1) {{ $empty = false }} 
                                        <tr>
                                            <td>
                                                <img src="<?= asset('storage/'.$ord->client->photo) ?>" height="60" class="rounded border" />
                                            </td>
                                            <td class="text-capitalize">
                                                <a class="text-secondary font-weight-semibold" href="<?= route('client.profile', [$ord->id]) ?>"><?= $ord->client->surname . ' ' . $ord->client->first_name . ' ' . $ord->client->second_name ?></a>
                                            </td>
                                            <td class="text-capitalize">
                                                <a class="text-secondary font-weight-semibold" href="<?= route('product.profile', [$ord->id]) ?>"><?= $ord->product->name . ' ' . $ord->product->color ?></a>
                                            </td>
                                            <td>
                                                <?= $ord->npayment ?>
                                            </td>
                                            <td>
                                                <?= $ord->created_at ?>
                                            </td>
                                            <td>
                                                <?= $ord->last_paid ?>
                                            </td>
                                            <td class="text-secondary">
                                                    <?= '₦' . $ord->product->price ?>
                                            </td>
                                            <td>
                                                <span><?= '₦' . $ord->product->repay_price ?></span>
                                            </td>
                                            <td>
                                                <span><?= ucfirst($ord->product->repay_period) ?></span>
                                            </td>
                                        </tr>
                                    @endif
                                    
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <div id="table-placeholder" <?= (!$empty) ? "style='display:none; font-size: 16px;'" : '' ?>>
                    <p class="text-center p-3">No completed orders</p>
                </div>
            <?php $empty = true ?>
        </div>
        <!-- /tabs content -->

    </div>
</div>

@endsection
