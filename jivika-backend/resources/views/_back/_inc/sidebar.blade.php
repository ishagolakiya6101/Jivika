<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{url('admin/dashboard')}}" class="app-brand-link">
      @if(isset($site_data) && $site_data['logo'] != null)
      <img src="data:image/png;base64,{{$site_data['logo']}}" alt=" no img" width="150">
      @else
      <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.94 19 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
          <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0" />
        </svg>
      </span>
      @endif
      <!-- <span class="app-brand-text demo menu-text fw-bold">@if(isset($data)) {{$site_data['site_name']}} @else Vuexy @endif</span> -->
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item @if(str_contains(Request::url() ,'admin/dashboard')) active @endif">
      <a href="{{url('admin/dashboard')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,'admin/customers')) active @endif">
      <a href="{{url('admin/customers')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Customers">Customers</div>
      </a>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,'admin/bookings')) active @endif">
      <a href="{{url('admin/bookings')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
        <div data-i18n="Bookings">Bookings</div>
      </a>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,'admin/providers')) active @endif">
      <a href="{{url('admin/providers')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Freelancers">Freelancers</div>
      </a>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,'admin/discount')) active @endif">
      <a href="{{url('admin/discount')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-discount-2"></i>
        <div data-i18n="Discount">Discount</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Manage</span>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,'admin/category') || str_contains(Request::url() ,'admin/services') || str_contains(Request::url() ,'admin/packages')) open @endif">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ti ti-category"></i>
        <div data-i18n="Service">Service</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item @if(str_contains(Request::url() ,'admin/category')) active @endif">
          <a href="{{url('admin/category')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-category"></i>
            <div data-i18n="Category">Category</div>
          </a>
        </li>
        <li class="menu-item @if(str_contains(Request::url() ,'admin/services')) active @endif">
          <a href="{{url('admin/services')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-tools"></i>
            <div data-i18n="Services">Services</div>
          </a>
        </li>
        <li class="menu-item @if(str_contains(Request::url() ,'admin/packages')) active @endif">
          <a href="{{url('admin/packages')}}" class="menu-link">
            <i class="menu-icon tf-icons ti ti-package"></i>
            <div data-i18n="Packages">Packages</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,'admin/users')) active @endif">
      <a href="{{url('admin/users')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-users"></i>
        <div data-i18n="Staff">Staff</div>
      </a>
    </li>
    <!-- <li class="menu-item @if(str_contains(Request::url() ,'admin/orders')) active @endif">
      <a href="{{url('admin/orders')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
        <div data-i18n="Orders">Orders</div>
      </a>
    </li> -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Settings</span>
    </li>
    
    <li class="menu-item @if(str_contains(Request::url() ,'admin/payment_settings')) active @endif">
      <a href="{{url('admin/payment_settings')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-settings"></i>
        <div data-i18n="Payment Settings">Payment Settings</div>
      </a>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,'admin/settings')) active @endif">
      <a href="{{url('admin/settings')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-settings"></i>
        <div data-i18n="Web App Settings">Web App Settings</div>
      </a>
    </li>
    <li class="menu-item @if(str_contains(Request::url() ,route('testimonials.index'))) active @endif">
      <a href="{{route('testimonials.index')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-discount-2"></i>
        <div data-i18n="Testimonials">Testimonials</div>
      </a>
    </li>
  </ul>
</aside>