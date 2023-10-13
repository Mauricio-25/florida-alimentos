
<?php 
    // ! Abrir conexión
    include("../abrir_conexion.php");

    $arrayLinea = [];

    // Recorrer cada linea
    $resultado = mysqli_query($conexion, "SELECT * FROM $tabLinea");
    while ($consulta = mysqli_fetch_array($resultado)){
        $idLinea = $consulta["id"];
        $nombreL = $consulta["nombre"];

        $arrayProducto = [];

        // Recorrer cada producto de esa linea
        $resultado2 = mysqli_query($conexion, "SELECT * FROM $tabProducto WHERE id_linea=$idLinea;");
        while ($consulta2 = mysqli_fetch_array($resultado2)){
            $arrayProd = [];

            $codigo = $consulta2["codigo"];
            $nombreP = $consulta2["nombre"];
            $kilos = $consulta2["kilos"];
            $precio = $consulta2["precio"];

            array_push($arrayProducto, array($codigo, $nombreP, $kilos, $precio));
        }

        $elemento = array($nombreL, $arrayProducto);
        array_push($arrayLinea, $elemento);

    }

    // ! Cerrar conexión
    include("../cerrar_conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Código</title>

    <!-- * Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- * Icons -->
    <script src="https://kit.fontawesome.com/745852fa0a.js" crossorigin="anonymous"></script>

    <!-- * Icono Navegador -->
    <link rel="icon" href="" sizes="32x32" />
    <link rel="icon" href="" sizes="192x192" />
    <link rel="apple-touch-icon" href=""/>

    <!-- * CSS -->
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    
    <!-- * JS -->
    <script src="../codigo.js" defer></script>
</head>
<body>
    <div class="body-opcion">
        <header class="header-titulo">
            <a class="header__a"  href="../index.php">
                <i class="fa-solid fa-chevron-left flecha"></i>
            </a>

            <h2>Generar Código</h2>
        </header>
        
        
        <div class="main main__seccion">
            <form action="" class="form">
                <div class="form__campo">
                    <label for="" class="form__label">Línea</label>
                    <div class="form__combobox">
                        <div class="form__combobox-contenedor">
                            <input type="text" class="form__combobox-input" placeholder="-- Selecciona --" readonly>
                            <i class="fa-solid fa-chevron-down form__combobox-flecha"></i>
                        </div>
                        <div class="form__combobox-opciones">
                            <?php 
                                include("../abrir_conexion.php");

                                foreach ($arrayLinea as $posicion => $subArray) {
                                    echo "
                                        <div class='form__combobox-opcion' onclick='listarProductos($posicion)'>$subArray[0]</div>
                                    ";
                                }

                                include("../cerrar_conexion.php");
                            ?>
                        </div>
                    </div>
                </div>

                <div class="form__campo">
                    <label for="" class="form__label">Producto</label>
                    <div class="form__combobox">
                        <div class="form__combobox-contenedor form__combobox-disabled">
                            <input type="text" class="form__combobox-input" placeholder="-- Selecciona --" readonly id="producto">
                            <i class="fa-solid fa-chevron-down form__combobox-flecha"></i>
                        </div>
                        <div class="form__combobox-opciones listaProductos">
                        </div>
                    </div>
                </div>

                <div class="form__campo">
                    <label for="" class="form__label">Código</label>
                    <input type="text" class="form__input form__combobox-disabled" id="codigo" disabled>
                </div>

                <div class="form__campo">
                    <label for="" class="form__label">Presentación (kg)</label>
                    <input type="text" class="form__input form__combobox-disabled" id="presentacion" disabled>
                </div>

                <div class="form__campo">
                    <label for="" class="form__label">Precio</label>
                    <input type="number" class="form__input form__combobox-disabled" id="precio" disabled>
                </div>

                <div class="form__campo">
                    <label for="" class="form__label">Fecha de vencimiento</label>
                    <input type="date" class="form__input">
                </div>

                <div class="form__campo">
                    <label for="" class="form__label">Cantidad de productos</label>
                    <input type="number" class="form__input">
                </div>

                <div class="form__campo">
                    <button type="submit" class="form__boton">Generar</button>
                </div>
            </form>
        </div>  
    </div>
    
    <script>
        let arrayLinea = <?php echo json_encode($arrayLinea); ?>; // Obtner el array del php
        let listaProductos = document.querySelector(".listaProductos");

        console.log(arrayLinea);

        function listarProductos(posicion) {
            
            listaProductos.innerHTML = "";
            let hermano = listaProductos.previousElementSibling;
            hermano.classList.remove("form__combobox-disabled");

            for (i=0; i<arrayLinea[posicion][1].length; i++) {
                listaProductos.innerHTML += `
                    <div class="form__combobox-opcion" onclick="llenarCampos(${posicion}, ${i}, '${arrayLinea[posicion][1][i][1]}')">${arrayLinea[posicion][1][i][1]}</div>
                `;
            }

            let producto = document.querySelector("#producto");
            let codigo = document.querySelector("#codigo");
            let presentacion = document.querySelector("#presentacion");
            let precio = document.querySelector("#precio");

            codigo.classList.add("form__combobox-disabled");
            presentacion.classList.add("form__combobox-disabled");
            precio.classList.add("form__combobox-disabled");

            producto.value = "";
            codigo.value = "";
            presentacion.value = "";
            precio.value = "";

        }

        function llenarCampos(posicionL, posicionP, texto) {

            // escribir 
            let producto = document.querySelector("#producto");
            producto.value = texto;

            listaProductos.style.opacity = "0";
            setTimeout(() => {
                listaProductos.style.display = "none";
            }, 100);


            let codigo = document.querySelector("#codigo");
            let presentacion = document.querySelector("#presentacion");
            let precio = document.querySelector("#precio");

            codigo.classList.remove("form__combobox-disabled");
            presentacion.classList.remove("form__combobox-disabled");
            precio.classList.remove("form__combobox-disabled");

            codigo.value = arrayLinea[posicionL][1][posicionP][0];
            presentacion.value = arrayLinea[posicionL][1][posicionP][2];
            precio.value = arrayLinea[posicionL][1][posicionP][3];
        }
    </script>
</body>
</html>