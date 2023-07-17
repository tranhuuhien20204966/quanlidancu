@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Thêm tạm trú tạm vắng
      <a href="{{ url('admin/temporary') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
      <form method="post" action="{{url('admin/temporary')}}">
        @csrf
        <div class="row">

          <div class="form-group col-md-6">
            <label>Người làm đơn<span class="text-danger">*</span></label>
            <select name="personId" class="form-control" required>
              <option value="">Chọn mã nhân khẩu</option>
              @foreach ($people as $person)
              <option value="{{$person->id}}">{{$person->id.' '.$person->name}}</option>
              @endforeach
            </select>
            @error('personId')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Loại hình</label><span class="text-danger">*</span></label>
            <select name="type" id="typeSelect" class="form-control">
                <option value="absence">Tạm vắng</option>
                <option value="residence">Tạm trú</option>
            </select>
            @error('type')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>
  
          <div class="form-group col-md-12" id="householdGroup">
            <label>Số hộ khẩu</label>
            <input type="text" name="householdId" id="householdId" placeholder="Tên" value="{{old('householdId')}}" class="form-control">
            @error('householdId')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Ngày bắt đầu<span class="text-danger">*</span></label>
            <input type="date" name="startDate" placeholder="Ngày bắt đầu"  value="{{old('startDate')}}" class="form-control">
            @error('startDate')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-6">
            <label>Ngày kết thúc<span class="text-danger">*</span></label>
            <input type="date" name="endDate" placeholder="Ngày kết thúc"  value="{{old('endDate')}}" class="form-control">
            @error('endDate')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-12">
            <label>Lý do<span class="text-danger">*</span></label>
            <input type="text" name="reason" placeholder="Tên"  value="{{old('reason')}}" class="form-control">
            @error('reason')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="form-group col-md-12">
            <label>Địa chỉ</span></label>
            <input type="text" name="beforeAddress" placeholder="Căn cước công dân(CCCD)"  value="{{old('beforeAddress')}}" class="form-control">
            @error('beforeAddress')
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

@push('scripts')
<script>
  // Hide or show "personId" field based on the selected "type"
  const typeSelect = document.getElementById('typeSelect');
  const personIdGroup = document.getElementById('householdGroup');
  
  typeSelect.addEventListener('change', function() {
    if (typeSelect.value === 'absence') {
      personIdGroup.style.display = 'block';
    } else {
      personIdGroup.style.display = 'none';
    }
  });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    // When the personId select field changes
    $('select[name="personId"]').change(function() {
      var personId = $(this).val(); // Get the selected personId

      // Make an AJAX request to fetch the householdId based on the personId
      $.ajax({
        url: '/get-household-id', // Replace with the actual route URL
        type: 'GET',
        data: { personId: personId },
        success: function(response) {
          // Update the householdId input field with the fetched value
          $('#householdId').val(response.householdId);
        },
        error: function(xhr) {
          console.log(xhr.responseText); // Log any errors for debugging
        }
      });
    });
  });
</script>

@endpush