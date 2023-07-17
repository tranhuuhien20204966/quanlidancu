@extends('admin.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Sửa hộ khẩu
        <a href="{{ url('admin/household') }}" class="btn btn-danger btn-sm text-white float-right">Trở về</a>
    </h5>
    <div class="card-body">
        <form action="{{ url('admin/household/'.$household->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                  <p><strong>Số hộ khẩu: </strong> {{$household->id}}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="{{$household->address}}" class="form-control" />
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="col-md-12">
                    <h5>Các thành viên</h5>
                </div>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Mã nhân khẩu</th>
                            <th>Quan hệ với chủ hộ</th>
                            <th>Là chủ hộ</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                      @if ($members->count() > 0)
                      @foreach ($members as $member)
                      <tr>
                        <td>
                            <select name="personId[]" class="form-control" required>
                                <option value="">Chọn nhân khẩu</option>
                                @foreach ($people as $person)
                                <option value="{{$person->id}}" {{ $person->id == $member->personId ? 'selected' : '' }}>
                                  {{$person->id.' '.$person->name}}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="relationship[]" class="form-control" required>
                                <option value="Chủ hộ" {{ $member->relationship == 'Chủ hộ' ? 'selected' : '' }}>Chủ hộ</option>
                                <option value="Vợ (chồng)" {{ $member->relationship == 'Vợ (chồng)' ? 'selected' : '' }}>Vợ (chồng)</option>
                                <option value="Cha đẻ, mẹ đẻ" {{ $member->relationship == 'Cha đẻ, mẹ đẻ' ? 'selected' : '' }}>Cha đẻ, mẹ đẻ</option>
                                <option value="Cha nuôi, mẹ nuôi" {{ $member->relationship == 'Cha nuôi, mẹ nuôi' ? 'selected' : '' }}>Cha nuôi, mẹ nuôi</option>
                                <option value="Con đẻ" {{ $member->relationship == 'Con đẻ' ? 'selected' : '' }}>Con đẻ</option>
                                <option value="Con nuôi" {{ $member->relationship == 'Con nuôi' ? 'selected' : '' }}>Con nuôi</option>
                                <option value="Ông nội, bà nội" {{ $member->relationship == 'Ông nội, bà nội' ? 'selected' : '' }}>Ông nội, bà nội</option>
                                <option value="Ông ngoại, bà ngoại" {{ $member->relationship == 'Ông ngoại, bà ngoại' ? 'selected' : '' }}>Ông ngoại, bà ngoại</option>
                                <option value="Anh ruột; chị ruột; em ruột; cháu ruột" {{ $member->relationship == 'Anh ruột; chị ruột; em ruột; cháu ruột' ? 'selected' : '' }}>Anh ruột; chị ruột; em ruột; cháu ruột</option>
                                <option value="Cụ nội, cụ ngoại" {{ $member->relationship == 'Cụ nội, cụ ngoại' ? 'selected' : '' }}>Cụ nội, cụ ngoại</option>
                                <option value="Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột" {{ $member->relationship == 'Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột' ? 'selected' : '' }}>Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột</option>
                                <option value="Người giám hộ" {{ $member->relationship == 'Người giám hộ' ? 'selected' : '' }}>Người giám hộ</option>
                                <option value="Người ở nhờ; ở mượn; ở thuê" {{ $member->relationship == 'Người ở nhờ; ở mượn; ở thuê' ? 'selected' : '' }}>Người ở nhờ; ở mượn; ở thuê</option>
                                <option value="Người cùng ở nhờ; cùng ở thuê; cùng ở mượn" {{ $member->relationship == 'Người cùng ở nhờ; cùng ở thuê; cùng ở mượn' ? 'selected' : '' }}>Người cùng ở nhờ; cùng ở thuê; cùng ở mượn</option>
                            </select>                            
                        </td>
                        <td>
                            <select name="isOwner[]" class="form-control">
                                <option value="1" {{ $member->isOwner == 1 ? 'selected' : '' }}>Đúng</option>
                                <option value="0" {{ $member->isOwner == 0 ? 'selected' : '' }}>Sai</option>
                            </select>
                        </td>
                        <td>
                            @if ($member->isOwner)
                            <button type="button" name="add" id="add" class="btn btn-success">Thêm</button>
                            @else
                            <button type="button" name="remove" class="btn btn-danger remove">Bỏ</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                      @else
                      <tr>
                        <td>
                          <select name="personId[]" class="form-control" required>
                            <option value="">Chọn nhân khẩu</option>
                            @foreach ($people as $person)
                            <option value="{{$person->id}}">{{$person->id.' '.$person->name}}</option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                            <select name="relationship[]" class="form-control" required>
                                <option value="Chủ hộ">Chủ hộ</option>
                                <option value="Vợ (chồng)">Vợ (chồng)</option>
                                <option value="Cha đẻ, mẹ đ">Cha đẻ, mẹ đẻ</option>
                                <option value="Cha nuôi, mẹ nuôi">Cha nuôi, mẹ nuôi</option>
                                <option value="Con đẻ">Con đẻ</option>
                                <option value="Con nuôi">Con nuôi</option>
                                <option value="Ông nội, bà nội">Ông nội, bà nội</option>
                                <option value="Ông ngoại, bà ngoại">Ông ngoại, bà ngoại</option>
                                <option value="Anh ruột; chị ruột; em ruột; cháu ruột">Anh ruột; chị ruột; em ruột; cháu ruột</option>
                                <option value="Cụ nội, cụ ngoại">Cụ nội, cụ ngoại</option>
                                <option value="Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột">Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột</option>
                                <option value="Người giám hộ">Người giám hộ</option>
                                <option value="Người ở nhờ; ở mượn; ở thuê">Người ở nhờ; ở mượn; ở thuê</option>
                                <option value="Người cùng ở nhờ; cùng ở thuê; cùng ở mượn">Người cùng ở nhờ; cùng ở thuê; cùng ở mượn</option>
                              </select>
                        </td>
                        <td>
                          <select name="isOwner[]" class="form-control">
                            <option value="1">Đúng</option>
                            <option value="0">Sai</option>
                        </td>
                        <td>
                            <button type="button" name="add" id="add" class="btn btn-success">Thêm</button>
                        </td>
                      </tr>
                      @endif
                    </tbody>
                </table>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

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
    // Add member dynamically
    const addMemberButton = document.getElementById('add');
    const membersContainer = document.getElementById('tbody');
    const memberTemplate = `
    <td>
        <select name="personId[]" class="form-control">
            <option value="">Chọn đi</option>
            @foreach ($people as $person)
            <option value="{{$person->id}}">{{$person->id.' '.$person->name}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="relationship[]" class="form-control" required>
                    <option value="Chủ hộ">Chủ hộ</option>
                    <option value="Vợ (chồng)">Vợ (chồng)</option>
                    <option value="Cha đẻ, mẹ đ">Cha đẻ, mẹ đẻ</option>
                    <option value="Cha nuôi, mẹ nuôi">Cha nuôi, mẹ nuôi</option>
                    <option value="Con đẻ">Con đẻ</option>
                    <option value="Con nuôi">Con nuôi</option>
                    <option value="Ông nội, bà nội">Ông nội, bà nội</option>
                    <option value="Ông ngoại, bà ngoại">Ông ngoại, bà ngoại</option>
                    <option value="Anh ruột; chị ruột; em ruột; cháu ruột">Anh ruột; chị ruột; em ruột; cháu ruột</option>
                    <option value="Cụ nội, cụ ngoại">Cụ nội, cụ ngoại</option>
                    <option value="Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột">Bác ruột, chú ruột, cậu ruột, cô ruột, dì ruột, chắt ruột</option>
                    <option value="Người giám hộ">Người giám hộ</option>
                    <option value="Người ở nhờ; ở mượn; ở thuê">Người ở nhờ; ở mượn; ở thuê</option>
                    <option value="Người cùng ở nhờ; cùng ở thuê; cùng ở mượn">Người cùng ở nhờ; cùng ở thuê; cùng ở mượn</option>
                  </select>
    </td>
    <td>
        <select name="isOwner[]" class="form-control">
            <option value="0">Sai</option>
            <option value="1">Đúng</option>
        </select>
    </td>
    <td>
        <button type="button" name="remove" class="btn btn-danger remove">Remove</button>
    </td>
    `;

    function addMember() {
        const newRow = document.createElement('tr');
        newRow.innerHTML = memberTemplate;
        membersContainer.appendChild(newRow);
    }

    function removeMember(event) {
        const row = event.target.closest('tr');
        if (row) {
            row.remove();
        }
    }

    addMemberButton.addEventListener('click', addMember);
    membersContainer.addEventListener('click', (event) => {
        if (event.target.classList.contains('remove')) {
            removeMember(event);
        }
    });
</script>
@endpush
