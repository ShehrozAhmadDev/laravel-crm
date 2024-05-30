@extends('layouts/layoutMaster')

@section('title', 'Article Details')

@section('vendor-style')
@vite('resources/assets/vendor/libs/plyr/plyr.scss')
@endsection

@section('page-style')
@vite('resources/assets/vendor/scss/pages/app-academy-details.scss')
@endsection

@section('vendor-script')
@vite('resources/assets/vendor/libs/plyr/plyr.js')
@endsection

@section('page-script')
@vite('resources/assets/js/app-academy-course-details.js')
@endsection

@section('content')
<h4 class="pt-3 mb-0">
  <span class="text-muted fw-light">Article /</span>  Details
</h4>

<div class="card g-3 mt-5">
  <div class="card-body row g-3">
    <div class="col-lg-8">
      <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
        <div class="me-1">
          <h5 class="mb-1">{{ $article->title }}</h5>
          <p class="mb-1">Prof. <span class="fw-medium"> {{ $article->author }} </span></p>
        </div>
        <div class="d-flex align-items-center">
          <span class="badge bg-label-danger">{{ $article->category }}</span>
          <i class='ti ti-share ti-sm mx-4'></i>
          <i class='ti ti-bookmarks ti-sm'></i>
        </div>
      </div>
      <div class="card academy-content shadow-none border">
        <div class="card-body">
          <h5 class="mb-2">Description</h5>
          <div class="mb-0 pt-1">{!! $article->content !!}</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
