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
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

pdfMake.vfs = pdfFonts.pdfMake.vfs;

document.addEventListener('DOMContentLoaded', function () {
  if (document.getElementById('role-list')) {
    const tableTitle = 'Roles List';
    const table = new DataTable('#table-role', {
      responsive: true,
      dom: '<"row py-3"<"col-md-6"><"col-md-6 d-flex align-items-center justify-content-end"B>><"row"<"col-md-6"l><"col-md-6"f>>rt<"row"<"col-md-6"i><"col-md-6"p>>',
      buttons: [
        {
          extend: 'collection',
          text: 'Export',
          className: 'btn btn-primary',
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
          text: '<i class="fa fa-plus"></i> Add Role',
          className: 'btn btn-primary ms-2',
          init: function (dt, node, config) {
            $(node).attr('data-bs-toggle', 'modal');
            $(node).attr('data-bs-target', '#role-add-modal');
          }
        }
      ],
      columns: [{ width: '40%' }, { width: '30%' }, { width: '30%' }],
      oClasses: {
        sTable: 'datatables-basic table border-top dataTable no-footer dtr-column collapsed'
      },
      initComplete: function () {}
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

$('.role-edit').on('click', function () {
  let roleId = $(this).data('id');
  axios.get(`/roles/${roleId}/edit`).then(res => {
    let { role } = res.data;
    let form = $('#role-edit-form');
    form.attr('action', form.attr('action') + '/' + roleId);
    $('#edit_role').val(role.role);
    $('#edit_user_type_id').val(role.user_type_id);
    $('#id').val(role.id);
    $('#role-edit-modal').modal('show');
  });
});

$('.role-delete').on('click', async function (e) {
  const isTrue = await showConfirmation('Do you want to delete this role?', 'Delete', 'Cancel');
  if (!isTrue) {
    e.preventDefault();
    e.stopPropagation();
  } else {
    e.target.closest('form').submit();
  }
});
