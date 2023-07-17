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
      <h6 class="m-0 font-weight-bold text-primary float-left">Danh sách tạm trú tạm vắng</h6>
      <a href="{{url('admin/temporary/create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i>Thêm tạm trú tạm vắng</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($temporaries)>0)
        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Người làm đơn</th>
              <th>Loại hình</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Người tạo đơn</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Người làm đơn</th>
              <th>Loại hình</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
              <th>Người tạo đơn</th>
              <th>Hành động</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($temporaries as $temporary)   
                <tr>
                  <td>{{$temporary->id}}</td>
                  <td>{{$temporary->person->name}}</td>
                  <td>{{$temporary->type == 'absence' ? 'Tạm vắng':'Tạm trú'}}</td>
                  <td>{{$temporary->startDate}}</td>
                  <td>{{$temporary->endDate}}</td>
                  <td>{{$temporary->user->name}}</td>
                  <td>
                    <a href="{{url('admin/temporary/'.$temporary->id.'/edit')}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <a href="{{url('admin/temporary/'.$temporary->id.'/show')}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                    <form method="POST" action="{{url('admin/temporary/'.$temporary->id.'/delete')}}">
                      @csrf 
                      @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$temporary->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                  </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$temporaries->links()}}</span>
        @else
          <h6 class="text-center">Không tìm thấy tạm trú tạm vắng nào. Xin hãy thêm tạm trú tạm vắng!</h6>
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
                    "targets":[]
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