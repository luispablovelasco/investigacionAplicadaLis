<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Investigación Aplicada</title>
</head>
<body>

    <header>
        <nav class="navbar navbar-dark bg-dark">
        <div div class="container-fluid">
        <a class="navbar-brand" href="#">
        <h1>Intercomunicaciones Velasco</h1>
        <h2>Los mejores en cuanto a servicios se refiere</h2>
        </a>
        </div>
        </nav>
    </header>

    <!-- Cuerpo de la página -->
    <div class="container-flex">
        <div class="row p-5">
            
            <!-- Lista de productos -->
            <center><h3>Productos disponibles</h3></center>
            <table class="table table-bordered table-striped" style="margin-top:20px;">
                <thead>
                    <th><center>Código</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Marca</center></th>
                    <th><center>Descripcion</center></th>
                    <th><center>Precio</center></th>
                    <th><center>Unidades</center></th>
                    <th><center>Acción</center></th>
                </thead>
                <tbody>
                    <?php
                        //Abrimos donde están todos los productos guardados
                        $productos = simplexml_load_file('data/comprasProductos.xml');
                        foreach ($productos->Producto as $producto) {  //producto es cada uno de los productos que se han guardado
                        
                    ?>
                    <tr>
                        <td><?=$producto->Codigo?></td>
                        <td><?=$producto->Nombre?></td>
                        <td><?=$producto->Marca?></td>
                        <td><?=$producto->Descripcion?></td>
                        <td><?=$producto->Precio?>$</td>
                        <td><?=$producto->Unidades?></td>
                        <td><center><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregar_<?=$producto->Codigo?>">Agregar</button></center></td> <!-- Aqui estará el boton para agregar al carrito -->
                    </tr>
                    <!-- Modal agregar -->
                    <div class="modal fade" id="agregar_<?=$producto->Codigo?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <center><h5 class="modal-title" id="exampleModalLabel">Agregar al carrito</h5></center>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="pages/agregar.php">
                                    <label for="lbCantidad">Cantidad a agregar:</label>
                                    <br>
                                    <br>
                                    <input type="number" name="inputCant" id="" min="1">
                                    <input type="hidden" value="<?=$producto->Codigo?>" name="codProduct">
                                    <input type="hidden" value="<?=$producto->Nombre?>" name="nameProduct">
                                    <input type="hidden" value="<?=$producto->Marca?>" name="brandProduct">
                                    <input type="hidden" value="<?=$producto->Descripcion?>" name="descProduct">
                                    <input type="hidden" value="<?=$producto->Precio?>" name="priceProduct">
                                    <input type="hidden" value="<?=$producto->Unidades?>" name="unitProduct">
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-success">Agregar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        } //Cerramos el foreach anterior
                    ?>
                </tbody>
            </table>
        </div>  
        <hr> 
        <div class="row p-5">

            <!-- Columna carrito -->
            <center><h3>Carrito</h3></center>
            <table class="table table-bordered table-striped" style="margin-top:20px;">
                <thead>
                    <th><center>Código</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Marca</center></th>
                    <th><center>Descripcion</center></th>
                    <th><center>Precio</center></th>
                    <th><center>Unidades</center></th>
                    <th><center>Cantidad</center></th>
                    <th><center></center></th>
                </thead>
                <tbody>
                    <?php

                        $sumPrecio=0;
                        $precioF;
                        //Abrimos donde están todos los productos guardados
                        $productos = simplexml_load_file('data/factura.xml');
                        foreach ($productos->Producto as $producto) {  //producto es cada uno de los productos que se han guardado

                        $sumPrecio+=$producto->Precio*$producto->Cantidad;
                        
                    ?>
                    <tr>
                        <td><?=$producto->Codigo?></td>
                        <td><?=$producto->Nombre?></td>
                        <td><?=$producto->Marca?></td>
                        <td><?=$producto->Descripcion?></td>
                        <td><?=$producto->Precio?>$</td>
                        <td><?=$producto->Unidades?></td>
                        <td><?=$producto->Cantidad?></td>
                        <td><center><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminar_<?=$producto->Codigo?>">Eliminar</button></center></td> <!-- Aqui estará el boton para quitar del carrito -->
                    </tr>
                    <!-- Modal Eliminar -->
                    <div class="modal fade" id="eliminar_<?=$producto->Codigo?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <center><h5 class="modal-title" id="exampleModalLabel">Eliminar del carrito</h5></center>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">¿Desea borrar el producto de su carrito?</p>
                                <h2 class="text-center"><?=$producto->Nombre?></h2>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <a href="pages/eliminar.php?cod=<?=$producto->Codigo?>" class="btn btn-danger">Eliminar</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        } //Cerramos el foreach anterior
                    ?>
                </tbody>
            </table>

            <!-- BOTON PARA FINALIZAR COMPRA -->
            <h3>Total a pagar: <?=$sumPrecio?>$</h3>
            <div class="container p-3">
                <center><button type="button" class="btn btn-primary">Finalizar compra</button></center>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>