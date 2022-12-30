@extends('admin.layouts.app')

@section('Title', (!empty($RS_Row) ? 'Edit' : 'Add') . ' User')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('layouts.messages')

            <div class="card card-info">
                <div class="card-header">
                    <h4 class="card-title">@yield('Title')</h4>
                </div>

                <div class="card-body">
                    @if (!empty($RS_Row))
                        @php $action = route('admin.users.update', $RS_Row->id); @endphp
                    @else
                        @php $action = route('admin.users.store'); @endphp
                    @endif
                    <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                        @csrf
                        @if (!empty($RS_Row))
                            {{ method_field('PUT') }}
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">{{ __('First Name') }}</label>
                                    <input type="text" name="first_name" id="first_name"
                                        value="{{ old('first_name', $RS_Row->first_name ?? '') }}"
                                        class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('First Name') }}" autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name">{{ __('Middle Name') }}</label>
                                    <input type="text" name="middle_name" id="middle_name"
                                        value="{{ old('middle_name', $RS_Row->middle_name ?? '') }}"
                                        class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Middle Name') }}" autofocus>

                                    @if ($errors->has('middle_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('middle_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">{{ __('Last Name') }}</label>
                                    <input type="text" name="last_name" id="last_name"
                                        value="{{ old('last_name', $RS_Row->last_name ?? '') }}"
                                        class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Last Name') }}">

                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Eamil Address') }}</label>
                                    <input type="text" name="email" id="email"
                                        value="{{ old('email', $RS_Row->email ?? '') }}"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Eamil Address') }}">

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_number">{{ __('Mobile Number') }}</label>
                                    <div class="d-flex align-items-start">
                                        <select id="dial_code" name="dial_code"
                                            class="form-select mr-2 @error('dial_code') is-invalid @enderror" required
                                            style="width: 90px;">
                                            @forelse($dialCodes as $Key=>$Val)
                                                <option data-name="{{ $Val }}" value="{{ $Key }}"
                                                    {{ (!empty($RS_Row->dial_code) && $RS_Row->dial_code == $Key) || $Key == old('dial_code', !empty($RS_Row->dial_code) ? $RS_Row->dial_code : 91) ? 'selected' : '' }}>
                                                    {{ __('+' . $Key . ' (' . $Val . ')') }}</option>
                                            @empty
                                                <option value="">Code</option>
                                            @endforelse
                                        </select>

                                        <div class="w-100">
                                            <input type="text" name="mobile_number" id="mobile_number"
                                                value="{{ old('mobile_number', $RS_Row->mobile_number ?? '') }}"
                                                class="form-control{{ $errors->has('mobile_number') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Mobile Number') }}"
                                                onkeypress="return isNumber(event)">
                                        </div>

                                        @if ($errors->has('mobile_number'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mobile_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if (empty($RS_Row))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input type="password" name="password" id="password"
                                            value="{{ old('password', $RS_Row->password ?? '') }}"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Password') }}" autofocus>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="col-md-{{ !empty($RS_Row) ? 4 : 3 }}">
                                <div class="form-group clearfix">
                                    <label>{{ __('Gender') }}</label>
                                    <div
                                        class="form-group-radio clearfix{{ $errors->has('gender') ? ' is-invalid' : '' }}">
                                        <div class="icheck-success d-inline mr-3">
                                            <input type="radio" id="gender_male" name="gender" value="Male"
                                                {{ old('gender', $RS_Row->gender ?? '') == 'Male' ? 'checked' : '' }}>
                                            <label for="gender_male">Male</label>
                                        </div>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="gender_female" name="gender" value="Female"
                                                {{ old('gender', $RS_Row->gender ?? '') == 'Female' ? 'checked' : '' }}>
                                            <label for="gender_female">Female</label>
                                        </div>
                                    </div>

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-{{ !empty($RS_Row) ? 4 : 3 }}">
                                <div class="form-group">
                                    <label for="birth_date">{{ __('Birth Date') }}</label>
                                    <div class="input-group birth_date{{ $errors->has('birth_date') ? ' is-invalid' : '' }}"
                                        id="birth_date_target" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#birth_date_target" name="birth_date" id="birth_date"
                                            value="{{ old('birth_date', $RS_Row->birth_date ?? '') }}" />
                                        <div class="input-group-append" data-target="#birth_date_target"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>

                                    @if ($errors->has('birth_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birth_date') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-{{ !empty($RS_Row) ? 4 : 3 }}">
                                <div class="form-group">
                                    <label for="guru">{{ __('Guru') }}</label>
                                    <input type="text" name="guru" id="guru"
                                        value="{{ old('guru', $RS_Row->guru ?? '') }}"
                                        class="form-control{{ $errors->has('guru') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Guru') }}">

                                    @if ($errors->has('guru'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('guru') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">{{ __('Address') }}</label>
                                    <input type="text" name="address" id="address"
                                        value="{{ old('address', $RS_Row->address ?? '') }}"
                                        class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Address') }}">

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city">{{ __('City') }}</label>
                                    <input type="text" name="city" id="city"
                                        value="{{ old('city', $RS_Row->city ?? '') }}"
                                        class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('City') }}">

                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">{{ __('Country') }}</label>
                                    <input type="text" name="country" id="country"
                                        value="{{ old('country', $RS_Row->country ?? 'India') }}"
                                        class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Country') }}" readonly>

                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="occupation">{{ __('Occupation') }}</label>
                                    <input type="text" name="occupation" id="occupation"
                                        value="{{ old('occupation', $RS_Row->occupation ?? '') }}"
                                        class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Occupation') }}">

                                    @if ($errors->has('occupation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('occupation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group reference_person_main">
                                    <label for="reference_person">{{ __('Reference Person') }}</label>
                                    <input type="text" name="reference_person" id="reference_person"
                                        value="{{ old('reference_person', $RS_Row->reference_person ?? '') }}"
                                        class="form-control{{ $errors->has('reference_person') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('Reference Person') }}" autocomplete="off">

                                    @if ($errors->has('reference_person'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('reference_person') }}</strong>
                                        </span>
                                    @endif

                                    <div class="reference_person_list"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>{{ __('Status') }}</label>
                                    <div
                                        class="form-group-radio clearfix{{ $errors->has('status') ? ' is-invalid' : '' }}">
                                        <div class="icheck-success d-inline mr-3">
                                            <input type="radio" id="status_active" name="status" value="Active"
                                                {{ old('status', $RS_Row->status ?? '') == 'Active' ? 'checked' : '' }}>
                                            <label for="status_active">Active</label>
                                        </div>
                                        <div class="icheck-danger d-inline">
                                            <input type="radio" id="status_deactivate" name="status"
                                                value="Deactivate"
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
                                <div class="form-group clearfix">
                                    <label>{{ __('Role') }}</label>
                                    <div class="form-group-radio clearfix{{ $errors->has('role') ? ' is-invalid' : '' }}">
                                        @if (!empty($RS_Row))
                                            <div class="icheck-success d-inline mr-3">
                                                <input type="checkbox" id="role_manager" name="role[]" value="manager"
                                                    {{ (is_array(old('role')) && in_array('manager', old('role'))) || (!old() && (!empty($roles) && in_array('manager', $roles))) ? ' checked' : '' }}>
                                                <label for="role_manager">Manager</label>
                                            </div>
                                        @endif
                                        <div class="icheck-success d-inline">
                                            <input type="checkbox" id="role_user" name="role[]" value="user"
                                                {{ (is_array(old('role')) && in_array('user', old('role'))) || (!old() && (!empty($roles) && in_array('user', $roles))) ? ' checked' : '' }}>
                                            <label for="role_user">User</label>
                                        </div>
                                    </div>

                                    @if ($errors->has('role'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="avatar">{{ __('Photo') }}</label>
                                    <div class="input-group{{ $errors->has('avatar') ? ' is-invalid' : '' }}">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" id="avatar"
                                                value="{{ old('avatar') }}" class="custom-file-input"
                                                placeholder="Post Name" accept="image/*">
                                            <label class="custom-file-label" for="avatar">Choose photo</label>
                                        </div>
                                    </div>

                                    @if ($errors->has('avatar'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </span>
                                    @endif

                                    @if (!empty($RS_Row->avatar))
                                        <img src="{{ config('app.url') . Storage::url('app/public/' . $RS_Row->avatar) }}"
                                            alt="{{ $RS_Row->first_name }}" class="avatar-img mt-3">
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
            const maxDate = new Date();
            maxDate.setDate(maxDate.getDate() - 1);

            $('#birth_date_target').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                format: 'DD-MM-YYYY',
                // maxDate: maxDate,
            });

            // reference person auto suggest start
            jQuery(document).on('keyup', '#reference_person', function(e) {
                e.preventDefault();

                search_reference_person();
            });

            function search_reference_person() {
                let searchKeryword = jQuery('#reference_person').val();

                jQuery('.reference_person_list').html('');
                if (searchKeryword.length >= 3) {
                    let data = {
                        'searchKeryword': searchKeryword
                    };

                    jQuery.ajax({
                        url: "<?php echo route('user.autocomplete.search'); ?>?",
                        data: data,
                        cache: false,
                        beforeSend: function() {
                            // Show image container
                            // jQuery("#loader").show();
                        },
                        success: function(response) {
                            // console.log(response);
                            jQuery('.reference_person_list').html(response.users);
                        },
                        complete: function(data) {
                            // Hide image container
                            // jQuery("#loader").hide();
                        }
                    });
                }
            }

            jQuery(document).on('click', '.rp_list li', function(e) {
                var ref_per = jQuery(this).text();
                jQuery('#reference_person').val(ref_per);
                jQuery('.reference_person_list').html('');
            });
            // reference person auto suggest end

            jQuery('#dial_code').on('change', function(e) {
                const name = jQuery(this).find(':selected').data('name');
                jQuery('#country').val(name);
            });
        });
    </script>
@endsection
