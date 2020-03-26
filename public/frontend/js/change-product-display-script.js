$(document).ready(function() {
    $('#order_product').on('change', function(){
        searchProducts(this.value);
//        $.ajax({
//            headers: {
//              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//            },
//            type: "POST",
//            url: "/filterProducts",
//            data:{
//                filter: this.value, 
//                cat_id: $('#cat_id').val(),
//                list_view: $('.product-item-filter li > a.active').attr('href')
//            },
//            dataType: 'JSON',
//            success : function(data){
//                if (data.status == 'success'){
//                    $('#product_display').html(data.message);
//                }
//            }
//        });
    });
    
    $('#search_products').on('click', function(){
        searchProducts();
    });
    
    $('#search-product-by-text').on("keypress", function(e) {
        if (e.keyCode == 13) {
            searchProducts();
        }
    });    
    
    $("#product-slider-range").slider({
        range: true,
        min: parseInt($('#min_price').val()),
        max: parseInt($('#max_price').val()),
        values: [$('#min_price').val(), $('#max_price').val()],
        slide: function(event, ui) {
            $("#product-amount").val(ui.values[0] + " - " + ui.values[1] + ' lei');
        }
    });
		
    $("#product-amount").val($("#product-slider-range").slider("values", 0) + " - " + $("#product-slider-range").slider("values", 1) + ' lei');    
});

function searchProducts(frontFilter){
    var searchCriteria = 'searchProduct';
    if(frontFilter !== undefined) {
        searchCriteria = frontFilter;
        if(frontFilter == 'price_none') {
            $('#search-product-by-text').val('');
        }
    }    

    console.log($('#search-product-by-text').val());
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/filterProducts",
        data:{
            filter: searchCriteria, 
            cat_id: $('#cat_id').val(),
            search: $('#search-product-by-text').val(),
            list_view: $('.product-item-filter li > a.active').attr('href')
        },
        dataType: 'JSON',
        success : function(data){
            if (data.status == 'success'){
                $('#product_display').html(data.message);
                var newCount = parseInt($('#new_item_count').text());
                $('#item_count').text($('#item_count').text().replace(/\d+/,newCount));
            }
        }
    });
};