@foreach(['success','danger'] as $item)
    @if(session($item))
        <div class="flash-message">
            <div class="alert alert-{{ $item }}" role="alert" style=" position: absolute;right: 20px;top: 51px;width: 500px;z-index: 999999999;border-radius: 8px;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong class="font-weight-100 font-size-14">{{ session($item) }}</strong>
            </div>
        </div>
    @endif
@endforeach