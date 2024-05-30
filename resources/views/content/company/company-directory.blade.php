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
        <div class="row no-gutters d-flex align-items-center">
            <div class="col-md-2 d-flex justify-content-center">
                <img src="{{ asset('assets/img/avatars/1.png') }}" class="card-img" alt="Employee Picture">
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h2 class="card-title">John Doe</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida.</p>
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
    <div class="card py-4">
        <h2 class="card-header">Gobrieno</h2>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Cargo</th>
          <th>Telephone</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td><img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar" width="40" height="40" class="rounded-circle"> <span class="fw-medium">Albert Cook</span></td>
          <td> Alcalde</td>
          <td> (308) 555-1201</td>
          <td>johndoe@gmail.com</td>
        </tr>
        <tr>
            <td><img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar"  width="40" height="40" class="rounded-circle"> <span class="fw-medium">Albert Cook</span></td>
            <td> Alcalde</td>
            <td> (308) 555-1201</td>
            <td>johndoe@gmail.com</td>
          </tr>
          <tr>
            <td><img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar"  width="40" height="40" class="rounded-circle"> <span class="fw-medium">Albert Cook</span></td>
            <td> Alcalde</td>
            <td> (308) 555-1201</td>
            <td>johndoe@gmail.com</td>
          </tr>
      </tbody>
    </table>
  </div>
  <div class="container mt-5">
        <div class="row">
            <!-- Column for Person 1 -->
            <div class="col-md-6">
                <h6 style="background-color: violet; color: white; padding: 10px; width: fit-content; border-radius: 10px;">Person 1</h6>
                <hr style="border-top: 2px solid violet; margin: 10px 0;">
                    <div class="row mb-4">
                        <div class="col-1 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" width="40" height="40" class="img-fluid rounded-circle" alt="name">
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <h5 class="mb-0">Joe Doe</h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-1 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" width="40" height="40" class="img-fluid rounded-circle" alt="name">
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <h5 class="mb-0">Joe Doe</h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-1 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" width="40" height="40" class="img-fluid rounded-circle" alt="name">
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <h5 class="mb-0">Joe Doe</h5>
                        </div>
                    </div>
            </div>

            <!-- Column for Person 2 -->
            <div class="col-md-6">
                <h6 style="background-color: red; color: white; padding: 10px; width: fit-content; border-radius: 10px;">Person 2</h6>
                <hr style="border-top: 2px solid red; margin: 10px 0;">
                    <div class="row mb-4">
                        <div class="col-1 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" width="40" height="40" class="img-fluid rounded-circle" alt="name">
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <h5 class="mb-0">Joe Doe</h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-1 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" width="40" height="40" class="img-fluid rounded-circle" alt="name">
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <h5 class="mb-0">Joe Doe</h5>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-1 d-flex justify-content-center">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" width="40" height="40" class="img-fluid rounded-circle" alt="name">
                        </div>
                        <div class="col-8 d-flex align-items-center">
                            <h5 class="mb-0">Joe Doe</h5>
                        </div>
                    </div>
            </div>
    </div>
</div>
    </div>
</div>



<div class="container mt-5">
    <div class="card py-4">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead style="background-color: rgb(1, 1, 10); color: rgb(255, 255, 255);" >
        <tr>
          <th>Name</th>
          <th>Cargo</th>
          <th>Telephone</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <tr>
          <td><span class="fw-medium">Albert Cook</span></td>
          <td> Alcalde</td>
          <td> (308) 555-1201</td>
          <td>johndoe@gmail.com</td>
        </tr>
        <tr>
            <td><span class="fw-medium">Albert Cook</span></td>
            <td> Alcalde</td>
            <td> (308) 555-1201</td>
            <td>johndoe@gmail.com</td>
          </tr>
          <tr>
            <td><span class="fw-medium">Albert Cook</span></td>
            <td> Alcalde</td>
            <td> (308) 555-1201</td>
            <td>johndoe@gmail.com</td>
          </tr>
          <tr>
            <td><span class="fw-medium">Albert Cook</span></td>
            <td> Alcalde</td>
            <td> (308) 555-1201</td>
            <td>johndoe@gmail.com</td>
          </tr>
          </tbody>
    </table>
  </div>
    </div>
</div>

<div class="container mt-5">
    <h1>Información de Interés</h1>
    <div class="card">
        <div class="row p-4 d-flex align-items-center">
            <div class="col-md-1 d-flex justify-content-center">
                <div style="border-left: 3px solid black; height: 180px; width: 4px;"></div>
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h3 class="card-title">John Doe</h3>
                    <h4 class="card-title">24-04-2020</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="row p-4 d-flex align-items-center">
            <div class="col-md-1 d-flex justify-content-center">
                <div style="border-left: 3px solid black; height: 180px; width: 4px;"></div>
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h3 class="card-title">John Doe</h3>
                    <h4 class="card-title">24-04-2020</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="row p-4 d-flex align-items-center">
            <div class="col-md-1 d-flex justify-content-center">
                <div style="border-left: 3px solid black; height: 180px; width: 4px;"></div>
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h3 class="card-title">John Doe</h3>
                    <h4 class="card-title">24-04-2020</h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Arcu ac tortor dignissim convallis aenean et tortor. Eu ultrices vitae auctor eu augue. Dis parturient montes nascetur ridiculus. Dolor sed viverra ipsum nunc aliquet bibendum enim facilisis gravida.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
