/** send cart items by AJAX**/
var count = 0;
      $('.buy-now').on('click', function(event){
          event.preventDefault();
          var name = $('#itemName').text();
          var priceInit = $('#itemPrice').text();
          var priceFin = priceInit.match(/\d+$/)[0];
          var type = $('#itemType').text();
          var number = $('#itemNumber').val();
          var price = number * priceFin;
          var file = $('#itemFile').attr('src');
          var data = new Array();
          data.push(name);
          data.push(price);
          data.push(type);
          data.push(number);
          data.push(file);
          data.push(priceFin);
          //alert(name + ' '+ price + ' '+ type + ' '+ number + ' '+ file);

          count++;
          //$('#count').html(count);
            //alert(count);
            data.push(count);
            //alert('array items: '+ data);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();

        var ajaxurl = '/shopping-cart/shop-single/'+name+'?';//alert(ajaxurl);
        $.ajax({
            type: 'get',
            data: {
              name: data[0],
              price: data[1],
              type: data[2],
              number: data[3],
              file: data[4],
              count: data[6],
              priceFin: data[5]
            },
            url: ajaxurl,

            success: function (data) {
                $('#ajaxRep').text(data);
                //$('#count').html(count)
                console.log(data);
            },
            error: function (data) {
                $('#ajaxRep').text(data);
                console.log(data.status);
            }
        });
    });



  /** calculate total price in cart  **/
  var sum = [];   //alert($('.price').text());
//var totPrice = $('.price').text();
$( ".price" ).each(function( index ) {
  var arra = $( this ).text().replace(/\D/g,'');
 // console.log('d' + arra);
  sum.push(arra);

  //console.log( index + ": " + $( this ).text());
});


const arr = sum;
const countNumers = (arr = []) => {
   let sum = 0;
   for(let i = 0; i < arr.length; i++){
      const el = arr[i]; if(+el){
         sum += +el;
      };
   };
   return sum;
}
console.log(countNumers(arr));


// find a way to get dynamic coupon value to be seen in the js file and removed from the final price computation


$('.finPrice').text('NGN '+countNumers(arr));
$('#amt').val(countNumers(arr));

function findCoupon(){
    var value = $('#coupon').find('[name=coupon]').val();
    //alert("value" + value);
}
findCoupon();

// this allows us to reload the shop items based on price items selected in the dynamic slider
/*$('#slider-range').slider({
    change: function(event, ui){
        alert("heyyyy"+ui.value);
    }
})*/


/** initiate payment via Flutterwave


const API_publicKey = "FLWPUBK-902adba8d930e1d4748fd2554dec604b-X";
var pay = document.getElementById("pay");
//pay.addEventListener("click", payWithRave, false);

$('#pay').on('click', function(event){
    event.preventDefault();


    var items = new Array();
    $('.hide').each(function(){
        items.push(this.value);
    });

alert(items);
    var priceFin = document.getElementsByClassName('finPrice')[0].innerHTML;
    var amount = priceFin.match(/\d+$/)[0];
    var user = document.getElementById("name").value;

    var number = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
 alert(email + ''+ amount + ''+ number+''+user);
    function getRandomString(length) {
        //alert('hello');
        var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var result = '';
        for ( var i = 0; i < length; i++ ) {
            result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
        }
        return result;
    }
    var ref = getRandomString(13);
    var x = getpaidSetup({
        PBFPubKey: API_publicKey,
        customer_email: email,
        amount:amount,
        customer_phone: number,
        currency: "NGN",
        txref: getRandomString(13),
        meta: [{
            metaname: "flightID",
            metavalue: "AP1234"
        }],
        onclose: function() {},
        callback: function(response) {
            var txref = response.tx.txRef;
            var code = response.tx.chargeResponseCode;
            var msg = response.data.respmsg;
            var amtt = response.tx.charged_amount;
            var status = response.tx.status;
            // collect txRef returned and pass to a                    server page to complete status check.
            console.log("This is the response returned after a charge", response);
            if ((code = "00") && (amtt == amount)){
                // window.location = "handle_bills.php";
                console.log("Input amount " + amount +  "Proccessed amount" + amtt + txref);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf_token"]').attr('content')
                    }
                });

                var ajaxurl = '/shopping-cart/handle_bills';

                $.ajax({
                    type: 'POST',
                    data: {

                        '_token': '{{csrf_token()}}',
                        amount: amtt,
                        msg: msg,
                        status: status,
                        ref: txref,
                        user: user,
                        items: items
                    },
                    url: ajaxurl,



                    success: function (data) {
                        $('#ajaxRep').text(data);
                        //$('#count').html(count)
                        console.log(data);
                    },
                    error: function (data) {
                        $('#ajaxRep').text(data.status);
                        console.log(data.status);
                    }
                });

                alert("Thanks for your payment. Check your email for confirmation");

            }
            else {
                // redirect to a failure page.
            }
            x.close(); // use this to close the modal immediately after payment.
        }
    });
}
);




/** initiate payment via Paystack
$('#paystack').on('click', function(event){
    event.preventDefault();

    var priceFin = document.getElementsByClassName('finPrice')[0].innerHTML;
    var amount = priceFin.match(/\d+$/)[0];
    var name = document.getElementById("name").value;

    var email = document.getElementById("email").value;
 alert(email + ''+ amount + ''+''+name);
$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

   var ajaxurl = '/shopping-cart/paystack';
                $.ajax({
                    type: 'post',
                    data: {
                        amount: amount,
                        email : email,
                        name: name,

                    },
                    url: ajaxurl,

                    success: function (data) {
                        $('#ajaxRep').text(status);
                        //$('#count').html(count)
                        console.log(data);
                    },
                    error: function (data) {
                        $('#ajaxRep').text(status);
                        console.log(data.status);
                    }
                });

});
**/
