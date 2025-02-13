@extends('layout')
@section('adminBody')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Thông tin quán
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Logo cửa hàng:</label>
                        <div class="avatar-preview mb-3">
                            @if($Shop->shop_logo)
                                <img id="avatar-preview" src="{{ asset('storage/shop_logo/' . $Shop->shop_logo) }}" alt="User Avatar" class="custom-rounded-circle" width="150">
                            @else
                                <img id="avatar-preview" src="{{ asset('storage/shop_logo/M18-30.svg') }}" alt="Default Avatar" class="custom-rounded-circle" width="150">
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Tên quán:</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="shop_name" value="{{ $Shop->shop_name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email quán:</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="shop_email" value="{{ $Shop->shop_email }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="role" class="col-md-4 col-form-label text-md-end">Thời gian lập tài khoản:</label>

                        <div class="col-md-6">
                            <input id="create" type="text" class="form-control" name="role" value="{{ $Shop->created_at }}" readonly>
                        </div>
                    </div>
                    <button type="submit" class="material-symbols-outlined btn btn-secondary" 
                        onclick="window.history.back()">
                            arrow_back_ios
                    </button>
                    <a href="{{route('admin.editShop',['id' => $Shop->id])}}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
        </div>
    </div>
</div>
@endsection