$(document).ready(function () {
    $(".submenu > a").click(function (e) {
        e.preventDefault();
        var $li = $(this).parent("li");
        var $ul = $(this).next("ul");

        if ($li.hasClass("open")) {
            $ul.slideUp(350);
            $li.removeClass("open");
        } else {
            $(".nav > li > ul").slideUp(350);
            $(".nav > li").removeClass("open");
            $ul.slideDown(350);
            $li.addClass("open");
        }
    });

    /* change slider checkbox value on click */
    $("#category").change(function () {
        if (this.checked) {
            $('#category').attr('value', 1);
        } else {
            $('#category').attr('value', 0);
        }
        checkCategoryStatus();
    });
    
    //notification-content
    $("#notification-content").delay(5000).fadeOut("slow");

    $(document).on('click', '.close', function(){
        var response = confirm("Esti sigur ca vrei sa stergi imaginea?");
        if (response == true) {
            $.ajax({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/remove_image_backend",
                data: {
                    name: $(this).attr('id'),
                    image_id: $(this).siblings('#image_id').val(),
                    product_id: $(this).siblings('#product_id').val(),
                },
                dataType: 'JSON',
                success : function(data){
                    if (data.status == 'success'){
                       $('#product_images').html('');
                       $('#product_images').html(data.message);
                    }
                }
            }); 
        }       
    });
});

function checkCategoryStatus() {
    $('#category_status').html('Active');
    if($("#category:checked").length == 0) {
        $('#category_status').html('Inactive');
    }
}
