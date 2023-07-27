@extends('layouts.header')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <img src="{{asset('assets/images/users')}}/{{$agent_profile[0]->image}}"
                                         alt="{{$agent_profile[0]->name}} image"
                                         class="avatar-md rounded-circle img-thumbnail">
                                </div>
                                <div class="flex-grow-1 align-self-center">
                                    <div class="text-muted">
                                        <p class="mb-2 fw-bold">Agent Name</p>
                                        <h5 class="mb-1">{{$agent_profile[0]->name}}</h5>
                                        <p class="mb-0">{{$agent_profile[0]->Role}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 align-self-center">
                            <div class="text-lg-center mt-4 mt-lg-0">
                                <div class="row">
                                    <div class="col-2">
                                        <p class="text-muted text-truncate mb-2">No. of Bookings</p>
                                        <h4 class="mb-0">{{count($invoice)}}</h4>
                                    </div>
                                    <div class="col-2">
                                        <p class="text-muted text-truncate mb-2">Pending Orders</p>
                                        <h4 class="mb-0">{{count($total)}}</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted text-truncate mb-2">Total Clients</p>
                                        @php
                                            $totalClients = count($clients);
                                        @endphp
                                        <h4 class="mb-0">{{ $totalClients }}</h4>
                                    </div>
                                    <div class="col-4">
                                        <p class="text-muted text-truncate mb-2">Total Bookings</p>
                                        <h4 class="mb-0">
                                            {{number_format($total_price[0]->total_price,1)}}
                                        </h4>
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
                    @elseif (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.update-agent-profile') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" id="" value="{{$agent_profile[0]->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-firstname-input" class="form-label">First Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="formrow-firstname-input" name="name" placeholder="Enter Your First Name"
                                           value="{{ $agent_profile[0]->name }}">
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
                                           value="{{ $agent_profile[0]->email }}" readonly>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="formrow-confirm-password-input" class="form-label">Role</label>
                                    <select name="Role" id="Role" class="form-select">
                                        <option value="Agent" {{$agent_profile[0]->Role === 'Agent' ? 'selected' : ''}}>Agent</option>
                                        <option value="Admin" {{$agent_profile[0]->Role === 'Admin' ? 'selected' : ''}}>Admin</option>
                                        <option value="Super Admin" {{$agent_profile[0]->Role === 'Super Admin' ? 'selected' : ''}}>Super Admin</option>

                                    </select>

                                    @error('Role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{route('agents-details')}}" class="btn btn-danger">Cancel</a>
                    </form>

                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>

@endsection
