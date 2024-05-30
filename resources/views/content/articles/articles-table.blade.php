@extends('layouts/layoutMaster')

@section('title', 'Tickets Management - Crud App')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
  'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss',
  'resources/assets/vendor/libs/animate-css/animate.scss',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/moment/moment.js',
  'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js',
  'resources/assets/vendor/libs/cleavejs/cleave.js',
  'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
  'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/js/article-management.js'])
@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Search Filter</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-articles table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th>Id</th>
          <th>Title</th>
          <th>Content</th>
          <th>Category</th>
          <th>Is Active</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new ticker -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddArticle" aria-labelledby="offcanvasAddArticleLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddArticleLabel" class="offcanvas-title">Add Article</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-article pt-0" id="addNewArticleForm">
        <input type="hidden" name="id" id="article_id">
        <div class="mb-3">
          <label class="form-label" for="add-article-title">Title</label>
          <input type="text" class="form-control" id="add-article-title" placeholder="Enter Article Title" name="title" aria-label="Article Title" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-article-content">Content</label>
          <textarea  id="add-article-content" class="form-control" placeholder="Enter Article Content" aria-label="Article Content" name="content"></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-article-category">Category</label>
          <input type="text" id="add-article-category" name="category" class="form-control" placeholder="Category" aria-label="jdoe1" />
        </div>
      
        <div class=" mb-3">
            <div class="row row-bordered g-0">
              <div class="col-sm-6 ">
                <div class=" fw-medium mb-3">Is Active</div>
                <label class="form-label switch" for="is_active" >
                    <input type="checkbox" class="switch-input" name="is_active" id="is_active" onchange="changeValue(this)" />
                    <span class="switch-toggle-slider">
                    <span class="switch-on">
                      <i class="ti ti-check"></i>
                    </span>
                    <span class="switch-off">
                      <i class="ti ti-x"></i>
                    </span>
                  </span>
                </label>
              </div>
            
            </div>
          </div>
       
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>

<script>
    function changeValue(checkbox) {
      if (checkbox.checked) {
        checkbox.value = "1";
      } else {
        checkbox.value = "0";
      }
    }
  </script>
@endsection
