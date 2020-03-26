$("#orderForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false);
    } else {
        // everything looks good!
        event.preventDefault();
        this.submit();
    }
});

function formSuccess(msg){
    $("#orderForm")[0].reset();
    submitMSG(true);
}

function formError(){
    $("#orderForm").addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass('shake animated');
    });
}

function submitMSG(valid){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger form-group col-md-11";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses);
}