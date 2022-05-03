<?php
$page_title = 'All Clients';
$breadcrumb = ["Home", $page_title];
if (! isset($clients)) exit(404);
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
                    <h5 class="card-title font-weight-semibold p-3">All Clients</h5>
                    <div class="header-elements pr-3">
                        <span class="">Total clients: </span>
                        <span class="font-weight-bold text-danger ml-2 bg-light rounded" style="padding: 1px 8px;"><?= count($clients) ?></span>
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

                {{-- filter tools --}}
                {{-- <table class="pma-table navigation nospacing nopadding print_ignore">
                    <tbody>
                        <tr>
                            <td class="navigation_separator"></td>
                            <td><form action="index.php?route=/sql" method="post">
                                    <input type="checkbox" name="navig" id="showAll_845877168" class="showAllRows" value="all" checked="">
                                    <label for="showAll_845877168">Show all</label>
                                </form></td>
                            <td><div class="navigation_separator">|</div></td>
                            <td class="navigation_goto">
                                <form action="index.php?route=/sql" method="post" id="maxRowsForm">
                                    <label for="sessionMaxRowsSelect">Number of rows:</label>
                                    <select class="autosubmit" name="session_max_rows" id="sessionMaxRowsSelect">
                                        <option value="" disabled="" selected="">All</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="250">250</option>
                                        <option value="500">500</option>
                                    </select>
                                </form>
                            </td>
                            <td class="largescreenonly">
                                <span>Filter rows:</span>
                                <input type="text" class="filter_rows" placeholder="Search this table" data-for="845877168">
                            </td>
                            <td class="largescreenonly">
                                <form action="index.php?route=/sql" method="post" class="print_ignore">
                                    <label for="sql_query">Sort on</label>
                                    <select name="sql_query" class="autosubmit">
                                        <option value="SELECT * FROM `payments`   ORDER BY `id` ASC">PRIMARY (ASC)</option>
                                        <option value="SELECT * FROM `payments`   ORDER BY `id` DESC">PRIMARY (DESC)</option>
                                        <option value="SELECT * FROM `payments`  " selected="">None</option>
                                    </select>
                                </form> 
                            </td>
                            <td class="navigation_separator"></td>
                        </tr>
                    </tbody>
                </table> --}}

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
                        <table class="table table-hover text-nowrap dataTable" id="clients-table">
                            <colgroup>
                                <col span="9" style="background-color: #fff">
                                <col span="1" style="background-color: #f7fcfc">
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
                                    <th class="text-center">Joined date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clients as $i => $client) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <h6 class="font-weight-semibold mb-0"><?= $client->id ?></h6>
                                        </td>
                                        <td>
                                            <div class="">
                                                <a href="<?= route('client.profile', [$client->id]) ?>">
                                                    <img src="<?= asset('storage/'.$client->photo) ?>" alt="<?= asset('storage/'.$client->photo) ?>" height="50" class="rounded-circle">
                                                </a>
                                            </div>
                                        </td>
                                        <td class="font-weight-semibold text-center">
                                            <div>
                                                <a href="<?= route('client.profile', [$client->id]) ?>" class="text-secondary">
                                                <?= ucfirst($client->surname . ' ' . $client->first_name . ' ' . $client->second_name) ?></a>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class=""><?= $client->street . ', ' . $client->city . ', ' . $client->state ?></span>
                                        </td>
                                        <td class="text-center">
                                            <?php $tel1 = $client->phone_number;
                                            $tel2 = $client->phone_number2 ? $client->phone_number2 : '' ?>
                                            <a href="tel:<?= $tel1 ?>"><?= $tel1 ?></a>
                                            <?= $tel2 ? " | <a href='tel:$tel2'>$tel2</a>" : '' ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="mailto:<?= $client->email ?>"><?= $client->email ?></a>
                                        </td>
                                        <td class="text-center">
                                            <span class=""><?= ucfirst($client->gender) ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class=""><?= $client->verified ? '<i class="icon-check text-success" title="Verified"></i>' : '<i class="icon-cross2 text-danger" title="Not Verified"></i>' ?></span>
                                        </td>
                                        <td class="text-center">
                                            <span class=""><?= $client->created_at ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- product on installment -->
                <div class="tab-pane fade" id="complete">
                    {{-- to be filled later --}}
                </div>

            </div>
            <!-- /tabs content -->

        </div>

    </div>
@endsection
