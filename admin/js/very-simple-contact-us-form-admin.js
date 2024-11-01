(function ($) {
  "use strict";
  $(function () {
    $("button#edit").on("click", function () {
      var data_id = $(this).attr("data-id");
      $.ajax({
        type: "post",
        dataType: "json",
        url: plugin_data_admin.ajax_url,
        data: {
          action: "simple_contact_us_form_edit",
          id: data_id,
          nonce: plugin_data_admin.nonce,
        },
        success: function (response) {
          $("#wpbody-content").html(response.data);
          
        },
      });
    });
    $("button#delete").on("click", function () {
      var data_id = $(this).attr("data-id");
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "post",
            dataType: "json",
            url: plugin_data_admin.ajax_url,
            data: {
              action: "simple_contact_us_form_delete",
              id: data_id,
              nonce: plugin_data_admin.nonce,
            },
            success: function (response) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              );
             location.reload();
            },
          }); 
        }
      });
    });  
  });
})(jQuery);
