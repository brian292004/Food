@extends('layout')
@section('adminBody')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Thêm người dùng mới</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.updateUser',['id'=>$users->id])}}" method="POST"
                        id="uploadForm" enctype="multipart/form-data"> 
                        @csrf 
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Ảnh đại diện</label>
                            <div class="avatar-preview mb-3">
                                @if($users->avatar)
                                    <img id="avatar-preview" src="{{ asset('storage/avatars/' . $users->avatar) }}" alt="User Avatar" class="custom-rounded-circle" width="150">
                                @else
                                    <img id="avatar-preview" src="{{ asset('storage/avatars/M18-30.svg') }}" alt="Default Avatar" class="custom-rounded-circle" width="150">
                                @endif
                            </div>
                           
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <button type="button" id="crop-button" class="btn btn-primary">Cắt ảnh</button>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="name" name="name" required
                            value="{{$users->name}}">
                            <div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required
                            value="{{$users->email}}">
                            <div class="invalid-feedback">Vui lòng nhập một địa chỉ email hợp lệ.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <label for="role" class="form-label">Vai trò</label>
                            <select class="form-select" id="role" name="role" required aria-label="Chọn vai trò">
                                <option value="">Chọn vai trò</option>
                                <option value="Admin">Admin</option>
                                <option value="User">Người dùng</option>
                                <option value="Shop">Cửa hàng</option>
                            </select>
                            <div class="invalid-feedback">Vui lòng chọn vai trò.</div>
                        </div>

                        <button type="submit" id="submit-button" class="btn btn-primary">Sửa</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="submit" class="material-symbols-outlined btn btn-warning" 
                        onclick="window.history.back()">
                            arrow_back_ios
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection