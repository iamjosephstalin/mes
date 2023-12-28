'use strict';

import {showConfirmation} from './common-function';
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

pdfMake.vfs = pdfFonts.pdfMake.vfs

// $('#table-currency').hide();
document.addEventListener('DOMContentLoaded', function () {
// List-view screen Js 
  if(document.getElementById("clock-history-list")){
      const tableTitle = "Clock history"
      const table = new DataTable('#table-clock-history', {
        responsive: true,
        scrollX:true,
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
            text: '<i class="fa fa-plus"></i> Show pauses',
            className: 'btn btn-primary ms-2',
          },
          {
            text: '<i class="fa fa-plus"></i> Add Clock-IN/OUT',
            className: 'btn btn-primary ms-2',
            init: function (dt, node, config) {
              $(node).attr('data-bs-toggle', 'modal');
              $(node).attr('data-bs-target', '#clock-history-create-modal');
          }
          }
        ],
        oClasses: {
          sTable: 'datatables-basic table border-top dataTable no-footer dtr-column collapsed',
        },
        initComplete: function () {
          // $('.loading-overlay').hide();
          // $('#table-additional-fields').show()
        },

      });

      const firstColText = document.createElement('div');
      const h5Element = document.createElement('h5');
      h5Element.classList.add('card-header');
      h5Element.classList.add('p-2');
      h5Element.textContent =tableTitle; 
      firstColText.append(h5Element);
      document.querySelector('.col-md-6:first-child').appendChild(firstColText);

      const filterRow = $('<tr class="filter-row"></tr>').insertBefore('.dataTables_scrollHeadInner table thead tr:first');
      const filters = {};
      table.columns().every(function (index) {
          const column = this;
          if ([0,1,2].includes(index)) {
              const input = document.createElement('input');
              input.type = 'text';
              input.placeholder = 'Search';
              input.className = 'form-control form-control-sm';
              input.addEventListener('keyup', function () {
                  filters[index] = this.value;
                  applyFilters();
              });
  
              const filterCell = $('<th class="text-center"></th>').appendTo(filterRow);
              filterCell.append(input);
          } else {
              $('<th class="text-center"></th>').appendTo(filterRow);
          }
      });
      
      function applyFilters() {
        table.columns().search('').draw(); // Clear existing search
        table.columns().every(function (index) {
          const columnData = this.column(index).data().toArray();
          if (filters[index] !== undefined && filters[index] !== '') {
            const filterValue = filters[index];
            this.search(filterValue);
          }
        });
        table.draw();
      }

    }

   

     //for bootstrap validation
     var forms = document.querySelectorAll('.needs-validation')
     Array.prototype.slice.call(forms)
       .forEach(function (form) {
         form.addEventListener('submit', function (event) {
           if (!form.checkValidity()) {
             event.preventDefault()
             event.stopPropagation()
           }
           form.classList.add('was-validated')
         }, false)
     })
});










