$('#cus-table').DataTable( {
   language: {
       searchPlaceholder: "Search"
   },
   aaSorting: [],
   responsive: {
     details: {
         display: $.fn.dataTable.Responsive.display.modal( {
             header: function ( row ) {
                 var data = row.data();
                 return 'Details for '+data[1];
             }
         } ),
         renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
             tableClass: 'table'
         } )
     }
   },
   fnDrawCallback: function ( oSettings ){
         if(oSettings.fnRecordsTotal() <= 5){     
             //$('.dataTables_length').hide();
             $('.dataTables_paginate').hide();
             $('.dataTables_filter').hide();
             $('.dataTables_wrapper').addClass('noFilters');
         } else {
             //$('.dataTables_length').show();
             $('.dataTables_paginate').show(); 
             $('.dataTables_filter').show();
             $('.dataTables_wrapper.noFilters').removeClass('noFilters');
         }
   },
   dom: 'Bfrtip',
   // buttons: [
   //     'copyHtml5',
   //     'excelHtml5',
   //     'csvHtml5',
   //     'pdfHtml5'
   // ],
   //"scrollX": true,
   "pageLength": 5,
   "bPaginate": true,
   "info":     false,
   "ordering": true,
   "bFilter": true 
}), $( "#cus-table_wrapper .dt-buttons" ).prepend( "<span class='export-label'>Export to</span>" ).addClass('exportBtns'), $('#cus-table_wrapper .dataTables_filter').addClass('filterSearchBox'), $("#cus-table_wrapper .dataTables_filter").after("<div class='clearfix'></div>"), $('#cus-table_wrapper .dataTables_paginate').addClass('customDatatablePagenation'), $('#cus-table_wrapper').removeClass('form-inline');