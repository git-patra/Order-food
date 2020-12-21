window.$ = window.jQuery = require("jquery");
import Swal from "sweetalert2";
import DataMenus from "../data/menu";

const bearer_token = "hZv7fACL4lt8hXTU0lHdRVf7MoAkRtsIRgIRLA9A";
const bearer = `Bearer ${bearer_token}`;


const formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'IDR',
});


let i = 1;

  /*------------------------------------------------------------------
//![ Display Select Menu Item ]*/
function addItemMenu(menus, type) {
    
    $('.bodyModalOrder').append(
        `<div id='row${i}' class="form-group mb-2 row">
        <div class="col-10">
            <select class="form-select mr-sm-2" id="menu_type_id" name="menu[]">
            ${
            menus.map(data => {
                if (data.menu_type_id === type) {
                    return `<option ${(data.stock > 0) ? `` : 'disabled' } value="${data.id}">${data.name} / ${data.stock} Remain Stock</option>`;
                } else {
            }
            }).join('')}
            </select>
        </div>
        <div class="col-2">
            <button type="button" name="remove" id='${i}' class="btn btn-danger btn_remove">X</button>
        </div>
        </div>`
    );
    i++;
  };

  /*------------------------------------------------------------------
//![ Display Spinner ]*/
function spinner() {
    return $('.bodyModalOrder').append(`
    <div class="text-center loading">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    `);
}

$(document).on('click', '.btn_remove', function(){  
var button_id = $(this).attr("id");   
$('#row'+button_id+'').remove();  
});

// Triggered Button Item
$(document).on('click', '#addItemMakan', function () {
    spinner();
    DataMenus.getDataMenu()
    .then(menus => addItemMenu(menus, 1));
}); 
$(document).on('click', '#addItemMinum', function () {
    spinner();
    DataMenus.getDataMenu()
    .then(menus => addItemMenu(menus, 2));
}); 

// Post Order
$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('submit', '#formAddOrder', function (e) {
  
  e.preventDefault();

  $.ajax({
    url: "api/order",
    type: "POST",
    data: $('#formAddOrder').serialize(),
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

// Konfirm Payment

$(".btn-konfirm").on("click", function(e) {
    e.preventDefault();

    let form = $(this).parents("form");

    Swal.fire({
        title: "Have The Customer Paid?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#5F76E8",
        confirmButtonText: "Sure!"
    }).then(result => {
        if (result.value) {
            form.submit();
        }
    });
});
