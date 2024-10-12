<script>

    $(document).ready(function() {
        $('.favourite').click(function() {

            let articleId = $(this).data('item-id');
            let heartIcon = $('#heart-icon-' + articleId);

            $.ajax({
                url: '{{ url(route('toggle-favs')) }}', 
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    article_id: articleId
                },
                success: function(response) {
                    var cur_class = $(heartIcon).attr('class');
                    
                    if (cur_class.includes('far')) {
                        $(heartIcon).removeClass('far fa-heart').addClass('fa fa-heart');
                    } else{
                        $(heartIcon).removeClass('fa fa-heart').addClass('far fa-heart');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

</script>