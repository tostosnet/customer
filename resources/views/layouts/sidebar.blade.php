
<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg" style="min-height: 100vh">

    <!-- User menu -->
    <div class="sidebar-section sidebar-user my-1" style="border-bottom: 1px solid #444">
        <div class="sidebar-section-body">
            <div class="media">
                <a href="#" class="mr-3">
                    <img src="<?= Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : asset('images/demo/users/face1.jpg') ?>" class="rounded-circle" alt="">
                </a>

                <div class="media-body">
                    <div class="font-weight-semibold text-capitalize">{{ Auth::user()->surname.' '.Auth::user()->first_name }}</div>
                    <div class="font-size-sm line-height-sm opacity-50">
                        User
                    </div>
                </div>

                <div class="ml-3 align-self-center">
                    <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="icon-transmission"></i>
                    </button>

                    <button type="button" class="btn btn-outline-light-100 text-white border-transparent btn-icon rounded-pill btn-sm sidebar-mobile-main-toggle d-lg-none">
                        <i class="icon-cross2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /user menu -->

    <!-- Sidebar content -->
    <div class="sidebar-content">


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link {{ (request()->is('p') || request()->is('p/create')) ? 'p-active' : '' }}">
                        <i class="icon-cart"></i>
                        <span>Products</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Products">
                        <li class="nav-item"><a href="<?= route('product.categories') ?>" class="nav-link {{ request()->is('cat') ? 'active' : '' }}">Categories</a></li>
                        <!-- <li class="nav-item"><a href="<?= route('products') ?>" class="nav-link {{ request()->is('p') ? 'active' : '' }}">All Products</a></li> -->
                        <li class="nav-item"><a href="<?= route('products') ?>" class="nav-link {{ request()->is('p') ? 'active' : '' }}">Products</a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link {{ (request()->is('c') || request()->is('g') || request()->is('c/create')) ? 'p-active' : '' }}">
                        <i class="icon-users"></i>
                        <span>Clients</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Clients">
                        <li class="nav-item"><a href="<?= route('clients') ?>" class="nav-link {{ request()->is('c') ? 'active' : '' }}">All Clients</a></li>
                        <li class="nav-item"><a href="<?= route('guarantors') ?>" class="nav-link {{ request()->is('g') ? 'active' : '' }}">All Guarantors</a></li>
                        <li class="nav-item"><a href="<?= route('client.form') ?>" class="nav-link {{ request()->is('c/create') ? 'active' : '' }}">Add New Client</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= route('payments') ?>" class="nav-link {{ request()->is('pm') ? 'active' : '' }}" data-menu-title="Payments">
                        <i class="icon-wallet"></i>
                        <span>Payments</span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link {{ (request()->is('requests') || request()->is('orders/index') || request()->is('orders/complete') || request()->is('orders/uncomplete')) ? 'p-active' : '' }}">
                        <i class="icon-users"></i>
                        <span>Orders</span>
                    </a>
                    <ul class="nav nav-group-sub" data-submenu-title="Orders">
                        <li class="nav-item"><a href="<?= route('requests') ?>" class="nav-link {{ request()->is('requests') ? 'active' : '' }}">User Requests</a></li>
                        <li class="nav-item"><a href="<?= route('orders.index') ?>" class="nav-link {{ request()->is('orders/index') ? 'active' : '' }}">Active Orders</a></li>
                        <li class="nav-item"><a href="<?= route('orders.complete') ?>" class="nav-link {{ request()->is('orders/complete') ? 'active' : '' }}">Completed Orders</a></li>
                        <li class="nav-item"><a href="<?= route('orders.uncomplete') ?>" class="nav-link {{ request()->is('orders/uncomplete') ? 'active' : '' }}">Uncompleted Orders</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= route('chats') ?>" class="nav-link {{ request()->is('chats') ? 'active' : '' }}" data-menu-title="Chats">
                        <i class="icon-bubble"></i>
                        <span>Chats</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     let bi = location.pathname.substr(1).split('/')[0];
    //     let li = document.querySelectorAll('.sidebar-section li.nav-item > a.nav-link');

    //     for (i = 0; i < li.length; i++) {
    //         if (li[i].classList.contains('active')) {
    //             li[i].classList.remove('active');
    //             break;
    //         }
    //     }
    //     for (i = 0; i < li.length; i++) {
    //         if (li[i].href.split('?')[0].endsWith(bi)) {
    //             li[i].classList.add('active');
    //             break;
    //         }
    //     }
    // });
</script>
