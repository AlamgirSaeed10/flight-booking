@extends('layouts.header')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="text-white mt-2">Registered Users</h4>
            </div>
          <div class="card-body">
             <div class="table-responsive">
            <table class="table mb-0 border-white">
                <thead class="table-dark text-uppercase bg-dark">
                    <tr class="agent-tbl">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Create At</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($agent_detail as $key => $value )
                    <tr class="agent-tbl-data">
                        <td>{{++$key}}</td>
                        <td>{{$value->name}}</td>
                        <td>{{$value->email}}</td>
                        <td>{{$value->Role}}</td>
                        <td>{{date('d-m-Y H:m:s a',strtotime($value->created_at))}}</td>
                        <td>
                            <li class="list-inline-item">
                                <a href="{{$value->id}}" class="text-success p-1 font-size-18"><i class="bx bx-cog bx-spin"></i></a>
                            </li>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
            </div>
          </div>
        </div>
@endsection
