
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
