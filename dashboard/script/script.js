function addUser(){
    let id = $("#studentID").val();
    let fname = $("#firstName").val();
    let lname = $("#lastName").val();
    let age = $("#age").val();
    let address = $("#address").val();

    if(id != "" || fname != "" || lname != "" || age != "" || address != ""){
        let newRow = $("<tr></tr>")

        newRow.append(`
            <td>${id}</td>
            <td>${fname}</td>
            <td>${lname}</td>
            <td>${age}</td>
            <td>${address}</td>
            <td>
                <button style="padding: 0 0.25rem !important; border: none; background-color:#FF964F; color: white;"><i class="fa-solid fa-pencil"></i></button>
                <button style="padding: 0 0.25rem !important; border: none; background-color: #F74141; color: white;"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </td>
            `)

            $("#alertMessage").css("display", "block")
            $("#alertMessage").css("border", "1px solid #77DD77")
            $("#alertMessage").css("color", "#77DD77")
            $("#alertMessage").html("User Added Successfully")

            setTimeout(function(){
                $("#alertMessage").css("display", "none")
            }, 3000)

            $("#userTableBody").append(newRow)

            id = $("#studentID").val("");
            fname = $("#firstName").val("");
            lname = $("#lastName").val("");
            age = $("#age").val("");
            address = $("#address").val("");

            
    } else {
        $("#alertMessage").css("display", "block")
        $("#alertMessage").css("border", "1px solid #F74141")
        $("#alertMessage").css("color", "#F74141")
        $("#alertMessage").html("Please fill in all fields")

        setTimeout(function(){
            $("#alertMessage").css("display", "none")
        }, 3000)
    }
}