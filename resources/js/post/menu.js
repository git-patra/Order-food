window.$ = window.jQuery = require("jquery");
import Swal from "sweetalert2";

const bearer_token = "hZv7fACL4lt8hXTU0lHdRVf7MoAkRtsIRgIRLA9A";
const bearer = `Bearer ${bearer_token}`;

fetch("http://localhost:8000/api/menu", {
  method: "GET",
  headers: {
    'Authorization': bearer,
  }
})
 .then(response => {
   return response.json();
 })
 .then(responseJson => {
   return responseJson.menu;
 })
 .catch(error => {
   console.log(error);
 })

 
// Add Menu
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('submit', '#formAddMenu', function (e) {
  
  e.preventDefault();

  $.ajax({
    url: "api/menu",
    type: "POST",
    data: $('#formAddMenu').serialize(),
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
