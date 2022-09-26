@extends('admin.layout.general')
@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="row">
    @if ($message = Session::get('success'))
        <div id="messageSuccess" message='{{$message}}'>

        </div>
    @endif
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title"><a href="{{route('news.index')}}" style="font-weight: bold">Berita </a>» Data Sampah Berita</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul Berita</th>
                  <th>Kategori</th>
                  <th style="width: 20px">Gambar</th>
                  <th style="width: 120px" class="text-center">Action</th>

                </tr>
                </thead>
                <tbody>
                    @foreach ($newsTrash as $result)
                        <tr>
                            <td>{{$result['title']}}</td>
                            <td>{{$result['categoryName']}}</td>
                            <td align="center">
                                <img src="{{asset('uploads/news/'.$result['image'])}}" class="rounded-sm" alt="" width="50">
                            </td>
                            <td align="center">
                                <form action="{{route('news.restore', $result['slug'])}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Restore</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- DataTables  & Plugins -->
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>

<script>
    $(document).ready(function() {

         //Message Success Flash
         var success = $('#messageSuccess').attr('message');
         if (success != null) {

             toastr.success(success)
         }
    });
</script>
@endsection
