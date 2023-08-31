<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>

    <form action="update.php" method="POST">
        <label for="id_producto">ID del producto:</label>
        <input type="text" name="id_producto" id="id_producto" placeholder="Ingrese el ID del producto" required>
        <br><br>

        <label for="pr_nombre">Nombre del producto:</label>
        <input type="text" name="pr_nombre" id="pr_nombre" placeholder="Nombre del producto" required>
        <br><br>

        <label for="pr_descripcion">Descripción del producto:</label>
        <input type="text" name="pr_descripcion" id="pr_descripcion" placeholder="Descripción del producto" required>
        <br><br>

        <label for="pr_precioCompra">Precio de compra:</label>
        <input type="number" name="pr_precioCompra" id="pr_precioCompra" placeholder="Precio de compra" required>
        <br><br>

        <label for="pr_cantidad">Cantidad:</label>
        <input type="number" name="pr_cantidad" id="pr_cantidad" placeholder="Cantidad" required>
        <br><br>

        <label for="pr_marca">Marca:</label>
        <input type="text" name="pr_marca" id="pr_marca" placeholder="Marca" required>
        <br><br>

        <label for="pr_color">Color:</label>
        <input type="text" name="pr_color" id="pr_color" placeholder="Color" required>
        <br><br>

        <label for="pr_gama">Gama:</label>
        <input type="text" name="pr_gama" id="pr_gama" placeholder="Gama" required>
        <br><br>

        <input type="submit" value="Actualizar Producto">
    </form>
</body>
</html>
