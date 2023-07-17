@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Chỉnh sửa khoản thu
        <a href="{{ url('admin/fee') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
        <form action="{{ url('admin/fee/'.$fee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-12">
                    <label>Tên khoản thu<span class="text-danger">*</span></label>
                    <input type="text" name="name" placeholder="Tên khoản thu" value="{{ $fee->name }}" class="form-control">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Số tiền<span class="text-danger">*</span></label>
                    <input type="number" name="amount" placeholder="Số tiền" value="{{ $fee->amount }}" class="form-control">
                    @error('amount')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Loại hình</label><span class="text-danger">*</span></label>
                    <select name="type" class="form-control">
                        <option value="mandatory" {{ $fee->type == 'mandatory' ? 'selected' : '' }}>Bắt buộc</option>
                        <option value="voluntary" {{ $fee->type == 'voluntary' ? 'selected' : '' }}>Tự nguyện</option>
                    </select>
                    @error('type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Ngày bắt đầu<span class="text-danger">*</span></label>
                    <input type="date" name="startDate" placeholder="Ngày bắt đầu" value="{{ $fee->startDate }}" class="form-control">
                    @error('startDate')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Ngày kết thúc<span class="text-danger">*</span></label>
                    <input type="date" name="endDate" placeholder="Ngày kết thúc" value="{{ $fee->endDate }}" class="form-control">
                    @error('endDate')
                    <span class="text-danger">{{ $message }}</span>
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
