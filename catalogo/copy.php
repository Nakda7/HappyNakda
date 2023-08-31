<div class="paypal-contenedor">
    <script>
        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay'
            },

            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total; ?> // Total obtenido de PHP
                        }
                    }]
                });
            },

            onApprove: function (data, actions) {
                actions.order.capture().then(function (details) {
                    // Después de capturar el pago con éxito, realizar el descuento del inventario

                    // Obtener la sucursal actual del carrito
                    var id_sucursal = <?php echo $id_sucursal; ?>;

                    // Obtener los productos agregados al carrito y sus cantidades
                    var cartItems = <?php echo json_encode($cart_items); ?>;

                    // Recorrer el arreglo de productos en el carrito y hacer el descuento en el inventario
                    for (var i = 0; i < cartItems.length; i++) {
                        var product_id = cartItems[i].id_producto;
                        var quantity = cartItems[i].c_quantity;

                        // Realizar la solicitud AJAX para actualizar el inventario
                        var xhr = new XMLHttpRequest();
                        xhr.open("POST", "actualizarInventario.php", false); // Hacer la solicitud de manera síncrona
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send("product_id=" + product_id + "&quantity=" + quantity + "&id_sucursal=" + id_sucursal);
                    }

                    window.location.href = "completado.php";
                });
            },

            onCancel: function (data) {
                alert("Pago Cancelado");
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
</div>