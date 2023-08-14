@extends('layouts.header')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card bg-primary bg-soft">
                        <div>
                            <div class="row">

                                <div class="col-3 mt-2 p-4">
                                    <div class="flex-shrink-0 me-3">
                                        <img src="{{asset('assets/images/users/'.$users[0]->image)}}" alt=""
                                             class="avatar-md rounded-circle img-thumbnail">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="text-primary p-4 text-primary">
                                        <h5 class="text-primary">Agent Detail !</h5>
                                        <span>{{$users[0]->name}}</span> <br>
                                        <span>{{$users[0]->email}}</span><br>
                                        <span>{{$users[0]->Role}} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                            <i class="bx bx-copy-alt"></i>
                                        </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Total Orders</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>{{count($cd_total)}} <i class="mdi mdi-chevron-up ms-1 text-success"></i>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                        <span
                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                            <i class="bx bx-archive-in"></i>
                                        </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Revenue</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4> £ {{number_format($rd_total[0]->rd_total,2)}} <i
                                                class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-purchase-tag-alt"></i>
                                                        </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Avg. Booking <br><small>Per/Month</small></h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h4>£ {{number_format($rd_total[0]->rd_total / 30,2)}} <i
                                                class="mdi mdi-chevron-up ms-1 text-success"></i></h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="edit-div" class=" col-12 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Update Profile</h4>
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.update-profile') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-firstname-input" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-firstname-input" name="name" placeholder="Enter Your First Name"
                                           value="{{ $users[0]->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="formrow-email-input" name="email" placeholder="Enter Your Email ID"
                                           value="{{ $users[0]->email }}" readonly>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-password-input" class="form-label">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="formrow-password-input" name="password"
                                           placeholder="Enter Your Password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-confirm-password-input" class="form-label">Confirm
                                        Password</label>
                                    <input type="password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           id="formrow-confirm-password-input" name="password_confirmation"
                                           placeholder="Confirm Your Password">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>

@endsection
