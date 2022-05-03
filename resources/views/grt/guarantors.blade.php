<?php
$page_title = 'All Guarantors';
$breadcrumb = ["Home", $page_title];

if (! isset($guarantors)) exit(404);
?>

@push('scripts')
    
    <!-- Theme JS files -->
    <script src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pages/list.js') }}"></script>
    <!-- /theme JS files -->

@endpush

@extends('layouts.app')


@section('content')

<div class='content m-2'>
    <div class="text-right mb-2">
        <a href="c/create" class="btn btn-primary btn-labeled btn-labeled-left add_client_btn"><b><i class="icon-add"></i></b> Add New Client</a>
    </div>

    <div class="card">
        <div class="card-header p-0">
            <div class="header-elements-inline" style="border-bottom: 1px solid #ddd;">
                <h5 class="card-title font-weight-semibold p-3">All Guarantors</h5>
                <div class="header-elements pr-3">
                    <span class="">Total guarantors: </span>
                    <span class="font-weight-bold text-danger ml-2 bg-light rounded" style="padding: 1px 8px;"><?= count($guarantors) ?></span>
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
            <div class="datatable-header border-0 pl-3 pr-3">
                <div id="" class="dataTables_filter mb-1">
                    <label>
                        <span>Filter:</span>
                        <input type="search" id="search" placeholder="" aria-controls="">
                    </label>
                </div>
                <div class="dataTables_length mb-1">
                    <label><span>Show:</span>
                        <select name="show" id="table_length" class="">
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

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified mb-0">
                <li class="nav-item">
                    <a href="#on_install" class="nav-link active" data-toggle="tab">
                        On Installment
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#complete" class="nav-link" data-toggle="tab">
                        Completed
                    </a>
                </li>
            </ul>
            <!-- /tabs -->
        </div>


        <!-- Tabs content -->
        <div class="tab-content card-body p-0">

            <!-- product Available tab -->
            <div class="tab-pane fade active show" id="on_install">
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="guarantors-table">
                        <colgroup>
                            <!-- <col span="1" style="background-color: #fff">
                            <col span="7" style="background-color: #f7fcfc"> -->
                            <!-- <col span="3" style="background-color: #D6EEEE"> -->
                        </colgroup>
                        <thead>
                            <tr class="">
                                <th class="text-center">ID</th>
                                <th class="text-center">Photo</th>
                                <th class="text-center sort">Name <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="text-center"><i class="icon-location3 text-indigo mr-1"></i> Address</th>
                                <th class="text-center"><i class="icon-phone2 text-success mr-1"></i> Phone number</th>
                                <th class="text-center"><i class="icon-google-plus text-danger mr-1"></i> Email Address</th>
                                <th class="text-center sort">Gender</th>
                                <th class="text-center sort">Verified</th>
                                <th class="text-center">Client ID</th>
                                <th class="text-center" id="table-hide" style="width: 20px;"><i class="icon-arrow-down12 cursor-pointer" onclick="toggleTableVisibility(this, '#guarantors-table tbody')"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($guarantors as $i => $grt) : ?>
                                <tr>
                                    <td class="text-center">
                                        <h6 class="font-weight-semibold mb-0"><?= $grt->id ?></h6>
                                    </td>
                                    <td>
                                        <div class="">
                                            <img src="<?= asset('storage/'.$grt->photo) ?>" alt="<?= $grt->photo ?>" width="50" height="50" class="rounded-circle">
                                        </div>
                                    </td>
                                    <td class="font-weight-semibold text-center">
                                        <div>
                                            <?= ucfirst($grt->surname . ' ' . $grt->first_name . ' ' . $grt->second_name) ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class=""><?= $grt->street . ', ' . $grt->city . ', ' . $grt->state ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php $tel1 = $grt->phone_number;
                                        $tel2 = $grt->phone_number2 ? $grt->phone_number2 : '' ?>
                                        <a href="tel:<?= $tel1 ?>"><?= $tel1 ?></a>
                                        <?= $tel2 ? " | <a href='tel:$tel2'>$tel2</a>" : '' ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="mailto:<?= $grt->email ?>"><?= $grt->email ?></a>
                                    </td>
                                    <td class="text-center">
                                        <span class=""><?= ucfirst($grt->gender) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class=""><?= $grt->verified ? '<i class="icon-check text-success" title="Verified"></i>' : '<i class="icon-cross2 text-danger" title="Not Verified"></i>' ?></span>
                                    </td>
                                    <td class="text-center font-weight-semibold">
                                        <span class=""><?= $grt->client_id ?></span>
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7" style="color: #a241cf;"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?= route('grt.profile', [$grt->id]) ?>" class="dropdown-item"><i class="icon-eye"></i> View Guarantor</a>
                                                    <a href="<?= route('client.profile', [$grt->client_id]) ?>" class="dropdown-item"><i class="icon-eye"></i> View Client</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" class="dropdown-item"><i class="icon-bin text-danger"></i> Delete data</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>

            <!-- product on installment -->
            <div class="tab-pane fade" id="complete">
                
            </div>

        </div>
        <!-- /tabs content -->

        <div class="card-footer">
            <?php // include('paging.php') ?>
        </div>

    </div>
</div>

@endsection
