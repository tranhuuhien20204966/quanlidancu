@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Hộ khẩu
        <a href="{{ url('admin/household') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p><strong>Số hộ khẩu: </strong> {{$household->id}}</p>
                <p><strong>Địa chỉ: </strong> {{ $household->address }}</p>

            <div class="col-md-12">
                <h5>Thành viên</h5>
            </div>
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>ID nhân khẩu</th>
                        <th>Ảnh đại diện</th>
                        <th>Họ và tên</th>
                        <th>Mối quan hệ với chủ hộ</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @foreach ($members as $member)
                    <tr>
                        <td>{{$member->personId}}</td>
                        <td>
                            <img src="{{ asset($member->person->avatar) }}" style="width: 40px; height: 40px" alt="Avatar" >
                          </td>
                        <td>{{$member->person->name}}</td>
                        <td>
                            @if ($member->relationship == 'chuho')
                            Chủ hộ
                            @elseif ($member->relationship == 'vochong')
                            Vợ (chồng)
                            @elseif ($member->relationship == 'chamede')
                            Cha đẻ, mẹ đẻ
                            @elseif ($member->relationship == 'chamenuoi')
                            Cha nuôi, mẹ nuôi
                            @elseif ($member->relationship == 'conde')
                            Con đẻ
                            @elseif ($member->relationship == 'connuoi')
                            Con nuôi
                            @elseif ($member->relationship == 'ongba')
                            Ông nội, bà nội
                            @elseif ($member->relationship == 'ongngoai')
                            Ông ngoại, bà ngoại
                            @elseif ($member->relationship == 'anhchiem')
                            Anh ruột; chị ruột; em ruột; cháu ruột
                            @elseif ($member->relationship == 'cu')
                            Cụ nội, cụ ngoại
                            @elseif ($member->relationship == 'bacchucaucodi')
                            Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột
                            @elseif ($member->relationship == 'nguoigiamho')
                            Người giám hộ
                            @elseif ($member->relationship == 'nguoionho')
                            Người ở nhờ; ở mượn; ở thuê
                            @elseif ($member->relationship == 'nguoicungonho')
                            Người cùng ở nhờ; cùng ở thuê; cùng ở mượn.
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group col-md-12">
                <a href="{{url('admin/household/'.$household->id.'/edit')}}" class="btn btn-primary">Sửa thông tin</a>
              </div>
              <div class="col-md-12">
                <h5>Các khoản thu đã nộp</h5>
            </div>
              @if($household->receipts->count('feeId')>0)
              <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Khoản thu</th>
                    <th>Người thu</th>
                    <th>Số tiền</th>
                    <th>Ghi chú</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($household->receipts as $receipt)   
                      <tr>
                        <td>{{$receipt->fee->id}}</td>
                        <td>{{$receipt->fee->name}}</td>
                        <td>{{$receipt->user->name}}</td>
                        <td>{{$receipt->amount}}</td>
                        <td>{{$receipt->note}}</td>
                      </tr>  
                  @endforeach
                </tbody>
              </table>
              @else
                <h6 class="text-center">Không tìm thấy phiếu thu nào. Xin hãy thêm phiếu thu!</h6>
              @endif
 <!-- Add the following code to retrieve mandatory fees not yet paid -->
@php
$mandatoryFeesNotPaid = App\Models\Fee::whereNotIn('id', $household->receipts->pluck('feeId')->toArray())
                              ->where('type', 'mandatory')
                              ->get();
@endphp

<!-- Update the code for the "Các khoản bắt buộc chưa nộp" section -->
<div class="col-md-12">
<h5>Các khoản bắt buộc chưa nộp</h5>
</div>
@if($mandatoryFeesNotPaid->count() > 0)
<table class="table table-bordered" id="mandatory-fees-table" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>ID</th>
      <th>Khoản thu</th>
      <th>Số tiền</th>
      <th>Nộp tiền</th>
    </tr>
  </thead>
  <tbody>
    @foreach($mandatoryFeesNotPaid as $fee)
      <tr>
        <td>{{$fee->id}}</td>
        <td>{{$fee->name}}</td>
        <td>{{$fee->amount*$household->members()->count()}}</td>
        <td><a href="{{ url('admin/receipt/create') }}" class="btn btn-primary btn-sm">Nộp tiền</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@else
<h6 class="text-center">Tất cả các khoản bắt buộc đã được nộp!</h6>
@endif

        </div>
    </div>
</div>

@endsection
