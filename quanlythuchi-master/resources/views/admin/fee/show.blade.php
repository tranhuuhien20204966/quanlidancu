@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thông tin khoản thu<a href="{{ url('admin/fee') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
              <p><strong>Mã khoản thu:</strong> {{ $fee->id }}</p>
              <p><strong>Tên khoản thu:</strong> {{ $fee->name }}</p>
              <p><strong>Loại hình:</strong> {{ $fee->type == 'mandatory' ? 'Bắt buộc':'Tự nguyện' }}</p>
              <p><strong>Tổng số tiền đã thu:</strong> {{ $fee->receipts->sum('amount') }} VNĐ</p>
              @if ($fee->type == 'mandatory')
              <p><strong>Số hộ đã thu:</strong> {{ $fee->receipts->count('householdId') }}/{{$households->count()}}</p>
              @endif
          </div>
          <div class="col-md-6">
            <p><strong>Ngày bắt đầu:</strong>{{$fee->startDate}}</p>
            <p><strong>Ngày kết thúc:</strong> {{ $fee->endDate }}</p>
            <p><strong>Ngày tạo:</strong> {{ $fee->created_at }}</p>
            <p><strong>Ngày cập nhật:</strong> {{ $fee->updated_at }}</p>
        </div>
        <div class="form-group col-md-12">
            <a href="{{url('admin/fee/'.$fee->id.'/edit')}}" class="btn btn-primary">Sửa thông tin</a>
          </div>

            @if($fee->receipts->count('householdId') > 0)
            <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Mã hộ khẩu</th>
                  <th>Chủ hộ</th>
                  <th>Địa chỉ</th>
                  <th>Số thành viên</th>
                </tr>
              </thead>
              <tbody>
                @foreach($fee->receipts as $receipt)
                    @if($receipt->household)
                        <tr>
                            <td>{{$receipt->household->id}}</td>
                            <td>
                            @foreach ($receipt->household->members as $member)
                                @if ($member->isOwner)
                                    {{$member->person->name}}
                                @endif
                            @endforeach
                            </td>
                            <td>{{$receipt->household->address}}</td>
                            <td>{{$receipt->household->members->count()}}</td>
                        </tr>  
                    @endif
                @endforeach
              </tbody>
            </table>
            @else
              <h6 class="text-center">Không tìm thấy hộ khẩu nào!</h6>
            @endif
        </div>
    </div>
</div>

@endsection
