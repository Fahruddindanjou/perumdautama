@extends('admin.layout.general')
@section('search')
<li class="nav-item">
    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
    </a>
    <div class="navbar-search-block">
        <form class="form-inline">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
            </button>
            </div>
        </div>
        </form>
    </div>
</li>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if ($message = Session::get('error'))
                <div id="messageError" message='{{$message}}'>

                </div>
            @endif
            @if ($message = Session::get('success'))
                <div id="messageSuccess" message='{{$message}}'>

                </div>
            @endif
            <div class="card-header">
                <h3 class="card-title"> <a href="{{route('news.index')}}" style="font-weight: bold">Berita </a>» Kategori Berita</h3>
                <a href="" style="float: right" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">Tambah</a>
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Kategori Berita</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('news-category.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Nama Kategori</label>
                                        <input type="text" name="name" class="form-control" placeholder="Nama Kategori">
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
          <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Nama Kategori</th>
                            <th style="width: 12rem; text-align:center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($newsCategories))
                        <tr>
                            <td colspan="3" align="center">Data not found</td>
                        </tr>
                        @endif

                        @foreach ($newsCategories as $result)
                            <tr>
                                <td>{{$result['code']}}</td>
                                <td>{{$result['name']}}</td>
                                <td align="center">
                                    <form action="{{route('news-category.destroy', $result['slug'])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <a href="" class="btn btn-success btn-sm mr-1" data-toggle="modal" data-target="#modalEdit-{{$result['slug']}}">Edit</a>
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="modalEdit-{{$result['slug']}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Kategori Berita</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('news-category.update', $result['slug'])}}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Kategori</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Nama Kategori" value="{{$result['name']}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-end">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('js')
<script>
       $(document).ready(function() {
            //Message Error Flash
            var error = $('#messageError').attr('message');
            if (error != null) {

                toastr.error(error)
            }

            //Message Success Flash
            var success = $('#messageSuccess').attr('message');
            if (success != null) {

                toastr.success(success)
            }
       });
</script>
@endsection
