@extends('backend.layouts.app')
@section('title-admin', __('labels.menu.label'))
@section('style')
    <style>
        body.dragging, body.dragging * {
            cursor: move !important;
        }

        .dragged {
            position: absolute;
            opacity: 0.5;
            z-index: 2000;
        }

        .table-border {
            border: 1px solid #000;
            padding: 0 10px;
            margin-bottom: 10px;
        }

        ul.menu-list, ul.category-list, ul.page-list {
            list-style: none;
            padding: 0;
        }

        ul.menu-list ul, ul.category-list ul, ul.page-list ul {
            list-style: none;
        }
        ul.menu-list li, ul.category-list li, ul.page-list li, .create-item {
            border: 1px solid #000;
            margin: 10px 0;
            padding: 5px;
        }
    </style>
@endsection
@section('main-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('labels.menu.label')</h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home.index')}}"><i class="fa fa-dashboard"></i>@lang('labels.general.home')</a></li>
            <li>@lang('labels.menu.label')</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group mg-r-10 float-right">
                    <button type="submit" id="menuSaveBtn" class="btn btn-success btn-sm mg-r-10">
                        <i class="fa fa-save"></i> @lang('labels.general.save')
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="col-12 table-border">
                        <h4>@lang('labels.menu.label')</h4>
                        <form class="form-horizontal" id="saveMenu" action="{{ route('menus.saveMenu') }}">
                            <ul class='menu-list'>
                                @foreach($menus as $menu)
                                    <li>{{ $menu->name}}
                                        <div class="btn-group mg-r-10 float-right">
                                            <a href="{{route('menus.edit', $menu->id)}}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{route('menus.delete', $menu->id)}}">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <input type="hidden" name="names[]" class="names" value="{{ $menu->name }}">
                                        <input type="hidden" name="urls_menu[]" class="urls_menu" value="{{ $menu->url_menu }}">
                                        <input type="hidden" name="parent_ids[]" class="parent_ids" value="{{ $menu->parent_id }}">

                                        <ul>
                                            @if($menu->childMenu->count())
                                                @foreach($menu->childMenu as $child)
                                                    <li>{{ $child->name }}
                                                        <div class="btn-group mg-r-10 float-right">
                                                            <a href="{{route('menus.edit', $child->id)}}">
                                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                                            </a>
                                                            <a href="{{route('menus.delete', $child->id)}}">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <input type="hidden" name="names[]" class="names" value="{{ $child->name }}">
                                                        <input type="hidden" name="urls_menu[]" class="urls_menu" value="{{ $child->url_menu }}">
                                                        <input type="hidden" name="parent_ids[]" class="parent_ids" value="{{ $child->parent_id }}">
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                        <div class="create-item">
                            <a href="{{route('menus.create')}}" class="text-center">
                                <i class="fa fa-plus"></i> @lang('labels.general.create_new')
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-12 table-border">
                        <h4>@lang('labels.category.label')</h4>
                        <ul class='category-list'>
                            @foreach($categories as $category)
                                <li>{{ $category->name}}
                                    <input type="hidden" name="names[]" class="names" value="{{ $category->name }}">
                                    <input type="hidden" name="urls_menu[]" class="urls_menu" value="category/{{ $category->url_category }}">
                                    <input type="hidden" name="parent_ids[]" class="parent_ids" value="">
                                    <ul>
                                        @if($category->childCategories->count())
                                            @foreach($category->childCategories as $child)
                                                @if($child->status === Constant::STATUS_ACTIVE)
                                                    <li>{{ $child->name }}
                                                        <input type="hidden" name="names[]" class="names" value="{{ $child->name }}">
                                                        <input type="hidden" name="urls_menu[]" class="urls_menu" value="category/{{ $child->url_category }}">
                                                        <input type="hidden" name="parent_ids[]" class="parent_ids" value="1">
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endif
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-12 table-border">
                        <h4>@lang('labels.page.label')</h4>
                        <ul class='page-list'>
                            @foreach($pages as $page)
                                <li>{{ $page->title}}
                                    <input type="hidden" name="names[]" class="names" value="{{ $page->title }}">
                                    <input type="hidden" name="urls_menu[]" class="urls_menu" value="page/{{ $page->url_page }}">
                                    <input type="hidden" name="parent_ids[]" class="parent_ids" value="">
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        $(document).on('click', '#menuSaveBtn', function() {
            $('#saveMenu').submit();
        })
        $(function() {
            $("ul.menu-list").sortable({
                group: 'nested',
                onDrop: function ($item, container, _super) {
                    if (container.el.hasClass("menu-list")) {
                        $item.children('input.parent_ids').val("");
                    } else {
                        $item.children('input.parent_ids').val(1);
                    }
                    _super($item, container);
                },
                isValidTarget: function ($item, container) {
                    let depth = 1,
                        children = $item.find('ul').first().find('li');
                    depth += container.el.parents('ul').length;
                    while (children.length) {
                        depth++;
                        children = children.find('ul').first().find('li');
                    }
                    return depth <= 2;
                },
            });
            $("ul.category-list").sortable({
                group: 'nested',
                drop: false,
            });
            $("ul.page-list").sortable({
                group: 'nested',
                drop: false,
            });
        });
    </script>
@endsection
