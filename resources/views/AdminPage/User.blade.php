@extends('layout')
@section('adminBody')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            <a href="{{route('admin.addUser')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add User
            </a>
        </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            {{-- <th>Image</th> --}}
                            {{-- <th>Start date</th> --}}
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
        </div>
        
        
    </div>
</div>
@endsection