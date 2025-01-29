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
                    <div class="mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Ảnh đại diện:</label>
                        <div class="avatar-preview mb-3">
                            @if($users->avatar)
                                <img id="avatar-preview" src="{{ asset('storage/avatars/' . $users->avatar) }}" alt="User Avatar" class="custom-rounded-circle" width="150">
                            @else
                                <img id="avatar-preview" src="{{ asset('storage/avatars/M18-30.svg') }}" alt="Default Avatar" class="custom-rounded-circle" width="150">
                            @endif
                        </div>
                    </div>
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
                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">Thời gian lập tài khoản:</label>

                        <div class="col-md-6">
                            <input id="create" type="text" class="form-control" name="role" value="{{ $users->created_at }}" readonly>
                        </div>
                    </div>
                    <button type="submit" class="material-symbols-outlined btn btn-secondary" 
                        onclick="window.history.back()">
                            arrow_back_ios
                    </button>
                </div>
        </div>
    </div>
</div>
@endsection