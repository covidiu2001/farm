$(document).on('change', '#regions', function(e){
    e.preventDefault();
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/changeRegion",
        data: {
            region_id: $(this).val()
        },
        dataType: 'JSON',
        success : function(data){
            if (data.status == 'success'){
                $('#city_dropdown').html(data.message);
            }
        }
    });    
});


$(document).on('change', '#country', function(e){
    e.preventDefault();
    $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/changeCountry",
        data: {
            country_id: $(this).val()
        },
        dataType: 'JSON',
        success : function(data){
            if (data.status == 'success'){
                $('#region_dropdown').html(data.message.html1);
                $('#city_dropdown').html(data.message.html2);
            }
        }
    });    
});