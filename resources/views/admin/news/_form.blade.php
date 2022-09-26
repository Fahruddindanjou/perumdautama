@extends('admin.layout.general')
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
<style>
    .note-editable  {
        height: 320px;
    }
</style>
@endsection
@section('content')
<form action="{{route('news.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        @if ($message = Session::get('error'))
            <div id="messageError" message='{{$message}}'>

            </div>
        @endif
        @if ($message = Session::get('success'))
            <div id="messageSuccess" message='{{$message}}'>

            </div>
        @endif
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    @if (!empty($news))
                    <a href="{{route('news.data')}}" style="font-weight: bold">Data Berita </a>» Update Berita
                    @else
                    <a href="{{route('news.index')}}" style="font-weight: bold">Berita </a>» Tambah Berita
                    @endif
                </h3>
                <h3 class="card-title" style="float: right">
                    @if (!empty($news))
                    <a href="{{route('news.form')}}"> <u>Tambah Berita</u></a>
                    @endif
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                    <label>Judul Berita</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Judul Berita" name="title"  @if(!empty($news['title'])) value="{{$news['title']}}" @else value="{{old('title')}}" @endif >
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea id="summernote" name="description" class="@error('description') is-invalid @enderror">
                        @if (!empty($news['description']))
                        {{$news['description']}}
                        @else
                        {{old('description')}}
                        @endif
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </textarea>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select required name="news_category_id" id="" class="form-control">
                            @foreach ($newsCategories as $result)
                                <option value="{{$result['id']}}"
                                    @if (!empty($news['news_category_id']))
                                        @if ($news['news_category_id'] == $result['id'])
                                            selected
                                        @endif
                                    @endif
                                >{{$result['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="customFile" accept="image/*" onchange="showPreview(event);">
                            <label class="custom-file-label @error('image') is-invalid @enderror" for="customFile">Choose file</label>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="preview mt-3">
                            <img id="file-ip-1-preview" style="display: none; height: 200px" width="100%">
                            @if (!empty($news['image']))
                                <img id="file-ip-1-preview-edit" src="{{asset('uploads/news/'.$news['image'])}}" alt="" style="height: 200px" width="100%">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Meta Keyword</label>
                        <input type="text" class="form-control" placeholder="Meta Keyword" name="meta_keyword" @if(!empty($news['meta_keyword'])) value="{{$news['meta_keyword']}}" @else value="{{old('meta_keyword')}}" @endif>
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" class="form-control" placeholder="Meta Description">@if(!empty($news['meta_description'])){{$news['meta_description']}}@else{{old('meta_description')}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        @if (!empty($news))
                            <button type="submit" class="btn btn-success" style="float: right">Update</button>
                        @else
                            <button type="submit" class="btn btn-primary" style="float: right">Simpan</button>
                        @endif
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
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
    $(function () {
      bsCustomFileInput.init();
    });
</script>
<script>
    $(function () {
        // Summernote
        $('#summernote').summernote()
    });

    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";

            var editImage = document.getElementById('file-ip-1-preview-edit');
            editImage.style.display = 'none';
        }
    }
</script>
@endsection
