<?php
    $codigo = $_GET['cod'];
    $productos = simplexml_load_file('../data/factura.xml');
    $indice =0;
    $i = 0;
    foreach ($productos->Producto as $producto) {
        if ($producto->Codigo == $codigo) {
            $indice = $i;
            break;
        }
        $i++;
        //var_dump($producto);
    }
    //var_dump($productos);

    unset($productos->Producto[$indice]);
    file_put_contents('../data/factura.xml',$productos->asXML());
    header('location:../index.php');
?>