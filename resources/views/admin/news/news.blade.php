@extends('admin.layout.general')
@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-primary">
        <div class="inner">
          <h4 style="font-weight: bold">News Categories</h4>

          <p>Kategori Berita</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-list"></i>
        </div>
        <a href="{{route('news-category.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
            <h4 style="font-weight: bold">Add News</h4>
            <p>Tambah Berita</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-add-circle"></i>
        </div>
        <a href="{{route('news.form')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
            <h4 style="font-weight: bold">News Data</h4>
            <p>Data Berita</p>
        </div>
        <div class="icon">
          <i class="ion ion-folder"></i>
        </div>
        <a href="{{route('news.data')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
              <h4 style="font-weight: bold">News Trash</h4>
              <p>Sampah Berita</p>
          </div>
          <div class="icon">
            <i class="ion ion-trash-a"></i>
          </div>
          <a href="{{route('news.trash')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
</div>
@endsection
