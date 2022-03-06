<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-link @isActive(getRouteName(), 'active')">Dashboard</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('product.index') }}" class="sidebar-link @isActive(getRouteName(), 'active')">Product List</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('product.add') }}" class="sidebar-link @isActive(getRouteName(), 'active')">Add Product</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('invoice.manager') }}" class="sidebar-link @isActive(getRouteName(), 'active')">Invoice Manager</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('sales.index') }}" class="sidebar-link @isActive(getRouteName(), 'active')">Sales Manager</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('baki.index') }}" class="sidebar-link @isActive(getRouteName(), 'active')">Baki Manager</a>
                </li>
                {{-- @include('admin::layouts.child-sidebar-menu') --}}
                <li class="list-divider"></li>
                <li class="sidebar-item">
                    <a href="{{ route('setting') }}" class="sidebar-link @isActive(getRouteName(), 'active')">Settings</a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class="sidebar-link sidebar-link" onclick="" aria-expanded="false">
                        <i data-feather="log-out" class="feather-icon"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
