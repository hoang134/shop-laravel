@extends('frontend.layouts.app')
@section('title-frontend', $post->title)
@section('main-content')
    <section class="content">
        <div class="container">
            <div class="breadcrumbs-order">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="breadcrumbs col-sm-12 col-md-6 col-lg-6">
                            <ul>
                                <li><a href="/">@lang('labels.general.home')</a></li>
                                <li><a href="javascript:void(0)">/</a></li>
                                <li><a class="active" href="{{ route('post', $post->url_post) }}">{{ $post->title }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category-product">
                <div class="col-12 title-more">
                    <div class="page-catelogy-title">
                        <div class="page-catelogy-title-left">
                            <h1>{{ $post->title }}</h1>
                            <p class="create-post">@lang('labels.page.create_post'): {{ formatDate($post->created_at) }}</p>
                        </div>
                    </div>
                </div>
                <div class="page-post">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="detail-post">
                                    <div class="post-image">
                                        <img src="{{ $post->url_image }}" />
                                    </div>
                                    <div class="post-content">{!! $post->content !!}</div>
                                </div>
                            </div>
                            <div class="sidebar-post col-sm-12 col-md-4 col-lg-4">
                                <div class="list-new">
                                    <h2 class="title-sidebar">@lang('labels.page.list_post_new')</h2>
                                    <ul>

                                        @foreach($newPosts as $item)
                                            <li>
                                                <a href="{{ route('post', $item->url_post) }}">
                                                    <div class="sb-imge">
                                                        <img src="{{ $item->url_image }}" />
                                                    </div>
                                                    <div class="sb-title-price">
                                                        <span>{{ $item->title }}</span>
                                                    </div>
                                                    <div class="font-italic">
                                                        <small>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y - H:i') }}</small>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="list-product">
                                    <h3 class="title-sidebar">@lang('labels.page.list_product_new')</h3>
                                    <ul>

                                        @foreach($newProducts as $item)
                                            <li>
                                                <a href="{{ route('product', $item->url_product) }}">
                                                    <div class="sb-imge">
                                                        <img src="{{ $item->url_image }}" />
                                                    </div>
                                                    <div class="sb-title-price">
                                                        <span>{{ $item->name }}</span>
                                                        <span class="box-price">{{ formatMoney($item->price) }}₫</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
