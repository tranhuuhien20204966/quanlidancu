@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thông tin phiếu thu<a href="{{ url('admin/receipt') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
              <p><strong>ID:</strong> {{ $receipt->id }}</p>
              <p><strong>Người nộp:</strong> {{ $receipt->person->name }}</p>
              <p><strong>ID nhân khẩu:</strong> {{ $receipt->personId }}</p>
              @if ($receipt->householdId)
              <p><strong>Nộp cho hộ:</strong> {{ $receipt->householdId }}</p>
              <p><strong>Ghi chú:</strong> {{ $receipt->note }}</p>
              @endif
            </div>
            <div class="col-md-6">
              <p><strong>Khoản thu:</strong> {{ $receipt->fee->name }}</p>
              <p><strong>Số tiền:</strong> {{ $receipt->amount }} VNĐ</p>
              <p><strong>Người thu:</strong> {{ $receipt->user->name }}</p>
              <p><strong>Ngày tạo:</strong> {{ $receipt->created_at }}</p>
              <p><strong>Ngày cập nhật:</strong> {{ $receipt->updated_at }}</p>
          </div>

          <div class="form-group col-md-12">
            <a href="{{url('admin/receipt/'.$receipt->id.'/edit')}}" class="btn btn-primary">Sửa thông tin</a>
          </div>
        </div>
    </div>
</div>

@endsection
