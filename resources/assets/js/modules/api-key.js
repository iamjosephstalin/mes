'use strict';

import { showConfirmation } from './common-function';
import DataTable from 'datatables.net-bs5';
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
  if (document.getElementById('api-key-list')) {
    const tableTitle = 'API Keys List';
    const table = new DataTable('#table-api-key', {
      responsive: true,
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
          text: '<i class="fa fa-plus"></i> Add API Key',
          className: 'btn btn-primary ms-2 mb-2',
          action: function () {
            window.location.href = '/api-keys/create';
          }
        }
      ],
      columns: [
        { width: '30%' },
        { width: '10%' },
        { width: '10%' },
        { width: '10%' },
        { width: '10%' },
        { width: '10%' },
        { width: '20%' }
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
});

$('.api-key-delete').on('click', async function (e) {
  const isTrue = await showConfirmation('Do you want to delete this API Key?', 'Delete', 'Cancel');
  if (!isTrue) {
    e.preventDefault();
    e.stopPropagation();
  } else {
    e.target.closest('form').submit();
  }
});
