<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H-Games</title>
    <script src="https://www.paypal.com/sdk/js?client-id=AVfqet2QO-SRJPN1MONjc8282rP52rvoMRPa6hP7WDOeetYgbR6c_6GXWpt2SCzhzpjbjoLtVUxxbMki&buyer-country=US&currency=MXN&components=buttons&enable-funding=card&disable-funding=venmo,paylater&locale=es_ES"></script>
    <script src="app.js"></script>
</head>
<body>
    <div class="metodos_pago">
        <div id="paypal-button-container"></div>
        <p id="result-message"></p>

        <script>
            paypal.Buttons({
                style:{
                    color: 'blue',
                    shape: 'pill',
                    label: 'pay'
                },
                createOrder: function(data, actions){
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: 100    
                            }
                        }]
                    });
                },

                onApprove: function(data,actions){
                    actions.order.capture().then(function(detalles){
                        window.location.replace("index.html");
                    });
                },

                onCancel: function(data) {
                    alert("Pago cancelado");
                    console.log(data);
                }
            }).render('#paypal-button-container');
        </script>
    </div>
</body>
</html>
