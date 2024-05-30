@extends('layouts/layoutMaster')

@section('title', 'Company Details')

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
<!-- Font Awesome for social media icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
@endsection

@section('content')
<!-- Users List Table -->
<div class="container mt-5">
    <div class="card p-4">
        <div class="row no-gutters">
            <div class="col-md-3">
                <img src="{{ asset('assets/img/avatars/1.png') }}" class="card-img img-fluid" alt="Employee Picture">
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h2 class="card-title">John Doe</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida. Ultrices eros in cursus turpis massa tincidunt. Fermentum dui faucibus in ornare quam viverra orci sagittis eu. Tristique risus nec feugiat in fermentum posuere urna. Sed nisi lacus sed viverra tellus in hac. Cursus euismod quis viverra nibh cras pulvinar mattis nunc sed. Imperdiet sed euismod nisi porta lorem mollis aliquam ut.</p>
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ti ti-phone ti-sm mr-2"></i>
                            <p class="card-text mx-2 mb-0"><small class="text-muted"> (123) 456-7890</small></p>
                        </div>
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ti ti-mail ti-sm mr-2"></i>
                            <p class="card-text mx-2 mb-0"><small class="text-muted">john.doe@example.com</small></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex align-items-center">
                            <a href="https://www.linkedin.com/in/johndoe" class="text-muted mx-2" target="_blank">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                            <a href="https://twitter.com/johndoe" class="text-muted mx-2" target="_blank">
                                <i class="fab fa-twitter fa-lg"></i>
                            </a>
                            <a href="https://www.facebook.com/johndoe" class="text-muted mx-2" target="_blank">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a href="https://www.instagram.com/johndoe" class="text-muted mx-2" target="_blank">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5">
    <div class="card p-4">
        @foreach($employees as $employee)
            <div class="row no-gutters mb-4 d-flex align-items-center" >
                <div class="col-md-2 d-flex justify-content-center">
                    <img src="{{ asset('assets/img/avatars/' . $employee['image']) }}" class="card-img" alt="Employee Picture">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h2 class="card-title">{{ $employee['name'] }}</h2>
                        <p class="card-text">{{ $employee['description'] }}</p>
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center">
                                <i class="ti ti-phone ti-sm mr-2"></i>
                                <p class="card-text mx-2 mb-0"><small class="text-muted"> {{ $employee['phone'] }}</small></p>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <i class="ti ti-mail ti-sm mr-2"></i>
                                <p class="card-text mx-2 mb-0"><small class="text-muted">{{ $employee['email'] }}</small></p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 d-flex align-items-center">
                                <a href="{{ $employee['linkedin'] }}" class="text-muted mx-2" target="_blank">
                                    <i class="fab fa-linkedin fa-lg"></i>
                                </a>
                                <a href="{{ $employee['twitter'] }}" class="text-muted mx-2" target="_blank">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <a href="{{ $employee['facebook'] }}" class="text-muted mx-2" target="_blank">
                                    <i class="fab fa-facebook fa-lg"></i>
                                </a>
                                <a href="{{ $employee['instagram'] }}" class="text-muted mx-2" target="_blank">
                                    <i class="fab fa-instagram fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (!$loop->last)
                <hr>
            @endif
        @endforeach
    </div>
</div>
@endsection
