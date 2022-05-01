@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h6 class="text-white text-capitalize ps-3">Add New Product</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body  p-3">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('product.newProduct') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="categoryHelp"
                                style="border: groove;">

                            @error('name')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="desc">descreption</label>
                            <input type="text" class="form-control" name="desc" id="desc" aria-describedby="userHelp"
                                style="border: groove;">
                            @error('desc')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="qty">qty </label>
                            <input type="text" class="form-control" name="qty" id="qty" aria-describedby="categoryHelp"
                                style="border: groove;">
                            @error('qty')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">price </label>
                            <input type="text" class="form-control" name="price" id="price"
                                aria-describedby="categoryHelp" style="border: groove;">
                            @error('price')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="qty">Category </label>
                            <select class="categorySelect" name="category[]" multiple="multiple">
                                @foreach ($category as $category)
                                    <option value="{{ $category->id }}">{{ $category->name}} </option>
                                @endforeach
                            </select>

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
