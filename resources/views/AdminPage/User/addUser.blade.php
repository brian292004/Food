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
                    <form action="{{route('admin.store.addUser')}}" method="POST"> 
                        @csrf 
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Vui lòng nhập tên người dùng.</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Vui lòng nhập một địa chỉ email hợp lệ.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="6">
                            <div class="invalid-feedback">Mật khẩu phải có ít nhất 6 ký tự.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            <div class="invalid-feedback">Mật khẩu không khớp.</div>
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

                        <button type="submit" class="btn btn-primary">Thêm người dùng</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection