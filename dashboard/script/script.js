$(document).ready(function(){
    $("#searchUser").on("keyup", function(){
        let value = $(this).val().toLowerCase();
        $("#userTableBody tr").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        })
    })
})

function addUser() {
  let id = $("#studentID").val();
  let fname = $("#firstName").val();
  let lname = $("#lastName").val();
  let age = $("#age").val();
  let address = $("#address").val();

  if (id && fname && lname && age && address) {
    let newRow = $("<tr></tr>");

    newRow.append(`
            <td>${id}</td>
            <td>${fname}</td>
            <td>${lname}</td>
            <td>${age}</td>
            <td>${address}</td>
            <td>
                <button onclick="updateUser(this)" style="padding: 0 0.25rem !important; border: none; background-color:#FF964F; color: white;"><i class="fa-solid fa-pencil"></i></button>
                <button onclick="deleteUser(this)" style="padding: 0 0.25rem !important; border: none; background-color: #F74141; color: white;"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
            `);

    $("#alertMessage").css("display", "block");
    $("#alertMessage").css("border", "1px solid #77DD77");
    $("#alertMessage").css("color", "#77DD77");
    $("#alertMessage").html("User Added Successfully");

    setTimeout(function () {
      $("#alertMessage").css("display", "none");
    }, 3000);

    $("#userTableBody").append(newRow);

    id = $("#studentID").val("");
    fname = $("#firstName").val("");
    lname = $("#lastName").val("");
    age = $("#age").val("");
    address = $("#address").val("");
  } else {
    $("#alertMessage").css("display", "block");
    $("#alertMessage").css("border", "1px solid #F74141");
    $("#alertMessage").css("color", "#F74141");
    $("#alertMessage").html("Please fill in all fields");

    setTimeout(function () {
      $("#alertMessage").css("display", "none");
    }, 3000);
  }
}

function deleteUser(button) {
  if (confirm("Are you sure you want to delete this row?")) {
    $(button).closest("tr").remove();

    $("#alertMessage").css("display", "block");
    $("#alertMessage").css("border", "1px solid #F74141");
    $("#alertMessage").css("color", "#F74141");
    $("#alertMessage").html("User Deleted Successfully");

    setTimeout(function () {
      $("#alertMessage").css("display", "none");
    }, 3000);
  }
}

function updateUser(button) {
  let id = $(button).closest("tr").find("td:eq(0)").text();
  let fname = $(button).closest("tr").find("td:eq(1)").text();
  let lname = $(button).closest("tr").find("td:eq(2)").text();
  let age = $(button).closest("tr").find("td:eq(3)").text();
  let address = $(button).closest("tr").find("td:eq(4)").text();

  $("#studentID").val(id);
  $("#firstName").val(fname);
  $("#lastName").val(lname);
  $("#age").val(age);
  $("#address").val(address);

  $("#add").css("display", "none");
  $("#update").css("display", "block");
}

function updateUserDetails() {
    let id = $("#studentID").val();
    let fname = $("#firstName").val();
    let lname = $("#lastName").val();
    let age = $("#age").val();
    let address = $("#address").val();

    if (id && fname && lname && age && address) {
        let rows = $("#userTableBody tr");
        let editRow = null;
        
        rows.each(function() {
            if ($(this).find("td:eq(0)").text() === id) {
                editRow = $(this);
                return false;
            }
        });

        if (editRow) {
            editRow.find("td:eq(1)").text(fname);
            editRow.find("td:eq(2)").text(lname);
            editRow.find("td:eq(3)").text(age);
            editRow.find("td:eq(4)").text(address);

            $("#alertMessage").css("display", "block");
            $("#alertMessage").css("border", "1px solid #77DD77");
            $("#alertMessage").css("color", "#77DD77");
            $("#alertMessage").html("User Updated Successfully");

            setTimeout(function () {
                $("#alertMessage").css("display", "none");
            }, 3000);

            $("#studentID").val("");
            $("#firstName").val("");
            $("#lastName").val("");
            $("#age").val("");
            $("#address").val("");

            $("#add").css("display", "block");
            $("#update").css("display", "none");
        }
    } else {
        $("#alertMessage").css("display", "block");
        $("#alertMessage").css("border", "1px solid #F74141");
        $("#alertMessage").css("color", "#F74141");
        $("#alertMessage").html("Please fill in all fields");

        setTimeout(function () {
            $("#alertMessage").css("display", "none");
        }, 3000);
    }
}
