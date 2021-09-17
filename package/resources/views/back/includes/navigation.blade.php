<li class="{{ isActiveRoute('back.addresses.*', 'mm-active') }}">
    <a href="#" aria-expanded="false"><i class="fa fa-map-marker-alt"></i> <span class="nav-label">Адреса</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        @include('admin.module.addresses.points::back.includes.package_navigation')
    </ul>
</li>
