@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h6 class="text-white text-capitalize ps-3">Add New Category</h6>
                        </div>
                        
                    </div>
                </div>
                <div class="card-body  p-3">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif  
                    <form  action="{{ route('category.newCategory') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <input type="text" class="form-control"   name="category" id="Category" aria-describedby="categoryHelp" style="border: groove;">
                            @error('category')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary m-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
