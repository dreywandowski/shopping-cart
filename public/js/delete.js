
/** delete a cart item via AJAX

 $('.remove').on('click', function(event){
          event.preventDefault();
     var name = $( this ).val();
     console.log(name);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();

        var ajaxurl = '/shopping-cart/cart';
        $.ajax({
            type: 'get',
            data: {
              name: name
            },
            url: ajaxurl,

            success: function (data) {
                $('#ajax').text(data);
                //$('#count').html(count)
                console.log(data);
            },
            error: function (data) {
                $('#ajax').text(data);
                console.log(data.status);
            }
        });
    });
 **/
