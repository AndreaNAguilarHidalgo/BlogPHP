<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>

<!-- CAJA PRINCIPAL -->
<div class="principal">
    <h1>Crear Entradas</h1><br/>
        <p>
            Añade nuevas entradas al Blog para que los usuarios
            puedan leerlas y disfrutar de nuestro contenido.
        </p>
    <form action="guardar-entrada.php" method="POST">

        <br/>
        <p>
            <label for="titulo">Título de la entrada: </label>
            <input type="text" name="titulo"/>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>
        </p>

        <p>
            <label for="descripcion">Descripción: </label>
            <textarea name="descripcion"></textarea>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>
        </p>

        <p>
            <label for="categoria">Categoría:</label>
            <select name="categoria">
                <?php 
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                        while ($categoria = mysqli_fetch_assoc($categorias)):
                ?>
                    <option value="<?=$categoria['id']?>">
                            <?=$categoria['nombre']?>
                    </option>
                <?php
                        endwhile;
                    endif;
                ?>
            </select>
            <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>
        </p><br/>
        <input type="submit" value="Guardar" />
    </form>
    <?php borrarErrores();?>
</div><!--FIN PRINCIPAL-->
<?php require_once 'includes/lateral.php'; ?>
<?php require_once 'includes/pie.php';?>