<li class="nav-item dropdown {{ Route::is('admin.kyc.*') || Route::is('admin.kyc-list') ? 'active' : '' }}">
    <a class="nav-link has-dropdown" href="#"><i class="fas fa-th-large"></i><span>{{ __('Manage KYC') }}</span></a>

    <ul class="dropdown-menu">
        <li class="{{ Route::is('admin.kyc.*') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('admin.kyc.index') }}">{{ __('kyc Type') }}</a></li>

        <li class="{{ Route::is('admin.kyc-list') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('admin.kyc-list') }}">{{ __('Kyc Approval') }}</a></li>

    </ul>
</li>
