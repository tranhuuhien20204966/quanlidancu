@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thông tin nhân khẩu
        <a href="{{ url('admin/person') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Họ tên đệm:</strong> {{ $person->lastName }}</p>
                <p><strong>Tên:</strong> {{ $person->firstName }}</p>
                <p><strong>Căn cước công dân (CCCD):</strong> {{ $person->idCard }}</p>
                <p><strong>Ảnh đại diện:</strong></p>
                <img src="{{ asset($person->avatar) }}" width="70px" height="70px">
                <p><strong>Ngày sinh:</strong> {{ $person->dateOfBirth }}</p>
                <p><strong>Giới tính:</strong> {{ $person->gender }}</p>
                <p><strong>Dân tộc:</strong> {{ $person->ethnic }}</p>
                <p><strong>Quốc tịch:</strong> {{ $person->nationality }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Email:</strong> {{ $person->email }}</p>
                <p><strong>Số điện thoại:</strong> {{ $person->numberPhone }}</p>
                <p><strong>Quê quán:</strong> {{ $person->address }}</p>
                <p><strong>Nghề nghiệp:</strong> {{ $person->occupation }}</p>
                <p><strong>Trình độ học vấn:</strong> {{ $person->educationLevel }}</p>
                <p><strong>Tình trạng hôn nhân:</strong> {{ $person->maritalStatus }}</p>
                <p><strong>Tình trạng:</strong> {{ $person->status }}</p>
                <p><strong>Ngày tạo:</strong> {{ $person->created_at }}</p>
                <p><strong>Ngày cập nhật:</strong> {{ $person->updated_at }}</p>
            </div>
        </div>
        <div class="form-group col-md-12">
            <a href="{{url('admin/person/'.$person->id.'/edit')}}" class="btn btn-primary">Sửa thông tin</a>
          </div>
    </div>
</div>

@endsection
