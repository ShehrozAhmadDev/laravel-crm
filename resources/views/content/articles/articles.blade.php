@extends('layouts/layoutMaster')
@php
  $configData = Helper::appClasses();
@endphp

@section('title', 'Articles - Apps')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/plyr/plyr.scss'
])
@endsection

@section('page-style')
@vite('resources/assets/vendor/scss/pages/app-academy.scss')
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/plyr/plyr.js'
])
@endsection

@section('page-script')
@vite('resources/assets/js/app-academy-course.js')
@endsection

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">/</span> Articles</h4>

<div class="app-academy">
  <div class="card p-0 mb-4">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
      <div class="app-academy-md-25 card-body py-0">
        <img src="{{ asset('assets/img/illustrations/bulb-' . $configData['style'] . '.png') }}" class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand" data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png" height="90" />
      </div>
      <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center">
        <h3 class="card-title mb-4 lh-sm px-md-5 lh-lg">
          Education, talents, and career opportunities.
          <span class="text-primary fw-medium text-nowrap">All in one place</span>.
        </h3>
        <p class="mb-3">
          Grow your skill with the most reliable online courses and certifications in marketing, information technology,
          programming, and data science.
        </p>
        <div class="d-flex align-items-center justify-content-between app-academy-md-80">
          <input id="searchInput" type="search" placeholder="Find your article" class="form-control me-2" oninput="filterArticles()" />
          <button type="button" class="btn btn-primary btn-icon" onclick="filterArticles()"><i class="ti ti-search"></i></button>
        </div>
      </div>
      <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
        <img src="{{ asset('assets/img/illustrations/pencil-rocket.png') }}" alt="pencil rocket" height="188" class="scaleX-n1-rtl" />
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header d-flex flex-wrap justify-content-between gap-3">
      <div class="card-title mb-0 me-1">
        <h5 class="mb-1">My Articles</h5>
      </div>
      <div class="d-flex justify-content-md-end align-items-center gap-4 flex-wrap">
        <select id="select2_course_select" class="select2 form-select" data-placeholder="All Articles" onchange="filterArticles()">
          <option value="">All Articles</option>
          @foreach($categories as $category)
            <option value="{{ strtolower($category) }}">{{ $category }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="card-body">
      <div class="row gy-4 mb-4" id="articlesContainer">
        @foreach($articles as $article)
        <div class="col-sm-6 col-lg-4 article-item" data-category="{{ strtolower($article->category) }}" data-title="{{ strtolower($article->title) }}">
          <div class="card p-2 h-100 shadow-none border">
            <div class="rounded-2 text-center mb-3">
              <a href="/articles/details/{{$article->id}}"><img class="img-fluid" src="{{ asset('assets/img/pages/app-academy-tutor-1.png') }}" alt="tutor image 1" /></a>
            </div>
            <div class="card-body p-3 pt-2">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="badge bg-label-primary">{{ $article->category }}</span>
              </div>
              <a href="/articles/details/{{$article->id}}" class="h5">{{ $article->title }}</a>
              <p class="mt-2">{{ Str::limit(strip_tags($article->content), 100, '...') }}</p>
              <p class="d-flex align-items-center"><i class="ti ti-clock me-2 mt-n1"></i>Published: {{ $article->created_at->format('d M, Y') }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
        <ul class="pagination" id="paginationContainer"></ul>
      </nav>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    paginateArticles();
  });

  function paginateArticles() {
    const itemsPerPage = 10;
    const articles = document.querySelectorAll('.article-item');
    const paginationContainer = document.getElementById('paginationContainer');
    const totalPages = Math.ceil(articles.length / itemsPerPage);
    paginationContainer.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement('li');
      li.classList.add('page-item');
      li.innerHTML = `<a class="page-link" href="javascript:void(0);" onclick="showPage(${i}, ${itemsPerPage})">${i}</a>`;
      paginationContainer.appendChild(li);
    }

    showPage(1, itemsPerPage);
  }

  function showPage(page, itemsPerPage) {
    const articles = document.querySelectorAll('.article-item');
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    articles.forEach((article, index) => {
      article.style.display = index >= start && index < end ? 'block' : 'none';
    });
  }

  function filterArticles() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const categoryFilter = document.getElementById('select2_course_select').value.toLowerCase();
    const articles = document.querySelectorAll('.article-item');

    articles.forEach(article => {
      const title = article.getAttribute('data-title').toLowerCase();
      const category = article.getAttribute('data-category').toLowerCase();

      if ((title.includes(searchInput) || searchInput === '') &&
          (category.includes(categoryFilter) || categoryFilter === '')) {
        article.classList.add('filtered');
      } else {
        article.classList.remove('filtered');
      }
    });

    paginateFilteredArticles();
  }

  function paginateFilteredArticles() {
    const itemsPerPage = 10;
    const articles = document.querySelectorAll('.article-item.filtered');
    const paginationContainer = document.getElementById('paginationContainer');
    const totalPages = Math.ceil(articles.length / itemsPerPage);
    paginationContainer.innerHTML = '';

    for (let i = 1; i <= totalPages; i++) {
      const li = document.createElement('li');
      li.classList.add('page-item');
      li.innerHTML = `<a class="page-link" href="javascript:void(0);" onclick="showFilteredPage(${i}, ${itemsPerPage})">${i}</a>`;
      paginationContainer.appendChild(li);
    }

    showFilteredPage(1, itemsPerPage);
  }

  function showFilteredPage(page, itemsPerPage) {
    const articles = document.querySelectorAll('.article-item.filtered');
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    document.querySelectorAll('.article-item').forEach(article => {
      article.style.display = 'none';
    });

    articles.forEach((article, index) => {
      if (index >= start && index < end) {
        article.style.display = 'block';
      }
    });
  }
</script>
@endsection
