// $(function () {
//     $("#example1").DataTable({
//       "responsive": true, "lengthChange": false, "autoWidth": false,
//       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
//     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//     $('#example2').DataTable({
//       "paging": true,
//       "lengthChange": false,
//       "searching": false,
//       "ordering": true,
//       "info": true,
//       "autoWidth": false,
//       "responsive": true,
//     });
//   });
  
  function toast(result, message) {
    if (result == 'success') {
      toastr.success("   ", message);
    } else {
      toastr.error("   ", message);
    }
  }
  
  $(document).on('click', '.btn-remove', function () {
    if (confirm('Are you sure to delete this data?')) {
      return true;
    } else {
      return false;
    }
  });
  
  //add
  $(document).on("click", "#add", function () {
    var form = $(".repeat").clone().removeClass('repeat').css("display", "block");
    $("#add").before(form);
  });
  
  //remove
  $(document).on("click", "#remove", function () {
    var dis = $(this);
    dis.closest('.feature-group').remove();
    dis.closest('.image-group').remove();
    dis.closest('.image-group').remove();
    return false;
  });

  //image read url
  function readURL(input, id) {
    var url = input.value;
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "svg")) {
        var reader = new FileReader();

        reader.onload = function (e) {                    
            $("#"+id).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }else{
        $("#"+id).attr('src', 'uploads/images/noImage.png');
    }
}
  
  //dynamic active side menu
//   var url = window.location;
  
//   // for sidebar menu entirely but not cover treeview
//   $('ul.nav-sidebar a').filter(function () {
//     return this.href == url;
//   }).addClass('active');
  
//   // for treeview
//   $('ul.nav-treeview a').filter(function () {
//     return this.href == url;
//   }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');