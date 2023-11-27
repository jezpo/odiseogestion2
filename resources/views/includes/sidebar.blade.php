@php
    $sidebarClass = !empty($sidebarTransparent) ? 'sidebar-transparent' : '';
@endphp
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar sidebar-grid {{ $sidebarClass }}">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
					<div class="cover with-shadow"></div>
					<div class="image">
						<img src="/assets/img/user/user-2.jpg" alt="" />
					</div>
                    <div class="info">
                        <b class="caret pull-right"></b>
                        
                        {{ Auth::user()->name }}

                        <small>{{ Auth::user()->email }}</small>
                        
                    </div>

                </a>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Menú</li>
            @include('sidebar_gnrl')
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
