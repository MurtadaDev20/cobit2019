<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="{{route('dashboard')}}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->

                    {{-- @endif --}}

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#main-proccess">
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Main Proccess</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="main-proccess" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('mainProccess')}}">Manage Proccess</a></li>
                        </ul>
                    </li>
                    {{-- Users  --}}
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#users">
                            <div class="pull-left"><i class="fa fa-folder"></i><span
                                    class="right-nav-text">Users</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="users" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('allUsers')}}">Manage Users</a></li>
                        </ul>
                    </li>



                </ul>
            </div>
        </div>
    </div>
</div>

        <!-- Left Sidebar End-->

        <!--=================================
