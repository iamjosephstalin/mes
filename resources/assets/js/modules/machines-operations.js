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

document.addEventListener('DOMContentLoaded', function () {
// List-view screen Js 
  if(document.getElementById("machines-operations-list")){
      const tableTitle = "Machines/Operations"
      const table = new DataTable('#table-machines-operations', {
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
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
            text: '<i class="fa fa-plus"></i> Add Machines/Operations',
            className: 'btn btn-primary ms-2',
            action: function (dt, node, config) {
              window.location.href = '/machines-operations/create';
            }
          }
        ],
        columns: [
            { width: '25%' },  
            { width: '15%' },
            { width: '15%' },  
            { width: '15%' },  
            { width: '15%' },  
            { width: '15%' },  
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

        const filterRow = $('<tr class="filter-row"></tr>').insertBefore('#table-machines-operations thead tr:first');
        const filters = {};
        table.columns().every(function (index) {
            const column = this;
            if ([1, 2, 4].includes(index)) {
                // Add dropdown filter for columns 1, 2, 4
                const select = document.createElement('select');
                select.classList.add('form-select', 'form-select-sm');
                select.style.width = '100%';
                select.addEventListener('change', function () {
                    filters[index] = this.value;
                    applyFilters();
                });

                const option = document.createElement('option');
                option.value = '';
                option.text = 'All';
                select.appendChild(option);

                
                if([1,2].includes(index)){
                    const optionBooly = document.createElement('option');
                    optionBooly.value = 'Yes';
                    optionBooly.text = 'Yes';
                    select.appendChild(optionBooly);

                    const optionBooln = document.createElement('option');
                    optionBooln.value = 'No';
                    optionBooln.text = 'No';
                    select.appendChild(optionBooln);
                }else{
                    column.data().unique().sort().each(function (d, j) {
                        const option = document.createElement('option');
                        option.value = d;
                        option.text = d;
                        select.appendChild(option);
                    });
                }
                const filterCell = $('<th class="text-center"></th>').appendTo(filterRow);
                filterCell.append(select);
            } else if ([0, 3].includes(index)) {
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

$('.delete-machines-operations').one('click',async function(e){
  const isTrue = await showConfirmation('Do you want to delete this Machine/Operations?','Delete', 'Cancel');
  if(!isTrue){
    e.preventDefault(); 
    e.stopPropagation();
  }else{
    e.target.closest('form').submit();
  }
});
