@extends('admin.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('admin.layouts.notification')
         </div>
     </div>
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Danh sách nhân khẩu</h6>
      <a href="{{url('admin/person/create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i>Thêm nhân khẩu</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($people)>0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Ảnh đại diện</th>
              <th>Họ và tên</th>
              <th>Tuổi</th>
              <th>Giới tính</th>
              <th>CCCD</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Ảnh đại diện</th>
              <th>Họ và tên</th>
              <th>Tuổi</th>
              <th>Giới tính</th>
              <th>CCCD</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($people as $person)   
                <tr>
                  <td>{{$person->id}}</td>
                  <td>
                    <img src="{{ asset($person->avatar) }}" style="width: 40px; height: 40px" alt="Avatar" >
                  </td>
                  <td>{{$person->name}}</td>
                  <td>{{$person->age()}}</td>
                  <td>{{$person->gender == 'male' ? 'Nam':'Nữ'}}</td>
                  <td>{{$person->idCard}}</td>
                  <td>
                    <a href="{{url('admin/person/'.$person->id.'/edit')}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <a href="{{url('admin/person/'.$person->id.'/show')}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                    <form method="POST" action="{{url('admin/person/'.$person->id.'/delete')}}">
                      @csrf 
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$person->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                  </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$people->links()}}</span>
        @else
          <h6 class="text-center">Không tìm thấy nhân khẩu nào. Xin hãy thêm nhân khẩu!</h6>
        @endif
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#banner-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[1,4,5,6]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){
            
        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Bạn có chắc không?",
                    text: "Nếu bạn xoá, dữ liệu này sẽ không thể khôi phục lại!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Dữ liệu của bạn đã an toàn!");
                    }
                });
          })
      })
  </script>
@endpush