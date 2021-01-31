<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
            <label for="name" class="control-label default">@lang('labels.product.name')<sup class="title-sup">(*)</sup></label>
            <input id="name" type="text" class="form-control"  placeholder="@lang('labels.product.name')" name="name" value="{{old('name', isset($product->name) ? $product->name : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('category_id') ? 'has-error' : '' }} ">
            <label for="category_id" class="control-label default">@lang('labels.product.category')</label>
            <select id="category_id" class="form-control" name="category_id">
                <option
                    value="{{ Constant::ROOT_CATEGORY }}"
                    {{old('category_id', isset($product->category_id) ? $product->category_id : Constant::ROOT_CATEGORY) === Constant::ROOT_CATEGORY ? 'selected' : ''}}
                >@lang('labels.product.default_option')</option>
                @foreach($categories as $cat)
                    <option
                        value="{{ $cat->id }}"
                        {{old('category_id', isset($product->category_id) ? $product->category_id : Constant::ROOT_CATEGORY) === $cat->id ? 'selected' : ''}}
                    >{{ $cat->name}}</option>
                @endforeach
            </select>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('category_id') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('url_image') ? 'has-error' : '' }} ">
            <label for="image" class=" control-label default">@lang('labels.product.image')</label>
            <input type="file" id="image" class="form-control" name="url_image">
            @if(isset($product->url_image))
                <img src="{{ $product->url_image }}" alt="" width="100px" style="margin-top: 0.1em">
            @endif
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('image') }}</p></span>
        </div>


        <div class="row justify-content-center" style="display:none">
            <label class="w-100 col-form-label text-left">{{ __('labels.product.slide_image') }}</label>
            <div class="col text-center append-error">
                <div class="progress" style="display: none;">
                    <div class="progress-bar progress-bar-striped progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div id="thumb" class="c-form__fileUploadThumbnails clearfix">
                    @if(isset($product))
{{--                        @dd($product->sortImages())--}}
                        @foreach ($product->sortImages(false) as $image)
                            <div class="c-form__fileUploadThumbnail" style="background-image:url('{{ $image->url }}');">
                                <a class="delete-image">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <input type="hidden" name="c_images[]" value="{{ $image->url }}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div id="upload-zone" class="media py-2 border-ec-dashed mb-2">
                    <div class="media-body">
                        <i class="fa fa-fw fa-upload"></i>
                        {{ __('labels.product.drop_drag_image') }}
                        <input type="file" id="productImages" name="product_image[]" accept="image/*" multiple style="display: none;">
                        <a class="btn btn-ec-regular mr-2" onclick="$('#productImages').click()">
                            {{ __('labels.product.choose_file') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group {{ $errors->first('description') ? 'has-error' : '' }} ">
            <label for="description" class="control-label default">@lang('labels.product.description')</label>
            <textarea rows="5" id="description" type="text" class="form-control"
                placeholder="@lang('labels.product.description')" name="description"
            >{{old('description', isset($product->description) ? $product->description : '')}}</textarea>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('description') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
            <label for="content" class="control-label ">@lang('labels.product.content')</label>
            <textarea name="content" style="resize:vertical" class="form-control" id="content">{{ old('content', isset($product->content) ? $product->content : '') }}</textarea>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('content') }}</p></span>
            <script>
                ckeditor('content');
            </script>
        </div>

        <div class="form-group {{ $errors->first('price') ? 'has-error' : '' }} ">
            <label for="price" class="control-label default">@lang('labels.product.price')</label>
            <input id="price" type="text" class="form-control"  placeholder="@lang('labels.product.price')" name="price" min="0"
                value="{{old('price', isset($product->price) ? $product->price : Constant::DEFAULT_PRODUCT['price'])}}"
            >
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('price') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('quantity') ? 'has-error' : '' }} ">
            <label for="quantity" class="control-label default">@lang('labels.product.quantity')</label>
            <input id="quantity" type="text" class="form-control"  placeholder="@lang('labels.product.quantity')" name="quantity" min="0"
                value="{{old('quantity', isset($product->quantity) ? $product->quantity : Constant::DEFAULT_PRODUCT['quantity'])}}"
            >
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('quantity') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('status') ? 'has-error' : '' }} ">
            <label class="control-label default">@lang('labels.general.status')</label>
            <div class="radio">
                <label for="status_active" class="col-md-2">
                    <input
                        id="status_active"
                        value="{{Constant::STATUS_ACTIVE}}"
                        {{old('status', isset($product->status) ? $product->status : Constant::STATUS_ACTIVE) === Constant::STATUS_ACTIVE ? 'checked' : ''}}
                        name="status"
                        type="radio"
                    >@lang('labels.general.status_active')
                </label>
                <label for="status_inactive" class="col-md-2">
                    <input
                        id="status_inactive"
                        value="{{Constant::STATUS_ACTIVE}}"
                        {{old('status', isset($product->status) ? $product->status : Constant::STATUS_ACTIVE) === Constant::STATUS_INACTIVE ? 'checked' : ''}}
                        name="status"
                        type="radio"
                    >@lang('labels.general.status_inactive')
                </label>
            </div>
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('status') }}</p></span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="{{ route('products.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i>@lang('labels.general.back')</a>
                <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> @lang('labels.general.save')</button>
            </div>
        </div>
    </div>
</form>
