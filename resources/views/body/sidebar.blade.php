<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="html/ltr/vertical-menu-template-semi-dark/index.html">
                    <h2 class="brand-text text-uppercase">Invertory</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Dashboard -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('/')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span></a>
            </li>


            <!-- Users -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate">Users</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('all.user')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="All User">All User</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('all.user')}}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Add User">Add User</span></a>
                    </li>
                </ul>
            </li>

            <!-- Products -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="box"></i><span class="menu-title text-truncate">Products</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('all.product')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="All Product">All Product</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('add.product')}}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Add Product">Add Product</span></a>
                    </li>
                </ul>
            </li>

            <!-- Purchase -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate">Purchases</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('all.purchase')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="All Purchase">All Purchase</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('add.purchase')}}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Add Purchase">Add Purchase</span></a>
                    <li><a class="d-flex align-items-center" href="{{route('return.purchase')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="Return Purchase">Return Purchase</span></a>
                    </li>
                </ul>
            </li>

            <!-- Sale -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="truck"></i><span class="menu-title text-truncate">Sale</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('all.sale')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="All S">All Sale</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('add.sale')}}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Add Sale">Add Sale</span></a>
                    <li><a class="d-flex align-items-center" href="{{route('return.sale')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="Return Sale">Return Sale</span></a>
                    </li>
                </ul>
            </li>

            <!-- Supplier -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='user-plus'></i><span class="menu-title text-truncate">Suppliers</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('all.supplier')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="All Supplier">All Supplier</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('add.supplier')}}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Add Supplier">Add Supplier</span></a>
                    </li>
                </ul>
            </li>

            <!-- Customer -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='user-minus'></i><span class="menu-title text-truncate">Customers</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('all.customer')}}"><i data-feather="list"></i><span class="menu-item text-truncate" data-i18n="All Customer">All Customer</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="{{route('add.customer')}}"><i data-feather="plus"></i><span class="menu-item text-truncate" data-i18n="Add Customer">Add Customer</span></a>
                    </li>
                </ul>
            </li>

            <!-- Reports -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i class="fa-regular fa-chart-bar"></i><span class="menu-title text-truncate">Reports</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('sale.report')}}"><i class="fa-regular fa-file-lines"></i><span class="menu-item text-truncate" data-i18n="Sale Report">Sale Report</span></a>
                    </li>
                </ul>
            </li>

            <!-- Setting -->
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span class="menu-title text-truncate">Settings</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="{{route('setting.invertory')}}"><i data-feather="settings"></i><span class="menu-item text-truncate" data-i18n="Invertory">Invertory</span></a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
