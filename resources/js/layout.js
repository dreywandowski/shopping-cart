  // send session variables via AJAX

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


// this allows us to reload the shop items based on price items selected in the dynamic slider
//var curr_amt = document.getElementById('amount');
alert("hey");
curr_amt.addEventListener('click', function () {
    console.log("heyyy" + curr_amt.value());
}, false);




// livewire js
  Livewire.on("deleteTriggered", (id, name) => {
      const proceed = confirm(`Are you sure you want to delete ${name}`);

      if (proceed) {
          Livewire.emit("delete", id);
      }
  });
