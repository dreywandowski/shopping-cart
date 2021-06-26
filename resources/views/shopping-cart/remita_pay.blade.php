<?php //echo "rrr===".session('remita_code');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title> Remita - Inline Sample</title>
    <style type="text/css">
        .form-style-1 {
            margin: 10px auto;
            max-width: 400px;
            padding: 20px 12px 10px 20px;
            font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
        }
        .form-style-1 li {
            padding: 0;
            display: block;
            list-style: none;
            margin: 10px 0 0 0;
        }
        .form-style-1 label {
            margin: 0 0 3px 0;
            padding: 0px;
            display: block;
            font-weight: bold;
        }
        .form-style-1 input[type=text],
        .form-style-1 input[type=date],
        .form-style-1 input[type=datetime],
        .form-style-1 input[type=number],
        .form-style-1 input[type=search],
        .form-style-1 input[type=time],
        .form-style-1 input[type=url],
        .form-style-1 input[type=email],
        textarea,
        select {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            border: 1px solid #BEBEBE;
            padding: 7px;
            margin: 0px;
            -webkit-transition: all 0.30s ease-in-out;
            -moz-transition: all 0.30s ease-in-out;
            -ms-transition: all 0.30s ease-in-out;
            -o-transition: all 0.30s ease-in-out;
            outline: none;
        }
        .form-style-1 input[type=text]:focus,
        .form-style-1 input[type=date]:focus,
        .form-style-1 input[type=datetime]:focus,
        .form-style-1 input[type=number]:focus,
        .form-style-1 input[type=search]:focus,
        .form-style-1 input[type=time]:focus,
        .form-style-1 input[type=url]:focus,
        .form-style-1 input[type=email]:focus,
        .form-style-1 textarea:focus,
        .form-style-1 select:focus {
            -moz-box-shadow: 0 0 8px #88D5E9;
            -webkit-box-shadow: 0 0 8px #88D5E9;
            box-shadow: 0 0 8px #88D5E9;
            border: 1px solid #88D5E9;
        }
        .form-style-1 .field-divided {
            width: 49%;
        }
        .form-style-1 .field-long {
            width: 100%;
        }
        .form-style-1 .field-select {
            width: 100%;
        }
        .form-style-1 .field-textarea {
            height: 100px;
        }
        .form-style-1 input[type=submit], .form-style-1 input[type=button] {
            background: #f44336;
            padding: 8px 15px 8px 15px;
            border: none;
            color: #fff;
        }
        .form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover {
            background: #e0372b;
            box-shadow: none;
            -moz-box-shadow: none;
            -webkit-box-shadow: none;
        }
        .form-style-1 .required {
            color: red;
        }
    </style>
</head>
<body>
<form onsubmit="makePayment()" id="payment-form">
    <ul class="form-style-1">

        <li>
            <label>RRR<span class="required">*</span></label>
            <input type="text" id="js-rrr" name="rrr"  class="field-long"/>
        </li>

        <li>
            <input type="button" onclick="makePayment()" value="Pay"/>
        </li>
    </ul>
</form>

<script>



    function setDemoData() {
        var rrr_value = "{{ $RRR }}";
        //alert(rrr_value);
        var obj = {
            rrr: rrr_value
        };
        for (var propName in obj) {
            document.querySelector('#js-' + propName).setAttribute('value', obj[propName]);
        }
    }
    function makePayment() {

         var rrr_value = "{{ $RRR }}";
         var transactionId = "{{ $transID }}";
        var form = document.querySelector("#payment-form");
        var paymentEngine = RmPaymentEngine.init({
            key:"QzAwMDAxNjMwNzl8NDA4NDEyMjQ0MHw0ODZkYTZkOTE4NTVhNzMzZmIzZTM5MTU2ZDBjZDYxY2Y4MzY4ODQ1NzRkYzIyOTI2OWQzMTU1M2NlNzdkNGZkZGIyNjI1MzA1ZjZkNzkzYzM2NTE4NzUxNTI0OWVjYjAxODUyNGZmYTM3NjY3M2IwZWNjYTU3OWEwYjE5NGMyNQ==",
			transactionId:transactionId,
		    processRrr: true,
			extendedData: {
				customFields: [
					{
						name: "rrr",
						value: rrr_value
					}
				 ]
			},
            onSuccess: function (response) {
               // alert('to redirect');
                //window.location.replace("remita_process_payment.php");
                 window.location.replace("http://127.0.0.1:8000/shopping-cart/thankyou_remita");
                console.log('callback Successful Response', response);
                //
            },
            onError: function (response) {
                console.log('callback Error Response', response);
            },
            /**onClose: function () {
               console.log(response);
            }**/
        });
         paymentEngine.showPaymentWidget();
    }
    window.onload = function () {
        setDemoData();
        //makePayment();
    };
</script>
<script type="text/javascript" src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>
</body>
</html>

