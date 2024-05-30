/**
 * Page User List
 */

'use strict';

// Datatable (jquery)
$(function () {
  // Variable declaration for table
  var dt_ticket_table = $('.datatables-tickets'),
    select2 = $('.select2'),
    ticketView = baseUrl + 'ticket/view',
    offCanvasForm = $('#offcanvasAddTicket');

  if (select2.length) {
    var $this = select2;
    $this.wrap('<div class="position-relative"></div>').select2({
      placeholder: 'Select Ticket Type',
      dropdownParent: $this.parent()
    });
  }

  // ajax setup
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  // Users datatable
  if (dt_ticket_table.length) {
    var dt_ticket = dt_ticket_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: baseUrl + 'ticket-list'
      },
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'id' },
        { data: 'title' },
        { data: 'description' },
        { data: 'ticket_type' },
        { data: 'client' },
        { data: 'assign_to' },
        { data: 'labels' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          searchable: false,
          orderable: false,
          targets: 1,
          render: function (data, type, full, meta) {
            return `<span>${full.fake_id}</span>`;
          }
        },
        // {
        //   // User full name
        //   targets: 2,
        //   responsivePriority: 4,
        //   render: function (data, type, full, meta) {
        //     var $name = full['title'];

        //     // For Avatar badge
        //     var stateNum = Math.floor(Math.random() * 6);
        //     var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
        //     var $state = states[stateNum],
        //       $name = full['title'],
        //       $initials = $name.match(/\b\w/g) || [],
        //       $output;
        //     $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
        //     $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';

        //     // Creates full output for row
        //     var $row_output =
        //       '<div class="d-flex justify-content-start align-items-center user-name">' +
        //       '<div class="avatar-wrapper">' +
        //       '<div class="avatar avatar-sm me-3">' +
        //       $output +
        //       '</div>' +
        //       '</div>' +
        //       '<div class="d-flex flex-column">' +
        //       '<a href="' +
        //       userView +
        //       '" class="text-body text-truncate"><span class="fw-medium">' +
        //       $name +
        //       '</span></a>' +
        //       '</div>' +
        //       '</div>';
        //     return $row_output;
        //   }
        // },
        {
          // Title
          targets: 2,
          render: function (data, type, full, meta) {
            var $title = full['title'];
            return '<span class="user-email">' + $title + '</span>';
          }
        },
        {
          // Ticket Description
          targets: 3,
          render: function (data, type, full, meta) {
            var $description = full['description'];

            return '<span class="user-email text-truncate">' + $description + '</span>';
          }
        },
        {
          // Ticket Description
          targets: 4,
          render: function (data, type, full, meta) {
            var $ticket_type = full['ticket_type'];
            return '<span class="user-email text-truncate">' + $ticket_type + '</span>';
          }
        },
        {
          // Ticket Client
          targets: 4,
          render: function (data, type, full, meta) {
            var $client = full['client'];

            return '<span class="user-email text-truncate">' + $client + '</span>';
          }
        },
        {
          // Ticket Description
          targets: 6,
          render: function (data, type, full, meta) {
            var $assign_to = full['assign_to'];

            return '<span class="user-email text-truncate">' + $assign_to + '</span>';
          }
        },
        {
          // Ticket Description
          targets: 6,
          render: function (data, type, full, meta) {
            var $labels = full['labels'];

            return '<span class="user-email text-truncate">' + $labels + '</span>';
          }
        },
        // {
        //   // email verify
        //   targets: 4,
        //   className: 'text-center',
        //   render: function (data, type, full, meta) {
        //     var $verified = full['email_verified_at'];
        //     return `${
        //       $verified
        //         ? '<i class="ti fs-4 ti-shield-check text-success"></i>'
        //         : '<i class="ti fs-4 ti-shield-x text-danger" ></i>'
        //     }`;
        //   }
        // },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-block text-nowrap">' +
              `<button class="btn btn-sm btn-icon edit-record" data-id="${full['id']}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddTicket"><i class="ti ti-edit"></i></button>` +
              `<button class="btn btn-sm btn-icon delete-record" data-id="${full['id']}"><i class="ti ti-trash"></i></button>` +
              '</div>'
            );
          }
        }
      ],
      order: [[2, 'desc']],
      dom:
        '<"row mx-2"' +
        '<"col-md-2"<"me-3"l>>' +
        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Search..'
      },
      // Buttons with Dropdown
      buttons: [
        {
          text: '<i class="ti ti-plus me-0  me-sm-1"></i><span class="d-none d-sm-inline-block">Add New Ticket</span>',
          className: 'add-new mx-3 btn btn-primary waves-effect waves-light',
          attr: {
            'data-bs-toggle': 'offcanvas',
            'data-bs-target': '#offcanvasAddTicket'
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
    // To remove default btn-secondary in export buttons
    $('.dt-buttons > .btn-group > button').removeClass('btn-secondary');
  }

  // Delete Record
  $(document).on('click', '.delete-record', function () {
    var ticket_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // sweetalert for confirmation of delete
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.value) {
        // delete the data
        $.ajax({
          type: 'DELETE',
          url: `${baseUrl}api/tickets/${ticket_id}`,
          success: function () {
            dt_ticket.draw();
          },
          error: function (error) {
            console.log(error);
          }
        });

        // success sweetalert
        Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'The ticket has been deleted!',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cancelled',
          text: 'The Ticket is not deleted!',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      }
    });
  });

  // edit record
  $(document).on('click', '.edit-record', function () {
    var ticket_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // changing the title of offcanvas
    $('#offcanvasAddTicketLabel').html('Edit Ticket');

    // get data
    $.get(`${baseUrl}ticket-list\/${ticket_id}\/edit`, function (data) {
      $('#ticket_id').val(data.id);
      $('#add-ticket-title').val(data.title);
      $('#add-ticket-description').val(data.description);
    });
  });

  // changing the title
  $('.add-new').on('click', function () {
    $('#ticket').val(''); //reseting input field
    $('#offcanvasAddTicketLabel').html('Add Ticket');
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

  // validating form and updating user's data
  const addNewTicketForm = document.getElementById('addNewTicketForm');

  // user form validation
  const fv = FormValidation.formValidation(addNewTicketForm, {
    fields: {
      title: {
        validators: {
          notEmpty: {
            message: 'Please enter title'
          }
        }
      },
      description: {
        validators: {
          notEmpty: {
            message: 'Please enter your description'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        // Use this for enabling/changing valid/invalid class
        eleValidClass: '',
        rowSelector: function (field, ele) {
          // field is the field name & ele is the field element
          return '.mb-3';
        }
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      // Submit the form when all fields are valid
      // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  }).on('core.form.valid', function () {
    // adding or updating user when form successfully validate
    console.log($('#addNewTicketForm').serialize());
    $.ajax({
      data: $('#addNewTicketForm').serialize(),
      url: `${baseUrl}ticket-list`,
      type: 'POST',
      success: function (status) {
        dt_ticket.draw();
        offCanvasForm.offcanvas('hide');

        // sweetalert
        Swal.fire({
          icon: 'success',
          title: `Successfully ${status}!`,
          text: `Ticket ${status} Successfully.`,
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      },
      error: function (err) {
        offCanvasForm.offcanvas('hide');
        console.log(err);
        Swal.fire({
          title: 'Duplicate Entry!',
          text: 'Your title should be unique.',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      }
    });
  });

  // clearing form data when offcanvas hidden
  offCanvasForm.on('hidden.bs.offcanvas', function () {
    fv.resetForm(true);
  });
});
