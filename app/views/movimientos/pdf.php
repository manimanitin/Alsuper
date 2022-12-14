<?php

/**
 * Dompdf es una herramienta para convertir html a pdf
 * 
 * https://ourcodeworld.co/articulos/leer/687/como-configurar-un-encabezado-y-pie-de-pagina-en-dompdf
 * https://www.youtube.com/watch?v=0kloFCF18JI&ab_channel=EDISONESCANDON
 * Ejemplo simple
 */

# crear una cadena de datos
$html = '<html><head>
<style>   
body {
    margin-top: 3cm;
    margin-left: 2cm;
    margin-right: 2cm;
    margin-bottom: 2cm;
}

/** Definir las reglas del encabezado **/
header {
    position: fixed;
    top: 0cm;
    left: 0cm;
    right: 0cm;
    height: 3cm;
   
}

/** Definir las reglas del pie de página **/
footer {
    position: fixed; 
    bottom: 0cm; 
    left: 0cm; 
    right: 0cm;
    height: 2cm;
}
table { border-collapse: collapse; 
    margin: 25px 0; 
    font-size: 1em; 
    font-family: sans-serif; min-width: 450px; 
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); }
table thead tr { background-color: #980081; color: #ffffff; text-align: middle; }
table th, table td { padding: 12px 15px; }
table tbody tr { border-bottom: 1px solid #dddddd; } 
table tbody tr:nth-of-type(even) { background-color: #f3f3f3; } 
table tbody tr:last-of-type { border-bottom: 2px solid #009879; }

.titulo { text-align: center;}
</style>
</head>
  ';
// $html = '<head><style>' . file_get_contents( URLROOT . '/css/bs/css/bootstrap.min.css') . '</style></head> ';
//  $html = '<head><link href="' . URLROOT . '/css/bs/css/bootstrap.min.css" rel="stylesheet"></head>';
$html .= '<body>
<!-- Defina bloques de encabezado y pie de página antes de su contenido -->
<header>
   <h1 class="titulo">Empresas Tecnológicas, S.A. de C.V.</h1>
</header>

<footer>
    <h5>Todos los Derechos Reservados</h5>
</footer>

<!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
<main>
<table class="table table-bordered"> 
 <thead>
     <tr>
         <th scope="col">id</th>
         <th scope="col">id del producto</th>
         <th scope="col">cantidad</th>
         <th scope="col">fecha</th>
         
     </tr>
 </thead>
 <tbody> ';
//print_r($data);
foreach ($data as $registro) {


    $html .= '<tr>
             <td>' . $registro->id . '</td>
             <td>' . $registro->producto_id . '</td>
             <td>' . $registro->mov_cantidad . '</td>
             <td>' . $registro->mov_fecha . '</td>
             
    </tr>';
}
$html .= '</tbody></table>
</main>
</body>
</html>';

# conversion
use Dompdf\Dompdf;

# crear una instancia de la libreria

$pdf = new Dompdf();
# configuraciones
$pdf->setPaper('legal', 'landscape');
# usar la instancia
// cargar el html
$pdf->loadHtml($html);
// 2 renderizar
$pdf->render();
// generar la salida (resultado de la renderizacion)
$pdf->stream('movimientos.pdf');

 //  <td><img src="data:image/png;base64,'. base64_encode($registro->cliente_foto) .'" height="30" alt="Foto"></td>