
window.$ = window.jQuery = require("jquery");
import Swal from "sweetalert2";

const bearer_token = "hZv7fACL4lt8hXTU0lHdRVf7MoAkRtsIRgIRLA9A";
const bearer = `Bearer ${bearer_token}`;

// Add Table
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('submit', '#formAddTable', function (e) {
  
  e.preventDefault();
  
  $.ajax({
    url: "api/table",
    type: "POST",
    data: $('#formAddTable').serialize(),
    beforeSend: function (xhr) {
        xhr.setRequestHeader('Authorization', bearer);
    },
    success: function (response) {
    Swal.fire({
        text: "Successfully Added!",
        icon: "success"
    });
      location.reload();
    },
    error: function (error) {
      console.log(error);
    }
  })
});
