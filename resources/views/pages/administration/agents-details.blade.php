@extends('layouts.header')
@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Users List</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap table-hover">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">Agent ID</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($agent_detail as $key => $value )
                                    <tr>
                                        <td class="fw-bold" id="agent_id">{{$value->id}}</td>
                                        <td>
                                            <div>
                                                <img class="rounded-circle avatar-xs"
                                                     src="{{asset('assets/images/users')}}/{{$value->image}}"
                                                     alt="{{$value->name}} image">
                                            </div>
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 mb-1">
                                                <a href="javascript: void(0);" class="text-dark">{{$value->name}}</a>
                                            </h5>
                                            <p class="text-muted mb-0">{{$value->Role}}</p>
                                        </td>

                                        <td>{{$value->email}}</td>
                                        <td>{{$value->Role}}</td>
                                        <td><span
                                                class="fs-6 p-2 badge bg-{{$value->is_blocked == 0 ? 'danger' : 'success'}}">{{$value->is_blocked == 0 ? 'Blocked' : 'Active'}}</span>
                                        </td>
                                        <td>{{date('d-m-Y H:m:s a',strtotime($value->created_at))}}</td>

                                        <td class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                <li class="list-inline-item">
                                                    <a href="{{route('admin.agent-profile',$value->id)}}"
                                                       class="btn btn-success waves-effect waves-light  text-white p-1 font-size-18"><i
                                                            class="bx bx-cog bx-spin-hover"></i></a>
                                                </li>
                                                <li class="list-inline-item ">
                                                    <form class="block-agent-form">
                                                        @csrf
                                                        <input type="hidden" name="agent_id" value="{{ $value->id }}">
                                                        <input type="hidden" name="IsActive"
                                                               value="{{ $value->is_blocked }}">
                                                        <button type="submit"
                                                                class="btn btn-warning waves-effect waves-light p-1 font-size-18 block-agent">
                                                            <i class="bx bx-block"></i>
                                                        </button>
                                                    </form>
                                                </li>


                                                <li class="list-inline-item">
                                                    <form class="delete-agent">
                                                        @csrf
                                                        <input type="hidden" name="del_agent_id" value="{{ $value->id }}">
                                                        <button type="submit"
                                                                class="btn btn-danger waves-effect waves-light p-1 font-size-18 block-agent">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </form>


                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Include your Swal and jQuery libraries here -->
    <!-- ... -->

    <script>
        $(document).ready(function () {
            $('.block-agent-form').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var agentId = form.find('input[name="agent_id"]').val();
                var isActive = form.find('input[name="IsActive"]').val();

                Swal.fire({
                    title: 'Do you want to block this agent?',
                    showDenyButton: true,
                    showCancelButton: false,
                    icon: 'error',
                    confirmButtonText: 'Block',
                    denyButtonText: `Don't Block`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('admin.block-agent') }}",
                            method: "POST",
                            data:
                                {
                                    agent_id: agentId,
                                    isActive: isActive
                                },
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    html: data.message,
                                    willClose: () => {
                                        location.reload();
                                    }
                                })
                            }
                        })
                    }
                })
            });
        });



        $(document).ready(function () {
            $('.delete-agent').submit(function (e) {
                e.preventDefault();
                var form = $(this);
                var agentId = form.find('input[name="del_agent_id"]').val();

                Swal.fire({
                    title: 'Do you want to delete this agent?',
                    showDenyButton: true,
                    showCancelButton: false,
                    icon: 'error',
                    confirmButtonText: 'Delete',
                    denyButtonText: `Cancel`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('admin.delete-agent') }}",
                            method: "POST",
                            data:
                                {
                                    del_agent_id: agentId,
                                },
                            dataType: 'json',
                            success: function (data) {
                                Swal.fire({
                                    title: 'Success',
                                    icon: 'success',
                                    html: data.message,
                                    willClose: () => {
                                        location.reload();
                                    }
                                })
                            }
                        })
                    }
                })
            });
        });
    </script>

@endsection
