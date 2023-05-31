@extends('layouts.header')
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Pending Tasks</h4>
      </div>
    </div>
  <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Payment & Others</h4>
         <div class="table-responsive">
        <table class="table mb-0 border-white">
            <thead class="table-dark text-uppercase bg-dark">
                <tr class="agent-tbl">
                    <th>#</th>
                    <th>Date</th>
                    <th>File #</th>
                    <th>Brand</th>
                    <th>Bank</th>
                    <th>Payment</th>
                    <th>Detail</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <tr class="agent-tbl-data">
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>
                      <a class="btn btn-outline-success btn-sm view" href="#" title="view">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>
                      <a class="btn btn-outline-primary btn-sm edit" href="#" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                      <a class="btn btn-outline-danger btn-sm delete" href="#" title="delete">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>

                </tr> 
            </tbody>
        </table>
      </div>
        </div>
      </div>
    </div><div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tickets</h4>
         <div class="table-responsive">
        <table class="table mb-0 border-white">
            <thead class="table-dark text-uppercase bg-dark">
                <tr class="agent-tbl">
                    <th>ID #</th>
                    <th>Date</th>
                    <th>File #</th>
                    <th>Brand</th>
                    <th>Supplier/Ref</th>
                    <th>GDS/PNR</th>
                    <th>cost</th>
                    <th>Details</th>

                </tr>
            </thead>
            <tbody>
                <tr class="agent-tbl-data">
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>
                      <a class="btn btn-outline-success btn-sm view" href="#" title="view">
                          <i class="fa fa-eye" aria-hidden="true"></i>
                      </a>
                      <a class="btn btn-outline-primary btn-sm edit" href="#" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                      </a>
                      <a class="btn btn-outline-danger btn-sm delete" href="#" title="delete">
                        <i class="fas fa-trash-alt"></i>
                      </a>
                    </td>

                </tr> 
            </tbody>
        </table>
      </div>
        </div>
      </div>
    </div>
    
  </div>
 </div>@endsection
