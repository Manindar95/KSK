<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://credimax.gateway.mastercard.com/static/checkout/checkout.min.js" data-error="errorCallback"
        data-cancel="{{asset($cancelURL)}}"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Credimax Transaction</title>
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>


    <script>
      function errorCallback (error){
        alert("payment error");
        console.log(error);
        //window.location.href = "/payment-error";
      }
        Checkout.configure({
            order: {
                description: `
                Name: {{$name}} ,
                Order Id: {{$orderID}}`,
                id: '{{$orderID}}'
            },
           session: {
                id: '{{$sessionId}}'
            },
            interaction: {
                merchant: {
                    name: '{{$name}}',
                    address: {
                        line1: '{{$address}}'
                    }
                }
            }
        });

        Checkout.showPaymentPage();
    </script>

</body>

</html>