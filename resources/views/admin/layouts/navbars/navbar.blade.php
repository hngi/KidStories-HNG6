@if (Auth::guard('admin')->check())
    @include('admin.layouts.navbars.navs.auth')
@endif
    
@if (!Auth::guard('admin')->check())
    @include('admin.layouts.navbars.navs.guest')
@endif