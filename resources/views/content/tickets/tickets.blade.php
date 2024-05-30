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
@vite(['resources/js/ticket-management.js'])
@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <h5 class="card-title mb-0">Search Filter</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="datatables-tickets table">
      <thead class="border-top">
        <tr>
          <th></th>
          <th>Id</th>
          <th>Title</th>
          <th>Description</th>
          <th>Ticket Type</th>
          <th>Client</th>
          <th>Assigned To</th>
          <th>Label</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- Offcanvas to add new ticket -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddTicket" aria-labelledby="offcanvasAddTicketLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasAddTicketLabel" class="offcanvas-title">Add Ticket</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
      <form class="add-new-ticket pt-0" id="addNewTicketForm">
        <input type="hidden" name="id" id="ticket_id">
        <div class="mb-3">
          <label class="form-label" for="add-ticket-title">Title</label>
          <input type="text" class="form-control" id="add-ticket-title" placeholder="Enter Ticket Title" name="title" aria-label="Ticket Title" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-ticket-description">Description</label>
          <textarea type="text" id="add-ticket-description" class="form-control" placeholder="Enter Ticket Description" aria-label="Ticket Description" name="description" ></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-ticket-client">Client</label>
          <input type="text" id="add-ticket-client" class="form-control" placeholder="Enter Client Name" aria-label="Client Name" name="client" />
        </div>
        <div class="mb-3">
          <label class="form-label" for="add-ticket-assigned-to">Assigned To</label>
          <input type="text" id="add-ticket-assigned-to" name="assign_to" class="form-control" placeholder="Assigned To" aria-label="Assigned To" />
        </div>
      <div class="mb-3">
          <label class="form-label" for="ticket_type">Ticket Type</label>
          <select id="ticket_type" class="select2 form-select" name="ticket_type">
            <option value="">Select</option>
            <option value="Internal">Internal</option>
            <option value="External">External</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="labels">Labels</label>
          <select id="labels" class="form-select" name="labels">
            <option value="Business">Business</option>
            <option value="Fix">Fix</option>
            <option value="Maintanence">Maintenance</option>
            <option value="Performance">Performance</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
      </form>
    </div>
  </div>
</div>
@endsection
