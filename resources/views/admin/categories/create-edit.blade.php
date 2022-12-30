@extends('admin.layouts.app')

@section('Title', (!empty($RS_Row) ? 'Edit' : 'Add') . ' Category')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h4 class="card-title">@yield('Title')</h4>
                </div>

                <div class="card-body">
                    @if (!empty($RS_Row))
                        @php $action = route('admin.categories.update', $RS_Row->id); @endphp
                    @else
                        @php $action = route('admin.categories.store'); @endphp
                    @endif

                    <form id="createEditFrom" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        @if (!empty($RS_Row))
                            {{ method_field('PUT') }}
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $RS_Row->name ?? '') }}"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="slug">{{ __('Slug') }}</label>
                                    <input type="text" name="slug" id="slug"
                                        value="{{ old('slug', $RS_Row->slug ?? '') }}"
                                        class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}">

                                    @if ($errors->has('slug'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('slug') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="parent_id">{{ __('Parent Category') }}</label>
                                    <div class="select2-purple">
                                        <select name="parent_id" id="parent_id"
                                            class="select2 form-control{{ $errors->has('parent_id') ? ' is-invalid' : '' }}"
                                            data-placeholder="{{ __('-- Select Parent Category --') }}"
                                            data-dropdown-css-class="select2-purple">
                                            <option value="0">{{ __('-- Select Parent Category --') }}</option>
                                            @forelse($RS_Categoires as $RS_Category)
                                                <option value="{{ $RS_Category->id }}"
                                                    {{ old('parent_id', $RS_Row->parent_id ?? '') == $RS_Category->id ? 'selected' : '' }}>
                                                    {{ $RS_Category->name }} {{ !empty($RS_Category->parent_id) ? ', '.$RS_Category->parents->pluck('name')->implode(', ') : '' }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    @if ($errors->has('parent_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('parent_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">{{ __('Description') }}</label>
                                    <textarea name="description" id="description"
                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ old('description', $RS_Row->description ?? '') }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>{{ __('Status') }}</label>
                                    <div
                                        class="form-group-radio clearfix{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                        <div class="icheck-success d-inline mr-3">
                                            <input type="radio" id="status_active" name="status" value="Active"
                                                {{ old('status', $RS_Row->status ?? 'Active') == 'Active' ? 'checked' : '' }}>
                                            <label for="status_active">Active</label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="status_deactivate" name="status" value="Deactivate"
                                                {{ old('status', $RS_Row->status ?? '') == 'Deactivate' ? 'checked' : '' }}>
                                            <label for="status_deactivate">Deactivate</label>
                                        </div>
                                    </div>

                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">{{ __('Type') }}</label>
                                    <div class="select2-purple">
                                        <select name="type" id="type"
                                            class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                            data-placeholder="{{ __('-- Select Type --') }}"
                                            data-dropdown-css-class="select2-info">
                                            <option value="">{{ __('-- Select Type --') }}</option>
                                            @forelse($RS_CategoryTypes as $RS_CategoryType)
                                                <option value="{{ $RS_CategoryType }}"
                                                    {{ old('type', $RS_Row->type ?? '') === $RS_CategoryType ? 'selected' : '' }}>
                                                    {{ $RS_CategoryType }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">{{ __('Image') }}</label>
                                    <div class="input-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                                        <div class="custom-file">
                                            <input type="file" name="image" id="image" class="custom-file-input"
                                                accept="image/*">
                                            <label class="custom-file-label" for="image">Choose Image</label>
                                        </div>
                                    </div>

                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif

                                    @if (!empty($RS_Row->image))
                                        <img src="{{ $RS_Row->image }}" class="img-fluid img-thumbnail mt-3">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="post"></div>
                        <button type="submit" class="btn btn-info btn-fill">Submit</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#createEditFrom').validate({
                rules: {
                    name: {
                        required: true,
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

            // Summernote
            $('#description').summernote();

            //Initialize Select2 Elements
            $('.select2').select2();

            @php
            if( empty($RS_Row) )
            {
            @endphp
                $("#name").on('blur', function(e) {
                    e.preventDefault();

                    let name = slug($(this).val());
                    $('#slug').val(name);
                });
            @php
            }
            @endphp
        });
    </script>
@endsection
