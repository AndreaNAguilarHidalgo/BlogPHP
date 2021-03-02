<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear categorías</h1>

    <form action="guardar-categoria.php" method="POST">
        <p>
            Añade nuevas categorías al Blog para que los usuarios
            puedan usarlas al momento de crear sus entradas.
        </p>
        <br/>
        <label for="nombre">Nombre de la Categoría: </label>
        <input type="text" name="nombre"/>

        <input type="submit" value="Guardar" />
    </form>
</div><!--FIN PRINCIPAL-->

<?php require_once 'includes/pie.php';?>