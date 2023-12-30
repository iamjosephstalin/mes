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
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';

pdfMake.vfs = pdfFonts.pdfMake.vfs

// $('#table-currency').hide();
document.addEventListener('DOMContentLoaded', function () {
// List-view screen Js 
  if(document.getElementById("currency-list")){
      const tableTitle = "Currency List"
      const table = new DataTable('#table-currency', {
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
            text: '<i class="fa fa-plus"></i> Add Currency',
            className: 'btn btn-primary ms-2 mb-2',
            init: function (dt, node, config) {
              $(node).attr('data-bs-toggle', 'modal');
              $(node).attr('data-bs-target', '#currency-create-modal');
          }
            // action: function (dt, node, config) {
            //   window.location.href = '/reg-settings/currencies/create';
            // }
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
        initComplete: function () {
          $('.dt-buttons').removeClass('btn-group').addClass('d-flex justify-content-center');
          // $('.loading-overlay').hide();
          // $('#table-currency').show()
        },

      });

      const firstColText = document.createElement('div');
      const h5Element = document.createElement('h5');
      h5Element.classList.add('card-header');
      h5Element.classList.add('p-2');
      h5Element.textContent =tableTitle; 
      firstColText.append(h5Element);
      document.querySelector('.col-md-6:first-child').appendChild(firstColText);

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

$('.currency-edit').on('click',function(){
  let currencyId = $(this).data('id');
  axios.get(`/reg-settings/currencies/${currencyId}/edit`)
  .then((res)=>{
      let {currency} = res.data;
      let form = $('#currency-edit-form');
      form.attr('action', form.attr('action') + '/' + currencyId);
      $('#currency_name_edit').val(currency.currency_name);
      $('#id').val(currency.id);
      $('#currency-edit-modal').modal('show');
  });
});

  $('.delete-currency').one('click',async function(e){
    const isTrue = await showConfirmation('Do you want to delete this currency?','Delete', 'Cancel');
    if(!isTrue){
      e.preventDefault(); 
      e.stopPropagation();
    }else{
      e.target.closest('form').submit();
    }
  });

  $('.default-currency').on('click',function(){
    let currencyId = $(this).data('id');
    axios.post(`/reg-settings/currencies/default`,
    {
      id : currencyId, 
      is_default : $(this).prop('checked') ? 1:0
    }).then((res)=>location.reload());
  });








