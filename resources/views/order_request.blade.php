<?php
// $referral_page = "Products";
$page_title = "Customer Requests";
$breadcrumb = ["Home", $page_title];

$header_assets = [
    '<script src="assets/js/plugins/visualization/echarts/echarts.min.js"></script>',
    '<script src="assets/js/plugins/tables/datatables/datatables.min.js"></script>',
    '<script src="assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>',
    '<script src="assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>',
    '<script src="assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>',
    '<script src="assets/js/plugins/tables/datatables/extensions/responsive.min.js"></script>',

    '<script src="assets/js/demo_pages/ecommerce_customers.js"></script>',
    '<script src="assets/js/demo_charts/pages/ecommerce/light/customers.js"></script>'
];

require('layouts/header.php');

$request = new Request();
$requests = $request->getRequests();
// pre_r($requests);exit;
?>

<div class="content">
    <!-- Customers -->
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Customers</h6>
        </div>

        <div class="card-body">
            <div class="chart-container">
                <div class="chart has-fixed-height" id="customers_chart"></div>
            </div>
        </div>

        <table class="table table-striped text-nowrap table-customers">
            <thead>
                <tr class="font-weight-bold">
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Location</th>
                    <th>Actions</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="">
                <?php if ($requests) {
                    foreach ($requests as $key => $req) { ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="mr-3">
                                        <a href="user_profile?id=<?= $req->user_id ?>">
                                            <img src="assets/images/demo/users/face1.jpg" width="40" height="40" class="rounded-circle" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body align-self-center font-weight-semibold">
                                        <a href="user_profile?id=<?= $req->user_id ?>" class="text-capitalize"><?= $req->name ?></a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-capitalize font-weight-semibold">
                                <a href="product_profile?id=<?= $req->product->id ?>"><?= $req->product->name ?></a></td>
                            <td><?= '₦' . $req->product->price ?></td>
                            <td><?php if ($req->date == date('Y-m-d')) echo format_time($req->time);
                                else echo format_date($req->date, 'd'); ?></td>
                            <td><a href="mailto:<?= $req->email ?>"><?= $req->email ?></a></td>
                            <td>
                                <a href="tel:<?= $req->phone_number ?>">
                                    <?= $req->phone_number ?></a>
                            </td>
                            <td><?= $req->city ?></td>
                            <td class="text-right">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu7"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i> Invoices</a>
                                            <a href="#" class="dropdown-item"><i class="icon-cube2"></i> Shipping details</a>
                                            <a href="#" class="dropdown-item"><i class="icon-credit-card"></i> Billing details</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="icon-warning2"></i> Report problem</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="pl-0"></td>
                        </tr>
                <?php }
                } ?>

            </tbody>
        </table>
    </div>
    <!-- /customers -->
</div>

<?php include_once('layouts/footer.php');
