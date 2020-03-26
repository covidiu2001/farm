$(document).ready(function() {
    $(".alert-success").delay(5000).fadeOut("slow");
});

$(document).on('click', '.add_to_cart', function(e){
    e.preventDefault();
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/add_to_cart",
        data: {
            product_id: $(this).parent().find('#product_id').val(),
            quantity: $(this).parent().find('#quantity').val()
        },
        dataType: 'JSON',
        success : function(data){
            if (data.status == 'success'){
                $('#cart-items').html(data.html1);
                $('#my-cart').html(data.html2);
            }
        }
    });
});

$(document).on('click', '.remove_from_cart', function(e){
    e.preventDefault();
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/remove_from_cart",
        data: {
            product_id: $(this).find('#row_id').val()
        },
        dataType: 'JSON',
        success : function(data){
            console.log(data);
            if (data.status == 'success'){
               //window.location.reload();
               //$('#cart-items').html('');
               $('#cart-items').html(data.html1);
               $('#my-cart').html(data.html2);
            }
        }
    });
});

$(document).on('change', '.c-input-text', function(){
    var price = $(this).parent().parent().find('.price').val();
    $(this).parent().parent().find('.total-pr').html('<p>' + $(this).val() * price + ' lei</p>');
});