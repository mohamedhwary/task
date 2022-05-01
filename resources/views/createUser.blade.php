@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 row">
                        <div class="col-6">
                            <h6 class="text-white text-capitalize ps-3">Add New User</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body  p-3">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('user.newUser') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control"   name="user" id="user" aria-describedby="categoryHelp" style="border: groove;">
                            
                            @error('user')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="newemail">Email</label>
                            <input type="text" class="form-control"   name="email" id="email" aria-describedby="userHelp" style="border: groove;">
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="qty">Password </label>
                            <input type="password" class="form-control"   name="password" id="password" aria-describedby="categoryHelp" style="border: groove;">
                            @error('password')
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
