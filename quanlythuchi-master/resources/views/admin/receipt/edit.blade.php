@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Chỉnh sửa phiếu thu
        <a href="{{ url('admin/receipt') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
        <form action="{{ url('admin/receipt/'.$receipt->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Người nộp<span class="text-danger">*</span></label>
                    <select name="personId" class="form-control" required>
                        <option value="">Chọn ID nhân khẩu</option>
                        @foreach ($people as $person)
                        <option value="{{$person->id}}" {{$person->id == $receipt->personId ? 'selected' : ''}}>
                            {{$person->id.' '.$person->name}}
                        </option>
                        @endforeach
                    </select>
                    @error('personId')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6" id="householdGroup">
                    <label>Nộp cho hộ<span class="text-danger">*</span></label>
                    <select name="householdId" class="form-control">
                        <option value="">Chọn số hộ khẩu</option>
                        @foreach ($households as $household)
                        <option value="{{$household->id}}" {{$household->id == $receipt->householdId ? 'selected' : ''}}>
                            {{$household->id}}
                        </option>
                        @endforeach
                    </select>
                    @error('householdId')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Khoản thu<span class="text-danger">*</span></label>
                    <select name="feeId" id="typeSelect" class="form-control" required>
                        <option value="">Chọn khoản thu</option>
                        @foreach ($fees as $fee)
                        <option value="{{ $fee->id }}" data-type="{{ $fee->type }}"
                            {{$fee->id == $receipt->feeId ? 'selected' : ''}}>
                            {{ $fee->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('feeId')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label>Số tiền nộp<span class="text-danger">*</span></label>
                    <input type="number" name="amount" placeholder="Tên" value="{{$receipt->amount}}"
                        class="form-control">
                    @error('amount')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label>Ghi chú</span></label>
                    <input type="text" name="note" placeholder="Căn cước công dân(CCCD)" value="{{$receipt->note}}"
                        class="form-control">
                    @error('note')
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

    typeSelect.addEventListener('change', function () {
        const selectedOption = typeSelect.options[typeSelect.selectedIndex];
        const selectedType = selectedOption.getAttribute('data-type');

        if (selectedType === 'mandatory') {
            personIdGroup.style.display = 'block';
        } else {
            personIdGroup.style.display = 'none';
        }
    });
</script>
@endpush
