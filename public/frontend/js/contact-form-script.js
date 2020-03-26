$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, defaultMessage );
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Initiate Variables With Form Content

    var name = $("#name").val();
    var email = $("#email").val();
    var subject = $("#msg_subject").val();
    var message = $("#message").val();

    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/sendMessage",
        data:{
            name: name, 
            email: email, 
            subject: subject, 
            message: message
        },
        dataType: 'JSON',
        success : function(data){
            if (data.status == 'success'){
                formSuccess(data.message);
            } else {
                formError();
                submitMSG(false,data.message);
            }
        }
    });
}

function formSuccess(msg){
    $("#contactForm")[0].reset();
    submitMSG(true, msg);
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);

    setTimeout(changeText, 10000);
}

function changeText(){
    $("#msgSubmit").addClass('hidden');
}
