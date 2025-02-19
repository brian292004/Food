@extends('layout')
@section('adminBody')
    <!-- DataTales Example -->
    <h1 class="text-center mb-4 text-primary">Danh sách tài khoản người dùng</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <form id="searchForm" action="{{ route('admin.searchUser') }}" method="get">
                <div class="search-container">
                    <input type="text" class="form-control bg-light border-0 small" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </form>
            
            <a href="{{route('admin.addUser')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add User
            </a>
        </div>
            <div class="card-body">
            <div class="table-responsive" id="searchResults" >
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-center">
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->role}}
                                </td>
                                <td>
                                    <span class="material-symbols-outlined" id="toggle-icon">
                                        @if($user->status == 'Lock')
                                            <button type="button" class="btn btn-danger" data-user-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#unlockAccountModal">
                                                toggle_on
                                            </button>     
                                        @else
                                            <button type="button" class="btn btn-secondary" data-user-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#lockAccountModal">
                                                toggle_off
                                            </button>
                                        @endif
                                    </span>
                                    
                                </td>
                                <td >
                                    <a href="{{route('admin.infoUser',['id' => $user->id])}}" class="btn btn-info btn-circle">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{route('admin.editUser',['id' => $user->id])}}" class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('admin.deleteUser',['id' => $user->id])}}" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <ul class="pagination"  >
                    {{ $users->links('pagination::bootstrap-4') }}
                </ul>
                </div>
            </div>
            @include('AdminPage.User.lockAccount')
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#lockAccountModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút đã kích hoạt modal
            var userId = button.data('user-id'); // Trích xuất thông tin từ thuộc tính data-*
            var modal = $(this);
            modal.find('.modal-body input[name="user_id"]').val(userId);

            // Cập nhật action của form với ID người dùng
            modal.find('form').attr('action', '{{ url("lock-account") }}/' + userId);

            // Hiển thị giá trị của input user_id trong console
            console.log('User ID:', userId);
        });
        $('#unlockAccountModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút đã kích hoạt modal
            var userId = button.data('user-id'); // Trích xuất thông tin từ thuộc tính data-*
            var modal = $(this);
            modal.find('.modal-body input[name="user_id"]').val(userId);
            modal.find('form').attr('action', '{{ url("lock-account") }}/' + userId);

            // Hiển thị giá trị của input user_id trong console
            console.log('User ID:', userId);
        });
    });
</script>
@endsection