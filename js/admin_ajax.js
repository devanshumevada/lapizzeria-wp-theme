$ = jQuery.noConflict();

$(document).ready(function() {




   $('.remove_reservation').on('click', function(e) {
       e.preventDefault();
      var id = $(this).attr('data-reservation');

       swal({
           title: 'Are you sure?',
           text: "You won't be able to revert this!",
           type: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'Yes, delete it!',
           cancelButtonText: 'No, cancel!',
           confirmButtonClass: 'btn btn-success',
           cancelButtonClass: 'btn btn-danger',
           buttonsStyling: false,
           reverseButtons: true
       }).then((result) => {
           if (result.value) {


           $.ajax({
               type: 'post',
               data:  {
                   'action': 'lapizzeria_delete_reservation',
                   'id': id,
                   'type': 'delete'
               },

               url: admin_ajax.ajaxurl,
               success: function (data) {
                   var result = JSON.parse(data);
                   if(result.response == 1) {
                       jQuery("[data-reservation='"+ result.id +"']").parent().parent().remove();
                       swal(
                           'Reservation Deleted',
                           'The Reservation has been deleted!',
                           'success'
                       )
                   }
               }


           })

       }  else if (result.dismiss === 'cancel') {
           swal(
               'Cancelled',
               'Task cancelled',
               'error'
           )
       }
   })




   });
});