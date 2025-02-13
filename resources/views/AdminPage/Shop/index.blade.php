@extends('layout')
@section('adminBody')
    <!-- DataTales Example -->
    <h1 class="text-center mb-4 text-primary">Danh sách các quán</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <form id="searchForm" action="{{route('admin.searchShop')}}" method="get">
                <div class="search-container">
                    <input type="text" class="form-control bg-light border-0 small" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </form>
            
            <a href="{{route('admin.addShop')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                 Thêm cửa hàng mới
            </a>
        </div>
            <div class="card-body">
            <div class="table-responsive" id="searchResults" >
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Tên quán</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ email quán</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Shop as $shop)
                            <tr class="text-center">
                                <td>
                                    {{$shop->shop_name}}
                                </td>
                                <td>
                                    {{$shop->shop_address}}
                                </td>
                                <td>
                                    {{$shop->shop_phone}}
                                </td>
                                <td>
                                    {{ $shop->shop_email }}
                                </td>
                                <td>
                                    <span class="material-symbols-outlined" id="toggle-icon-{{ $shop->id }}">
                                        @if($shop->shop_status == 'Lock')
                                            <button type="button" class="btn btn-danger" data-shop-id="{{ $shop->id }}" data-bs-toggle="modal" data-bs-target="#unlockAccountModal">
                                                toggle_on
                                            </button>     
                                        @else
                                            <button type="button" class="btn btn-secondary" data-shop-id="{{ $shop->id }}" data-bs-toggle="modal" data-bs-target="#lockAccountModal">
                                                toggle_off
                                            </button>
                                        @endif
                                    </span>
                                </td>
                                <td >
                                    <a href="{{route('admin.infoShop',['id' => $shop->id])}}" class="btn btn-info btn-circle">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{route('admin.editShop',['id' => $shop->id])}}" class="btn btn-warning btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('admin.deleteShop',['id' => $shop->id])}}" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <ul class="pagination"  >
                    {{ $Shop->links('pagination::bootstrap-4') }}
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
            var shopId = button.data('shop-id'); // Trích xuất thông tin từ thuộc tính data-*
            var modal = $(this);
            modal.find('.modal-body input[name="shop_id"]').val(shopId);

            // Cập nhật action của form với ID cửa hàng
            modal.find('form').attr('action', '{{ url("lockShop") }}/' + shopId);

            // Hiển thị giá trị của input shop_id trong console
            console.log('Shop ID:', shopId);
        });

        $('#unlockAccountModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Nút đã kích hoạt modal
            var shopId = button.data('shop-id'); // Trích xuất thông tin từ thuộc tính data-*
            var modal = $(this);
            modal.find('.modal-body input[name="shop_id"]').val(shopId);
            modal.find('form').attr('action', '{{ url("lockShop") }}/' + shopId);

            // Hiển thị giá trị của input shop_id trong console
            console.log('Shop ID:', shopId);
        });
    });
</script>
@endsection