import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

/**
 * Page User List
 */

('use strict');

// Datatable (jquery)
$(function () {
  let editorInstance;

  ClassicEditor.create(document.querySelector('#add-article-content'), {})
    .then(editor => {
      editorInstance = editor;
      //   editor.setData(data.content);
    })
    .catch(error => {
      console.error(error);
    });

  // Variable declaration for table
  var dt_article_table = $('.datatables-articles'),
    select2 = $('.select2'),
    ticketView = baseUrl + 'articles/details',
    offCanvasForm = $('#offcanvasAddArticle');

  if (select2.length) {
    var $this = select2;
    $this.wrap('<div class="position-relative"></div>').select2({
      placeholder: 'Select Active',
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
  if (dt_article_table.length) {
    var dt_article = dt_article_table.DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: baseUrl + 'article-list'
      },
      columns: [
        // columns according to JSON
        { data: '' },
        { data: 'id' },
        { data: 'title' },
        { data: 'content' },
        { data: 'category' },
        { data: 'is_active' },
        { data: 'created_at' },
        { data: 'updated_at' },
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
            var $content = full['content'];

            // Split the content into words
            var words = $content.split(' ');

            // Check if the content has more than 5 words
            if (words.length > 2) {
              // Take the first 5 words and join them back into a string
              var truncatedContent = words.slice(0, 2).join(' ') + '...';
            } else {
              // If the content has 5 or fewer words, display it as is
              var truncatedContent = $content;
            }

            return '<span class="user-email text-truncate">' + truncatedContent + '</span>';
          }
        },

        {
          // Ticket Description
          targets: 4,
          render: function (data, type, full, meta) {
            var $category = full['category'];
            return '<span class="user-email text-truncate">' + $category + '</span>';
          }
        },

        {
          // Ticket Description
          targets: 5,
          render: function (data, type, full, meta) {
            var is_active = full['is_active'];
            var badgeClass = is_active == 1 ? 'badge bg-success' : 'badge bg-danger';
            var badgeText = is_active == 1 ? 'Yes' : 'No';

            return '<span class="' + badgeClass + '">' + badgeText + '</span>';
          }
        },
        {
          // Ticket Description
          targets: 6,
          render: function (data, type, full, meta) {
            var created_at = new Date(full['created_at']);
            var day = String(created_at.getDate()).padStart(2, '0');
            var month = String(created_at.getMonth() + 1).padStart(2, '0');
            var year = created_at.getFullYear();
            var formattedDate = day + '-' + month + '-' + year;

            return '<span class="user-email text-truncate">' + formattedDate + '</span>';
          }
        },
        {
          // Ticket Description
          targets: 7,
          render: function (data, type, full, meta) {
            var updated_at = new Date(full['updated_at']);
            var day = String(updated_at.getDate()).padStart(2, '0');
            var month = String(updated_at.getMonth() + 1).padStart(2, '0');
            var year = updated_at.getFullYear();
            var formattedDate = day + '-' + month + '-' + year;
            return '<span class="user-email text-truncate">' + formattedDate + '</span>';
          }
        },

        {
          // Actions
          targets: -1,
          title: 'Actions',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
            return (
              '<div class="d-inline-block text-nowrap">' +
              `<button class="btn btn-sm btn-icon edit-record" data-id="${full['id']}" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddArticle"><i class="ti ti-edit"></i></button>` +
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
          text: '<i class="ti ti-plus me-0  me-sm-1"></i><span class="d-none d-sm-inline-block">Add New Article</span>',
          className: 'add-new mx-3 btn btn-primary waves-effect waves-light',
          attr: {
            'data-bs-toggle': 'offcanvas',
            'data-bs-target': '#offcanvasAddArticle'
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
    var article_id = $(this).data('id'),
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
        console.log(article_id);
        $.ajax({
          type: 'DELETE',
          url: `${baseUrl}api/articles/${article_id}`,
          success: function () {
            dt_article.draw();
          },
          error: function (error) {
            console.log(error);
          }
        });

        // success sweetalert
        Swal.fire({
          icon: 'success',
          title: 'Deleted!',
          text: 'The article has been deleted!',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          title: 'Cancelled',
          text: 'The Article is not deleted!',
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
    var article_id = $(this).data('id'),
      dtrModal = $('.dtr-bs-modal.show');

    // hide responsive modal in small screen
    if (dtrModal.length) {
      dtrModal.modal('hide');
    }

    // changing the title of offcanvas
    $('#offcanvasAddArticleLabel').html('Edit Article');

    // get data
    $.get(`${baseUrl}article-list\/${article_id}\/edit`, function (data) {
      console.log(data);
      $('#article_id').val(data.id);
      $('#add-article-title').val(data.title);
      $('#add-article-category').val(data.category);
      $('#is_active').val(data.is_active);
      editorInstance.setData(data.content); // Set CKEditor content
    });
  });

  // changing the title
  $('.add-new').on('click', function () {
    $('#article').val(''); //reseting input field
    $('#offcanvasAddArticleLabel').html('Add Article');
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);

  // validating form and updating user's data
  const addNewArticleForm = document.getElementById('addNewArticleForm');

  // user form validation
  const fv = FormValidation.formValidation(addNewArticleForm, {
    fields: {
      title: {
        validators: {
          notEmpty: {
            message: 'Please enter title'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: '',
        rowSelector: function (field, ele) {
          return '.mb-3';
        }
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  }).on('core.form.valid', function () {
    console.log($('#addNewArticleForm').serialize());
    console.log(editorInstance.getData());
    const formData = new FormData(addNewArticleForm);
    formData.append('content', editorInstance.getData());
    const formDataSerialized = new URLSearchParams(formData).toString();
    console.log(formDataSerialized);
    $.ajax({
      data: formDataSerialized,
      url: `${baseUrl}article-list`,
      type: 'POST',
      success: function (status) {
        dt_article.draw();
        offCanvasForm.offcanvas('hide');

        // sweetalert
        Swal.fire({
          icon: 'success',
          title: `Successfully ${status}!`,
          text: `Article ${status} Successfully.`,
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
