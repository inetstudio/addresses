<li class="{{ isActiveRoute('back.addresses.*') }}">
    <a href="#"><i class="fa fa-map-marker-alt"></i> <span class="nav-label">Адреса</span><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse">
        @include('admin.module.addresses.points::back.includes.package_navigation')
    </ul>
</li>
