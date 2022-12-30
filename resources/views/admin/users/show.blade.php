@extends('admin.layouts.app')

@section('Title', 'User Profile')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('admin.layouts.messages')

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        @if (!empty($RS_Row->avatar))
                                            <img src="{{ config('app.url') . Storage::url('app/public/' . $RS_Row->avatar) }}"
                                                alt="{{ $RS_Row->first_name }}"
                                                class="profile-user-img img-fluid img-circle" />
                                        @endif
                                    </div>

                                    <h3 class="profile-username text-center">{{ $RS_Row->full_name }}</h3>

                                    <p class="text-muted text-center">{{ $RS_Row->occupation }}</p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Email:</b> <a>{{ $RS_Row->email }}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Mobile:</b> <a>({{ $RS_Row->dial_code ?? 91 }})
                                                {{ $RS_Row->mobile_number }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <a href="{{ route('admin.users.edit', $RS_Row->id) }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-edit"></i>&nbsp;&nbsp;Edit User</a>
                                </div>

                                <div class="card-body">
                                    {{-- <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">First Name</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->first_name }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->last_name }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Email Address</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->email }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Mobile Number</label>
                                        <div class="col-sm-10">
                                            <div>({{ $RS_Row->dial_code ?? 91 }}) {{ $RS_Row->mobile_number }}</div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Gender</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->gender }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Birth Date</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->birth_date }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Address</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->address }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">City</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->city }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Country</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->country }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Occupation</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->occupation }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Guru</label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->guru }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Reference Person
                                        </label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->reference_person }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Status
                                        </label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->status }}</div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center">
                                        <label class="col-sm-2 form-label">Role
                                        </label>
                                        <div class="col-sm-10">
                                            <div>{{ $RS_Row->role->pluck('name')->join(', ') }}</div>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
    </div>

@endsection
