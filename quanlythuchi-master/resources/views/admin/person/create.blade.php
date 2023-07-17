@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thêm nhân khẩu
      <a href="{{ url('admin/person') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
      <form method="post" action="{{url('admin/person')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="form-group col-md-6">
            <label>Họ tên đệm<span class="text-danger">*</span></label>
            <input type="text" name="lastName" placeholder="Họ tên đệm"  value="{{old('lastName')}}" class="form-control">
            @error('lastName')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
  
          <div class="form-group col-md-6">
            <label>Tên<span class="text-danger">*</span></label>
            <input type="text" name="firstName" placeholder="Tên"  value="{{old('firstName')}}" class="form-control">
            @error('firstName')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
  
          <div class="form-group col-md-12">
            <label>Căn cước công dân(CCCD)</span></label>
            <input type="text" name="idCard" placeholder="Căn cước công dân(CCCD)"  value="{{old('idCard')}}" class="form-control">
            @error('idCard')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-12">
            <label>Ảnh đại diện</span></label>
            <input type="file" name="avatar" placeholder="Ảnh đại diện"  value="{{old('avatar')}}" class="form-control">
            @error('avatar')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Ngày sinh<span class="text-danger">*</span></label>
            <input type="date" name="dateOfBirth" placeholder="Căn cước công dân(CCCD)"  value="{{old('dateOfBirth')}}" class="form-control">
            @error('dateOfBirth')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
  
          <div class="form-group col-md-6">
            <label>Giới tính<span class="text-danger">*</span></label>
            <select name="gender" class="form-control">
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
            </select>
            @error('gender')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Dân tộc<span class="text-danger">*</span></label>
            <input type="text" name="ethnic" placeholder="Dân tộc"  value="{{old('ethnic')}}" class="form-control">
            @error('ethnic')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Quốc tịch<span class="text-danger">*</span></label>
            <input type="text" name="nationality" placeholder="Quốc tịch"  value="{{old('nationality')}}" class="form-control">
            @error('nationality')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" name="email" placeholder="Email"  value="{{old('email')}}" class="form-control">
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Số điện thoại</label>
            <input type="text" name="numberPhone" placeholder="Số điện thoại"  value="{{old('numberPhone')}}" class="form-control">
            @error('numberPhone')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-12">
            <label>Quê quán<span class="text-danger">*</span></label>
            <input type="text" name="address" placeholder="Quê quán"  value="{{old('address')}}" class="form-control">
            @error('address')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Nghề nghiệp</label>
            <input type="text" name="occupation" placeholder="Nghề nghiệp"  value="{{old('occupation')}}" class="form-control">
            @error('occupation')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Trình độ học vấn</label>
            <input type="text" name="educationLevel" placeholder="Trình độ học vấn"  value="{{old('educationLevel')}}" class="form-control">
            @error('educationLevel')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
          
          <div class="form-group col-md-6">
            <label>Tình trạng hôn nhân<span class="text-danger">*</span></label>
            <select name="maritalStatus" class="form-control">
                <option value="single">Độc thân</option>
                <option value="married">Đã kết hôn</option>
            </select>
            @error('martitalStatus')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Tình trạng<span class="text-danger">*</span></label>
            <select name="status" class="form-control">
                <option value="alive">Còn sống</option>
                <option value="dead">Đã mất</option>
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