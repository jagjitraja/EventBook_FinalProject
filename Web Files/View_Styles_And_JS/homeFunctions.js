var submitMode = 1;

function hideModal() {
    $("#modalForm").trigger('reset');
    $("#blanket").hide("slow");
    $("#modalDiv").hide("slow");
}

function showModal(e) {
    var modalHeaderValue = "";
    switch (e) {
        case "signInAnchor":
            modalHeaderValue = "Sign In";
            $("#userNameRow").hide();
            $("#phoneRow").hide();
            $("#submitButton").html("SignIn");
            $("#inputPassword").prop('required', true);
            $("#inputEmail").prop('required', true);
            submitMode = 1;
            break;

        case "registerAnchor":
            modalHeaderValue = "Register"
            $("#userNameRow").show();
            $("#phoneRow").show();
            $("#submitButton").html("Register");
            $("#inputEmail").prop('required', true);
            $("#inputPhoneNumber").prop('required', true);
            $("#inputPassword").prop('required', true);
            $("#inputUserName").prop('required', true);
            submitMode = 2;
            break;

        default:
            hideModal();
    }
    $("#modalHeader").html(modalHeaderValue);
    $("#modalDiv").toggle("slow");
    $("#blanket").toggle("slow");
}

$("#modalForm").on('submit', function () {

    switch (submitMode) {
        case 1:
            $("#commandInput").val("SIGNIN");
            $("#modalForm").submit();
            checkFormValues();
            break;
        case 2:
            $("#commandInput").val("REGISTER");
            $("#modalForm").submit();
            break;
        default:
            alert("SSSS");
            break;
    }
});