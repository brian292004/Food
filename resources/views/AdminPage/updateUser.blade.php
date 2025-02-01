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
<script>
    
    document.addEventListener('DOMContentLoaded', function () {
        var avatar = document.getElementById('avatar');
        var avatarPreview = document.getElementById('avatar-preview');
        var cropper;
        var croppedBlob;
    
        avatar.addEventListener('change', function (e) {
            var files = e.target.files;
            var done = function (url) {
                avatar.value = '';
                avatarPreview.src = url;
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(avatarPreview, {
                    aspectRatio: 1,
                    viewMode: 1,
                    preview: '.preview',
                });
            };
            var reader;
            var file;
            var url;
    
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
                avatarPreview.src = canvas.toDataURL();
                canvas.toBlob(function (blob) {
                    var formData = new FormData(document.getElementById('uploadForm'));
                    formData.append('avatar', blob, 'avatar.png');
                    // Gửi form
                    fetch('{{ route("admin.updateUser", ["id" => Auth::user()->id]) }}', {
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
                        window.location.href = '{{ route("admin.showUser") }}';
                    }).catch(error => {
                        console.error('Error:', error);
                        // Xử lý lỗi
                        alert('Thay đổi thành công');
                    });
                });
            }
        });
    });

</script>
@endsection