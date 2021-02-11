<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{!! isset(Auth::user()->avatar) && !empty(Auth::user()->avatar) ? secure_asset(replaceUrlImage(Auth::user()->avatar)) : secure_asset('backend/dist/img/avatar5.png') !!}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><a href="{{ route('profile') }}">{{  Auth::user()->name ?  Auth::user()->name :'' }}</a></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">@lang('labels.sidebar.dashboard')</li>
        <li>
            <a href="{{route('categories.index')}}">
                <i class="fa fa-fw fa-folder"></i>
                <span>@lang('labels.category.label')</span>
            </a>
        </li>
        <li>
            <a href="{{route('products.index')}}">
                <i class="fa fa-fw fa-folder"></i>
                <span>@lang('labels.product.label')</span>
            </a>
        </li>
        @can('viewAny', \App\Models\Order::class)
        <li>
            <a href="{{route('orders.index')}}">
                <i class="fa fa-fw fa-shopping-cart"></i>
                <span>@lang('labels.order.label')</span>
            </a>
        </li>
        @endcan
        <li>
            <a href="{{route('posts.index')}}">
                <i class="fa fa-fw fa-file-word-o"></i>
                <span>@lang('labels.post.label')</span>
            </a>
        </li>
        <li>
            <a href="{{route('pages.index')}}">
                <i class="fa fa-fw fa-file-word-o"></i>
                <span>@lang('labels.page.label')</span>
            </a>
        </li>
        <li>
            <a href="{{route('banners.index')}}">
                <i class="fa fa-fw fa-image"></i>
                <span>@lang('labels.banner.label')</span>
            </a>
        </li>
        @can('viewAny', \App\Models\User::class)
            <li>
                <a href="{{route('users.index')}}">
                    <i class="fa fa-fw fa-user"></i>
                    <span>@lang('labels.user.label')</span>
                </a>
            </li>
        @endcan
        <li>
            <a href="{{route('menus.index')}}">
                <i class="fa fa-fw fa-cog"></i>
                <span>@lang('labels.menu.label')</span>
            </a>
        </li>
        <li>
            <a href="{{route('settings.index')}}">
                <i class="fa fa-fw fa-cog"></i>
                <span>@lang('labels.setting.label')</span>
            </a>
        </li>
        <li>
            <a href="{{route('logout')}}">
                <i class="fa fa-fw fa-power-off"></i>
                <span>@lang('labels.logout')</span>
            </a>
        </li>
    </ul>
</section>
<!-- /.sidebar -->
