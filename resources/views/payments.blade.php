<?php
$page_title = 'All Payments';
$breadcrumb = ["Home", $page_title];
$header_assets = [
    '<script src="assets/js/plugins/ui/moment/moment.min.js"></script>',
    '<script src="assets/js/plugins/tables/datatables/datatables.min.js"></script>',
    '<script src="assets/js/plugins/pickers/daterangepicker.js"></script>',
    '<script src="assets/js/pages/list.js"></script>',
    '<script src="assets/js/pages/payment.js"></script>'
];

require('layouts/header.php');
$records_per_page = 5;

if (isset($_POST['show'])) {
    $show = $_POST['show'];
    $records_per_page = $show;
}

$payment = new Payment();
$payments = $payment->getRecords();
$total_rows = Payment::$total_rows;

?>


<div class='content'>
    <div class="row">
        <div class="col-xl-9" id="main">
            <div id="payments" class="card">
                <div class="card-header">
                    <div class="header-elements-inline pb-2" style="border-bottom: 1px solid #ddd;">
                        <h4 class="card-title font-weight-semibold">Payments</h4>
                        <div class="header-elements">
                            <span class="">Total rows:</span>
                            <span class="font-weight-bold text-danger ml-2" id="total_rows"><?= $total_rows ?></span>
                            <div class="list-icons ml-3">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="icon-sync"></i> Refresh table</a>
                                        <a href="#" class="dropdown-item"><i class="icon-list-unordered"></i> Detailed log</a>
                                        <a href="#" class="dropdown-item"><i class="icon-pie5"></i> Statistics</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="datatable-header border-0 pl-0 pr-0">
                        <div id="" class="dataTables_filter mb-1">
                            <label>
                                <span>Filter:</span>
                                <input type="search" id="search" placeholder="" aria-controls="">
                            </label>
                        </div>
                        <div class="dataTables_length mb-1">
                            <div class="d-inline-block mr-4">
                                <label><span>Payment Type:</span>
                                    <select name="type" id="payment_type" class="ml-2">
                                        <option value="active">Active</option>
                                        <option value="default">Defaulted</option>
                                        <option value="complete">Completed</option>
                                    </select>
                                </label>
                            </div>
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
                </div>


                <!-- payment content -->
                <div class="card-body p-0">

                    <div class="navigation bg-light p-2 mt-1 pl-4 pr-4">
                        <div class="d-flex flex-row justify-content-between">
                            <!-- prev btn -->
                            <i class="icon-arrow-left15 cursor-pointer" id="prev" style="font-size: 20px"></i>
                            <!-- timer -->
                            <div class="text-center" style="width: 60%">
                                <span id="timer" class="font-weight-semibold"></span>
                            </div>
                            <!-- next btn -->
                            <i class="icon-arrow-right15 cursor-pointer" id="next" style="font-size: 20px"></i>
                        </div>
                    </div>

                    <!-- <div class="table-responsive"> -->
                    <table class="table" id="payment-table">
                        <!-- <colgroup>
                            <col span="1" style="background-color: #f7fcfc; width: 2rem">
                            <col span="2" style="background-color: #D6EEEE">
                            <col span="3" style="background-color: pink">
                            <col span="1" style="background-color: #ffffff; width: 2rem">
                            <col span="1" style="background-color: #f7fcfc; width: 2rem">
                        </colgroup> -->
                        <thead>
                            <tr class="center text-uppercase">
                                <th style="width:10px">ID</th>
                                <th style="width:20px">Photo</th>
                                <th class="sort">Client Name <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="sort">Payment <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="">Period</th>
                                <th class="sort">Total Paid <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="sort">Balance <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="sort">Time <i class="icon-arrow-down12 cursor-pointer sort-icon"></i></th>
                                <th class="text-center" id="table-hide" style="width: 20px;"><i class="icon-arrow-down12 cursor-pointer" onclick="toggleTableVisibility(this, '#payment-table tbody')"></i></th>
                            </tr>
                        </thead>
                        <?php if ($payments) { ?>
                            <tbody>
                                <?php foreach ($payments as $payment) { ?>
                                    <tr>
                                        <td class="font-size-lg font-weight-bold text-center">
                                            <?= $payment->client_id ?>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img src="<?= $payment->data['user_photo']->thumb_url ?>" class="rounded-circle" width="50" height="50" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <span class="font-weight-semibold"><?= ucwords($payment->data['cname']) ?></span>
                                        </td>
                                        <td>
                                            <span class="text-secondary font-weight-bold font-size-lg">₦<?= numToCurrency($payment->amount) ?></span>
                                        </td>
                                        <td>
                                            <?= ucfirst($payment->repay_period) ?>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">₦<?= numToCurrency($payment->total_paid) ?></h6>
                                        </td>
                                        <td>
                                            <span class="">₦<?= numToCurrency($payment->balance) ?></span>
                                        </td>
                                        <td>
                                            <span class=""><?= format_date($payment->time, 't') ?></span>
                                        </td>
                                        <td class="text-center actions">
                                            <div class="list-icons">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="client_profile?id=<?= $payment->client_id ?>" class="dropdown-item view-client"><i class="icon-eye"></i> View Client</a>
                                                        <div class="dropdown-divider"></div>
                                                        <div class="dropdown-item delete"><i class="icon-bin text-danger"></i> Delete payment</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        <?php } ?>
                    </table>
                    <!-- </div> -->

                    <div id="table-placeholder" <?= ($payments) ? "style='display:none; font-size: 16px;'" : '' ?>>
                        <p class="text-center p-3">No Payment Made Yet For Today</p>
                    </div>
                </div>
                <!-- /tabs content -->

                <div class="card-footer">
                    <!-- <?php // include('paging.php') 
                            ?> -->
                </div>

            </div>
        </div>

        <div class="col-xl-3 h-100" id="filter-sidebar">
            <?= get_nav_filter() ?>
        </div>
    </div>
    <?php include('layouts/footer.php');
