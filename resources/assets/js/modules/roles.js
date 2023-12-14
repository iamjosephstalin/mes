'use strict';

import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis';
import 'datatables.net-buttons/js/buttons.flash';
import 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import '../../css/datatables.bootstrap5.css';
import pdfMake from 'pdfmake/build/pdfmake';
import pdfFonts from 'pdfmake/build/vfs_fonts';

pdfMake.vfs = pdfFonts.pdfMake.vfs;

document.addEventListener('DOMContentLoaded', function () {
  const tableTitle = 'Roles List'
  const table = new DataTable('#table-roles', {
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
            className: 'dt-button dropdown-item',
          },
          {
            extend: 'copy',
            text: 'Copy',
            className: 'dt-button dropdown-item',
          },
          {
            extend: 'print',
            text: 'Print',
            className: 'dt-button dropdown-item',
          },
        ],
      },
      {
        text: 'Add Roles',
        className: 'btn btn-primary ms-2',
        action: function () {
          alert('Inside the currency js datatable config');
        }
      }
    ],
    columns: [
      { width: '50%' },  
      { width: '20%' },
      { width: '30%' },  
    ],
    oClasses: {
      sTable: 'datatables-basic table border-top dataTable no-footer dtr-column collapsed',
    },
  });
  const firstColText = document.createElement('div');
  const h5Element = document.createElement('h5');
  h5Element.classList.add('card-header');
  h5Element.classList.add('p-2');
  h5Element.textContent =tableTitle; 
  firstColText.append(h5Element);
  document.querySelector('.col-md-6:first-child').appendChild(firstColText);
});
