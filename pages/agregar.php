<?php
    
    $productos = simplexml_load_file('../data/factura.xml');
    $producto = $productos->addChild('Producto'); //Creamos un nuevo "objeto" llamado Producto
    $producto->addChild('Codigo',$_POST['codProduct']);
    $producto->addChild('Nombre',$_POST['nameProduct']);
    $producto->addChild('Marca',$_POST['brandProduct']);
    $producto->addChild('Descripcion',$_POST['descProduct']);
    $producto->addChild('Precio',$_POST['priceProduct']);
    $producto->addChild('Unidades',$_POST['unitProduct']);
    $producto->addChild('Cantidad',$_POST['inputCant']);

    file_put_contents('../data/factura.xml',$productos->asXML()); //Guardamos el nuevo producto en el xml
    header('location:../index.php');
?>