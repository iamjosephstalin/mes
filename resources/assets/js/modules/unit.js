'use strict';

import DataTable from 'datatables.net-dt';
import 'datatables.net-dt/css/jquery.datatables.css';

document.addEventListener('DOMContentLoaded', function () {
  const table = new DataTable('#table-unit', {
    responsive: true,
    oClasses: {
      sTable: 'table',
      sWrapper: 'dataTables_wrapper no-footer p-4'
    }
  });
});
