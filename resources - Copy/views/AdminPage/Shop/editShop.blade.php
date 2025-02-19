<!-- filepath: /d:/php/Dự án PHP/orderFood/resources/views/AdminPage/Shop/editShop.blade.php -->
@extends('layout')
@section('adminBody')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Chỉnh sửa cửa hàng</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.updateShop', ['id' => $Shop->id]) }}" method="POST" id="uploadForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="shop_logo" class="form-label">Logo cửa hàng</label>
                            <div class="logo-preview mb-3">
                                @if($Shop->shop_logo)
                                    <img id="logo-preview" src="{{ asset('storage/shop_logo/' . $Shop->shop_logo) }}" alt="Shop Logo" class="custom-rounded-circle" width="150">
                                @else
                                    <img id="logo-preview" src="{{ asset('storage/shop_logo/default-logo.png') }}" alt="Default Logo" class="custom-rounded-circle" width="150">
                                @endif
                            </div>
                            <input type="file" class="form-control" id="shop_logo" name="shop_logo" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <button type="button" id="crop-button" class="btn btn-primary">Cắt ảnh</button>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên cửa hàng</label>
                            <input type="text" class="form-control" id="name" name="shop_name" required value="{{ $Shop->shop_name }}">
                            <div class="invalid-feedback">Vui lòng nhập tên cửa hàng.</div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="shop_address" required value="{{ $Shop->shop_address }}">
                            <div class="invalid-feedback">Vui lòng nhập địa chỉ.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ email</label>
                            <input type="email" class="form-control" id="email" name="shop_email" required value="{{ $Shop->shop_email }}">
                            <div class="invalid-feedback">Vui lòng nhập địa chỉ email.</div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="shop_phone" required value="{{ $Shop->shop_phone }}">
                            <div class="invalid-feedback">Vui lòng nhập số điện thoại.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="button" class="btn btn-warning" onclick="window.history.back()">Quay lại</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var shopLogo = document.getElementById('shop_logo');
        var logoPreview = document.getElementById('logo-preview');
        var cropper;

        shopLogo.addEventListener('change', function (e) {
            var files = e.target.files;
            var done = function (url) {
                shopLogo.value = '';
                logoPreview.src = url;
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(logoPreview, {
                    aspectRatio: 1,
                    viewMode: 1,
                    preview: '.preview',
                });
            };
            var reader;
            var file;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        document.getElementById('crop-button').addEventListener('click', function () {
            if (cropper) {
                var canvas = cropper.getCroppedCanvas({
                    width: 150,
                    height: 150,
                });
                logoPreview.src = canvas.toDataURL();
                canvas.toBlob(function (blob) {
                    var formData = new FormData(document.getElementById('uploadForm'));
                    formData.append('shop_logo', blob, 'shop_logo.png');
                    // Gửi form
                    fetch('{{ route("admin.updateShop", ["id" => $Shop->id]) }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Network response was not ok.');
                        }
                    }).then(data => {
                        console.log(data);
                        // Xử lý phản hồi từ server
                        window.location.href = '{{ route("admin.showShop") }}';
                    }).catch(error => {
                        console.error('Error:', error);
                        // Xử lý lỗi
                        alert('Đã thay đổi logo quán thành công.');
                    });
                });
            }
        });
    });
</script>
@endsection