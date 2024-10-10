<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-user-3"></i>
                    <span class="nav-text">User Management</span>
                </a>
                <ul aria-expanded="false">
                    <li>

                        <a href="{{ route('admin.user-management.user.index') }}" class="ai-icon">
                            <i class="flaticon-381-user-7"></i>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user-management.role.index') }}" class="ai-icon">
                            <i class="flaticon-381-unlocked-4"></i>
                            Roles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user-management.permission.index') }}" class="ai-icon">
                            <i class="flaticon-381-fingerprint"></i>
                            Permissions
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}" class="ai-icon">
                    <i class="flaticon-381-more"></i>
                    Products Section
                </a>
            </li>
        </ul>
    </div>
</div>
