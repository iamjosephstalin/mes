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
import '@popperjs/core';
import '@form-validation/plugin-bootstrap';

pdfMake.vfs = pdfFonts.pdfMake.vfs;

document.addEventListener('DOMContentLoaded', function () {
  if (document.getElementById('clock-pause-history-list')) {
    const tableTitle = 'Clock Pause History';
    const table = new DataTable('#table-clock-pause-history', {
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
        }
      ],
      buttonContainer: false,
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

    const filterRow = $('<tr class="filter-row"></tr>').insertBefore(
      '.dataTables_scrollHeadInner table thead tr:first'
    );
    const filters = {};
    table.columns().every(function (index) {
      if ([0].includes(index)) {
        const select = document.createElement('select');
        select.className = 'form-select form-select-sm';
        const sel = document.createElement('option');
        sel.value = '';
        sel.text = 'Select worker';
        select.appendChild(sel);
        users.forEach(user => {
          const option = document.createElement('option');
          option.value = user.name;
          option.text = user.name;
          select.appendChild(option);
        });
        select.addEventListener('change', function () {
          filters[index] = this.value;
          applyFilters();
        });
        const filterCell = $('<th class="text-center"></th>').appendTo(filterRow);
        filterCell.append(select);
      } else if ([4, 5].includes(index)) {
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
      } else if ([1, 2].includes(index)) {
        const input = document.createElement('input');
        input.type = 'date';
        input.placeholder = 'Select date';
        input.className = 'form-control form-control-sm';
        input.addEventListener('change', function () {
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
      table.columns().search('').draw();
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
});
