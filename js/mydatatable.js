
 if ( $.fn.dataTable.isDataTable( '#Datatable' ) ) {
  $('#Datatable').DataTable({
    "language": {
      "search": "ค้นหา",
       "info": "แสดงหน้าที่ _START_ จำนวน _END_ แถว ",
       "lengthMenu":     "แสดง _MENU_ รายการ",
       "zeroRecords":    "ไม่พบข้อมูล",
       "paginate": {
          "first":      "หน้าแรก",
          "last":       "หน้าสุดท้าย",
          "next":       "หน้าถัดไป",
          "previous":   "ย้อนกลับ"
      },
  
    },
    "ordering": false,
    
  
  } );
}
else {
  table = $('#Datatable').DataTable( {
      paging: false
  } );
}
 

