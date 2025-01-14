@extends('layout')
@section('adminBody')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Thông tin người dùng
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Tên:</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $users->name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email:</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $users->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">Vai trò:</label>

                        <div class="col-md-6">
                            <input id="role" type="text" class="form-control" name="role" value="{{ $users->role }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection