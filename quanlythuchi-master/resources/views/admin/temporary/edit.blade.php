@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Chỉnh sửa tạm trú tạm vắng
        <a href="{{ url('admin/temporary') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
        <form action="{{ url('admin/temporary/'.$temporary->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Người làm đơn<span class="text-danger">*</span></label>
                    <select name="personId" class="form-control" required>
                      <option value="">Chọn mã nhân khẩu</option>
                      @foreach ($people as $person)
                      <option value="{{ $person->id }}" {{ $temporary->personId == $person->id ? 'selected' : '' }}>
                        {{ $person->id . ' ' . $person->name }}
                      </option>
                      @endforeach
                    </select>
                    @error('personId')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  

                <div class="form-group col-md-6">
                    <label>Loại hình</label><span class="text-danger">*</span></label>
                    <select name="type" id="typeSelect" class="form-control">
                        <option value="residence" {{ $temporary->type == 'residence' ? 'selected' : '' }}>Tạm trú</option>
                        <option value="absence" {{ $temporary->type == 'absence' ? 'selected' : '' }}>Tạm vắng</option>
                    </select>
                    @error('type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12" id="householdGroup">
                  <label>Số hộ khẩu</label>
                  <input type="text" name="householdId" placeholder="Tên" value="{{ $temporary->householdId }}" class="form-control">
                  @error('householdId')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
              </div>

                <div class="form-group col-md-6">
                    <label>Ngày bắt đầu<span class="text-danger">*</span></label>
                    <input type="date" name="startDate" placeholder="Ngày bắt đầu" value="{{ $temporary->startDate }}" class="form-control">
                    @error('startDate')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Ngày kết thúc<span class="text-danger">*</span></label>
                    <input type="date" name="endDate" placeholder="Ngày kết thúc" value="{{ $temporary->endDate }}" class="form-control">
                    @error('endDate')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label>Lý do<span class="text-danger">*</span></label>
                    <input type="text" name="reason" placeholder="Tên" value="{{ $temporary->reason }}" class="form-control">
                    @error('reason')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label>Địa chỉ</label>
                    <input type="text" name="beforeAddress" placeholder="Căn cước công dân(CCCD)" value="{{ $temporary->beforeAddress }}" class="form-control">
                    @error('beforeAddress')
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

@push('scripts')
<script>
    // Hide or show "personId" field based on the selected "type"
    const typeSelect = document.getElementById('typeSelect');
    const personIdGroup = document.getElementById('householdGroup');

    typeSelect.addEventListener('change', function() {
        if (typeSelect.value === 'residence') {
            personIdGroup.style.display = 'block';
        } else {
            personIdGroup.style.display = 'none';
        }
    });
</script>
@endpush
