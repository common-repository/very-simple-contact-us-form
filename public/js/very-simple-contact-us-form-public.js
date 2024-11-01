(function ($) {
  "use strict";
  $("#contact-us").validate({
    rules: {
      name: {
        required: true,
        minlength: 3,
      },
      email: {
        required: true,
        email: true,
      },
      subject: {
        required: true,
      },
    },
    messages: {
      name: "Please enter your name",
      email: "Please enter a valid email address",
      subject: "Message field Cannot be empty",
    },
    submitHandler: function () {
      jQuery.ajax({
        type: "post",
        dataType: "json",
        url: plugin_data.ajax_url,
        data: {
          action: "simple_contact_us_form_process",
          name: $("#name").val(),
          email: $("#email").val(),
          subject: $("#subject").val(),
          nonce: plugin_data.nonce,
        },
        beforeSend: function() { 
          $("#submit").prop('disabled', true); // disable button
        },
    
        success: function (response) {
          $("#contact-us").append("Your Data is successfully send");
          $("#submit").prop('disabled', false);
          setTimeout(() => {
            location.reload();
          }, 2500);
        },
        error: function () {
          alert("error");
        },
      });
    },
  });
})(jQuery);
