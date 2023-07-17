@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thông tin tạm trú tạm vắng<a href="{{ url('admin/temporary') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
              <p><strong>ID đơn:</strong> {{ $temporary->id }}</p>
              <p><strong>Người làm đơn:</strong> {{ $temporary->person->name }}</p>
              <p><strong>ID nhân khẩu:</strong> {{ $temporary->personId }}</p>
              <p><strong>Loại hình:</strong> {{ $temporary->type == 'residence' ? 'Tạm trú':'Tạm vắng' }}</p>
              @if ($temporary->type == 'absence')
              <p><strong>Số hộ khẩu:</strong> {{ $temporary->householdId }}</p>
              @endif
              <p><strong>Ngày bắt đầu:</strong>{{$temporary->startDate}}</p>
              <p><strong>Ngày kết thúc:</strong> {{ $temporary->endDate }}</p>
            </div>
            <div class="col-md-6">
              <p><strong>Lý do:</strong> {{ $temporary->reason }}</p>
              <p><strong>Địa chỉ:</strong> {{ $temporary->beforeAddress }}</p>
              <p><strong>Người tạo đơn:</strong> {{ $temporary->user->name }}</p>
              <p><strong>Ngày tạo:</strong> {{ $temporary->created_at }}</p>
              <p><strong>Ngày cập nhật:</strong> {{ $temporary->updated_at }}</p>
          </div>

            <div class="form-group col-md-12">
              <a href="{{url('admin/temporary/'.$temporary->id.'/edit')}}" class="btn btn-primary">Sửa thông tin</a>
            </div>
        </div>
    </div>
</div>

@endsection
