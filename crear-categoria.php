<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<!-- CAJA PRINCIPAL -->
<div class="principal">
    <h1>Crear categorías</h1>
        <p>
            Añade nuevas categorías al Blog para que los usuarios
            puedan usarlas al momento de crear sus entradas.
        </p>
    <form action="guardar-categoria.php" method="POST">

        <br/>
        <label for="nombre">Nombre de la Categoría: </label>
        <input type="text" name="nombre"/>

        <input type="submit" value="Guardar" />
    </form>
</div><!--FIN PRINCIPAL-->
<?php require_once 'includes/lateral.php'; ?>
<?php require_once 'includes/pie.php';?>