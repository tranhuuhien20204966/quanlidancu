@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thêm quản lý
      <a href="{{ url('admin/user') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
      <form method="post" action="{{url('admin/user')}}">
        @csrf
        <div class="row">
          <div class="form-group col-md-6">
            <label>ID nhân khẩu<span class="text-danger">*</span></label>
            <select name="personId" class="form-control" required>
              <option value="">Chọn ID nhân khẩu</option>
              @foreach ($people as $person)
              <option value="{{$person->id}}">{{$person->id}}</option>
              @endforeach
            </select>
            @error('personId')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>  
  
          <div class="form-group col-md-6">
            <label>Trạng thái<span class="text-danger">*</span></label>
            <select name="status" class="form-control">
                <option value="active">Kích hoạt</option>
                <option value="inactive">Không kích hoạt</option>
            </select>
            @error('status')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-12">
            <button type="reset" class="btn btn-warning">Khôi phục</button>
             <button type="submit" class="btn btn-success">Lưu trữ</button>
          </div>
        </div>
      </form>
    </div>
</div>

@endsection