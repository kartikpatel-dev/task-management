@if (Session::has('messageType'))
    <div class="row">
        <div class="col-md-12">
            <div
                class="alert alert-dismissible @if (Session::get('messageType') == 'success') alert-success @elseif(Session::get('messageType') == 'info') alert-info @else alert-danger @endif">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! Session::get('message') !!}
            </div>
        </div>
    </div>
@endif
