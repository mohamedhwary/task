@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h6 class="text-white text-capitalize ps-3">Products table</h6>
                        </div>
                        <div class="col-6" style="text-align: right;">
                            <a href="{{ route('products.create') }}"  class='btn btn-light' ><i class='fa fa-plus' aria-hidden='true'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="productsTable">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width:100px !important">description
                                    </th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        quantity</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        price</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create By</th>
                                      <th
                                      class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      updated at</th>
                                    <th class="text-secondary opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit -->
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="editModel" aria-hidden="true" style="height: fit-content;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form_controls" id = "porductId">

          <input type="text" class="form_controls" id = "name">
          <input type="text" class="form_controls" id = "desc">
          <input type="text" class="form_controls" id = "qty">
          <input type="text" class="form_controls" id = "price">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="saveChangeProduct">Save changes</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Modal delete -->
<div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProduct" aria-hidden="true" style="height: fit-content;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModel">Are you sure for delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" class="form_controls" id = "porductId">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="deleteProductBtn">Delete</button>
        </div>
      </div>
    </div>
  </div>

@endsection
