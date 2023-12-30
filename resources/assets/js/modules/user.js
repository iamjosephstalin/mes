'use strict';

import { showConfirmation } from './common-function';
import DataTable from 'datatables.net-bs5';
import axios from 'axios';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis';
import 'datatables.net-buttons/js/buttons.flash';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import '../../css/datatables.bootstrap5.css';
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';
import '@popperjs/core';
import '@form-validation/plugin-bootstrap';
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';

pdfMake.vfs = pdfFonts.pdfMake.vfs;

document.addEventListener('DOMContentLoaded', function () {
  if (document.getElementById('user-list')) {
    const tableTitle = 'Users List';
    const table = new DataTable('#table-user', {
      responsive: true,
      scrollX: true,
      dom: '<"row py-3"<"col-md-6"><"col-md-6 d-flex align-items-center justify-content-end"B>><"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
      buttons: [
        {
          extend: 'collection',
          text: 'Export',
          className: 'btn btn-primary mb-2',
          buttons: [
            {
              extend: 'pdf',
              text: 'PDF',
              className: 'dt-button dropdown-item'
            },
            {
              extend: 'copy',
              text: 'Copy',
              className: 'dt-button dropdown-item'
            },
            {
              extend: 'print',
              text: 'Print',
              className: 'dt-button dropdown-item'
            }
          ]
        },
        {
          text: 'Add User',
          className: 'btn btn-primary ms-2 mb-2',
          init: function (dt, node, config) {
            $(node).attr('data-bs-toggle', 'modal');
            $(node).attr('data-bs-target', '#user-add-modal');
          }
        }
      ],
      columns: [
        { width: '10%' },
        { width: '20%' },
        { width: '10%' },
        { width: '10%' },
        { width: '10%' },
        { width: '10%' },
        { width: '10%' },
        { width: '10%' }
      ],
      oClasses: {
        sTable: 'datatables-basic table border-top dataTable no-footer dtr-column collapsed'
      },
      initComplete: function () {
        $('.dt-buttons').removeClass('btn-group').addClass('d-flex justify-content-center');
      }
    });

    const firstColText = document.createElement('div');
    const h5Element = document.createElement('h5');
    h5Element.classList.add('card-header');
    h5Element.classList.add('p-2');
    h5Element.textContent = tableTitle;
    firstColText.append(h5Element);
    document.querySelector('.col-md-6:first-child').appendChild(firstColText);
  }

  var forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      },
      false
    );
  });
});

$('.user-edit').on('click', function () {
  let userId = $(this).data('id');
  axios.get(`/users/${userId}/edit`).then(res => {
    let { user } = res.data;
    let form = $('#user-edit-form');
    form.attr('action', form.attr('action') + '/' + userId);
    $('#edit_image_path').val(user.image_path);
    $('#edit_name').val(user.name);
    $('#edit_role_id').val(user.role_id);
    $('#edit_email').val(user.email);
    $('#edit_mobile').val(user.mobile);
    $('#edit_status').val(user.status);
    $('#edit_password').val(user.password);
    $('#edit_default_language_id').val(user.default_language_id);
    $('#id').val(user.id);
    if (user.image_path) {
      $('#profile_preview_edit').attr('src', baseUrl + '/storage/' + user.image_path);
    }
    $('#user-edit-modal').modal('show');
  });
});

$('.user-delete').on('click', async function (e) {
  const isTrue = await showConfirmation('Do you want to delete this user?', 'Delete', 'Cancel');
  if (!isTrue) {
    e.preventDefault();
    e.stopPropagation();
  } else {
    e.target.closest('form').submit();
  }
});

$('#profile').on('change', function () {
  var file = this.files[0];
  if (file) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#profile_preview').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  }
});

$('#profile_edit').on('change', function () {
  var file = this.files[0];
  if (file) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#profile_preview_edit').attr('src', e.target.result);
    };
    reader.readAsDataURL(file);
  }
});
