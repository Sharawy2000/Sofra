<script>
$("#governorates").change(function(e){

    e.preventDefault();
    governorate_id=$(this).val();

    if(governorate_id){
        $.ajax({
            url: "http://bloodbank.test/cities/"+governorate_id, 
            type: 'get',
           
            success: function(response) {
                if(response.status==200){

                    $('#cities').empty();
                    $('#cities').append('<option selected disabled hidden value="">اختر المدينة</option>');
                    $.each(response.data, function(key, city) {
                        $('#cities').append('<option value="'+ city.id +'">'+ city.name +'</option>');
                    });
                }else{
                    alert('Error in ajax govs cities request')
                }

            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });

    }else{

        $('#cities').empty();
        $('#cities').append('<option selected disabled hidden value="">اختر المدينة</option>');

    }

});

</script>