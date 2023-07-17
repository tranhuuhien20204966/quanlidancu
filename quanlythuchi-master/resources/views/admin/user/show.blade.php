@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thông tin quản lý
        <a href="{{ url('admin/user') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Mã quản lý:</strong> {{ $user->id }}</p>
                <p><strong>Mã nhân khẩu:</strong> {{ $user->personId }}</p>
                <p><strong>Họ và tên:</strong> {{ $user->person->name }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $user->person->numberPhone }}</p>
                <p><strong>Tình trạng:</strong> {{ $user->status == 'active' ? 'Kích hoạt':'Không kích hoạt' }}</p>
                <p><strong>Ngày tạo:</strong> {{ $user->created_at }}</p>
                <p><strong>Ngày cập nhật:</strong> {{ $user->updated_at }}</p>
            </div>
        </div>
        <div class="form-group col-md-12">
            <a href="{{url('admin/user/'.$user->id.'/edit')}}" class="btn btn-primary">Sửa thông tin</a>
          </div>
    </div>
</div>

@endsection
