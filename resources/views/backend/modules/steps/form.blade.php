<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <div class="col-md-12">
        <div class="form-group {{ $errors->first('step') ? 'has-error' : '' }} ">
            <label for="inputEmail3" class="control-label default">Step<sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control"  placeholder="Step" name="step" value="{{old('step', isset($step->step) ? $step->step : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('step') }}</p></span>
        </div>
        <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }} ">
            <label for="inputEmail3" class="control-label default">タイトル <sup class="title-sup">(*)</sup></label>
            <input type="text" class="form-control"  placeholder="タイトル " name="title" value="{{old('title', isset($step->title) ? $step->title : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('title') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('location') ? 'has-error' : '' }} ">
            <label for="inputEmail3" class="control-label default">ロケーション</label>
            <input type="number" class="form-control"  placeholder="ロケーション" name="location" min="0" value="{{old('location', isset($step->location) ? $step->location : '')}}">
            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('location') }}</p></span>
        </div>

        <div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
            <label for="inputEmail3" class="control-label ">本文</label>
            <textarea name="content" style="resize:vertical" class="form-control" id="content">{{ old('content', isset($step->content) ? $step->content : '') }}</textarea>
            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('content') }}</p></span>
            <script>
                ckeditor(content);
            </script>
        </div>

    </div>

    <div class="col-md-12">
        <div class="form-group">
            <div class="col-sm-12 text-center">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="{{ route('steps.index') }}"  class="btn btn-danger with-btn mg-r-5"><i class="fa fa-fw fa-reply-all"></i> 戻る</a>
                <button type="submit" class="btn btn-primary with-btn"><i class="fa fa-save"></i> 登録 </button>
            </div>
        </div>
    </div>
</form>