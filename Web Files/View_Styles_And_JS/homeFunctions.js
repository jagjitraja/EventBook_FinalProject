var submitMode = 1;

function hideModal() {
    $("#modalForm").trigger('reset');
    $("#blanket").hide("slow");
    $("#modalDiv").hide("slow");
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