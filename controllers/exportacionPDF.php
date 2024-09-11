<?php
//verifica si hay sesiones iniciadas
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require 'vendor/autoload.php';
require 'models/ProveidosModel.php';
 
use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\Exception as DomException;

class exportacionPDF extends Controller
{
    public function exportarProveidos(){
      $fechaInicio = !empty($_GET['fechaInicio']) ? strClean($_GET['fechaInicio']) : null;
      $fechaFinal = !empty($_GET['fechaFinal']) ? strClean($_GET['fechaFinal']) : null;
      $reconocimiento = !empty($_GET['reconocimiento']) ? strClean($_GET['reconocimiento']) : null;
      $medico = !empty($_GET['medico']) ? strClean($_GET['medico']) : null;
      $sexo = !empty($_GET['sexo']) ? strClean($_GET['sexo']) : null;

      $options = new Options();
      $options->set('isRemoteEnabled', true);

      $data = $this->model->listarProveidos($fechaInicio,$fechaFinal,$reconocimiento,$medico,$sexo);
      $fecha_actual=date('Y-m-d H:i:s');

      //codigo para obtener la imagen de logo de la empresa
      $nombreImagen = "./assets/images/mf.jpeg";
      $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
 
      try {
      $download  = false;
        $contenido = '<!DOCTYPE html>
        <html>
          <head>
          <title>Reporte de Proveidos</title>
            <style>
              body{
                  font-family:sans-serif;
              }

              h1,h2{
                  text-align:center;
              }

              table {
                width: 100%%;
                text-align: center;
                border-collapse: collapse;
              } 
                
                th, td {
                  padding: 8px;
                }
                
                th {
                  background-color: #4CAF50;
                  color: white;
                }
                
                tr:nth-child(even) {
                  background-color: #f2f2f2;
                }
                
            </style>
          </head>
          <body>
          <img src='. $imagenBase64 .' width="150" height="150" style="margin-left:17rem;"/>
            <h1>Informacion de Proveidos</h1>';
            $contenido .='<span> Fecha: ' . $fecha_actual;
            $contenido .='<br><br>';
            $contenido .='<span> Generado por: ' . $_SESSION['usuario'];
            $contenido .='<table>
              <br>
              <thead>
                <tr>
                  <th>N° Caso</th>
                  <th>DNI Evaluado</th>
                  <th>Nombre Evaluado</th>
                  <th>Dependencia</th>
                  <th>Tipo de Reconocimiento</th>
                  <th>Fecha de Citación</th>
                </tr>
              </thead>
              <tbody>';

              foreach($data as $val){
                $contenido .='<tr>';
                $contenido .= '<td>' . $val["num_caso"] . '</td>';
                $contenido .= '<td>' . $val["dni_evaluado"] . '</td>';
                $contenido .='<td>' . $val['nombre_evaluado'] . ' '. $val['apellido_evaluado'] .'</td>';
                $contenido .= '<td>' . $val["nom_dependencia"] . '</td>';
                $contenido .= '<td>' . $val["nom_reconocimiento"] . '</td>';
                $contenido .= '<td>' . $val["fecha_citacion"] . '</td>';
                $contenido .='</tr>';
              }
             
              $contenido .='</tbody>
            </table>
          </body>
        </html>';
        $contenido=sprintf($contenido);
  
        // Nombre del pdf
        $filename = 'Reporte de Boletos ' . date('Y-m-d H:i:s') .'.pdf';
  
        // Instancia de la clase
        $dompdf = new Dompdf($options);
  
        // Cargar el contenido HTML
        $dompdf->loadHtml($contenido);
  
        // Formato y tamaño del PDF
        $dompdf->setPaper('A4', 'portrait');
  
        // Renderizar HTML como PDF
        $dompdf->render();

        $footer ='Página: {PAGE_NUM}/{PAGE_COUNT}';
        $dompdf->getCanvas()->page_text(270, 800, $footer, null, 10, array(0, 0, 0));
  
        // Salida para descargar
        $dompdf->stream($filename,['Attachment' => $download]);
  
      } catch (DomException $e) {
        echo 'Error al generar el PDF: ' . $e->getMessage();
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
    } 
    
    
    public function exportarVacaciones(){
      $fechaInicio = !empty($_GET['fecha_inicio']) ? strClean($_GET['fecha_inicio']) : null;
      $fechaFinal = !empty($_GET['fecha_final']) ? strClean($_GET['fecha_final']) : null;
      $medico = !empty($_GET['medico']) ? strClean($_GET['medico']) : null;

      // Opciones para prevenir errores con carga de imágenes
      $options = new Options();
      $options->set('isRemoteEnabled', true);

      $data = $this->model->listarVacaciones($fechaInicio,$fechaFinal,$medico);
      $fecha_actual=date('Y-m-d H:i:s');

      //codigo para obtener la imagen de logo de la empresa
      $nombreImagen = "./assets/images/Avatar.png";
      $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
 
      try {
      $download  = false;
        $contenido = '<!DOCTYPE html>
        <html>
          <head>
          <title>Reporte de Vacaciones</title>
            <style>
              body{
                  font-family:sans-serif;
              }

              h1,h2{
                  text-align:center;
              }

              table {
                width: 100%%;
                text-align: center;
                border-collapse: collapse;
              } 
                
                th, td {
                  padding: 8px;
                }
                
                th {
                  background-color: #4CAF50;
                  color: white;
                }
                
                tr:nth-child(even) {
                  background-color: #f2f2f2;
                }
                
            </style>
          </head>
          <body>
          <img src='. $imagenBase64 .' width="150" height="100" style="margin-left:17rem;"/>
            <h1>Informacion de Vacaciones</h1>';
            $contenido .='<span> Fecha: ' . $fecha_actual;
            $contenido .='<br><br>';
            $contenido .='<span> Generado por: ' . $_SESSION['usuario'];
            $contenido .='<table>
              <br>
              <thead>
                <tr>
                  <th>N° Empleado</th>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Fecha de Inicio</th>
                  <th>Fecha Final</th>
                  <th>Días de Vacaciones</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <tbody>';

              foreach($data as $val){
                $contenido .='<tr>';
                $contenido .= '<td>' . $val["num_empleado"] . '</td>';
                $contenido .= '<td>' . $val["nombre_completo"] . '</td>';
                $contenido .= '<td>' . $val["nom_estado"] . '</td>';
                $contenido .= '<td>' . $val["fecha_inicio"] . '</td>';
                $contenido .= '<td>' . $val["fecha_final"] . '</td>';
                $contenido .= '<td>' . $val["dias_vacaciones"] . '</td>';
                $contenido .= '<td>' . $val["observaciones"] . '</td>';
                $contenido .='</tr>';
              }
             
              $contenido .='</tbody>
            </table>
          </body>
        </html>';
        $contenido=sprintf($contenido);
  
        // Nombre del pdf
        $filename = 'Reporte de Vacaciones ' . date('Y-m-d H:i:s') .'.pdf';
  
        // Instancia de la clase
        $dompdf = new Dompdf($options);
  
        // Cargar el contenido HTML
        $dompdf->loadHtml($contenido);
  
        // Formato y tamaño del PDF
        $dompdf->setPaper('A4', 'portrait');
  
        // Renderizar HTML como PDF
        $dompdf->render();

        $footer ='Página: {PAGE_NUM}/{PAGE_COUNT}';
        $dompdf->getCanvas()->page_text(270, 800, $footer, null, 10, array(0, 0, 0));
  
        // Salida para descargar
        $dompdf->stream($filename,['Attachment' => $download]);
  
      } catch (DomException $e) {
        echo 'Error al generar el PDF: ' . $e->getMessage();
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
    } 


    public function exportarRevisionCasos(){
      // Opciones para prevenir errores con carga de imágenes
      
      $options = new Options();
      $options->set('isRemoteEnabled', true);

      $data = $this->model->getRevisiones();
      $fecha_actual=date('Y-m-d H:i:s');

      //codigo para obtener la imagen de logo de la empresa
      $nombreImagen = "./assets/images/Avatar.png";
      $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
 
      try {
      $download  = false;
        $contenido = '<!DOCTYPE html>
        <html>
          <head>
          <title>Reporte de Revisión de Casos</title>
            <style>
              body{
                  font-family:sans-serif;
              }

              h1,h2{
                  text-align:center;
              }

              table {
                width: 100%%;
                text-align: center;
                border-collapse: collapse;
              } 
                
                th, td {
                  padding: 8px;
                }
                
                th {
                  background-color: #4CAF50;
                  color: white;
                }
                
                tr:nth-child(even) {
                  background-color: #f2f2f2;
                }
                
            </style>
          </head>
          <body>
          <img src='. $imagenBase64 .' width="150" height="100" style="margin-left:17rem;"/>
            <h1>Informacion de Casos</h1>';
            $contenido .='<span> Fecha: ' . $fecha_actual;
            $contenido .='<br><br>';
            $contenido .='<span> Generado por: ' . $_SESSION['usuario'];
            $contenido .='<table>
              <br>
              <thead>
                <tr>
                  <th>Medico</th>
                  <th>Fecha de Revisión</th>
                  <th>N° Dictamen</th>
                  <th>Nombre Evaluado</th>
                  <th>Fecha de Evaluacion</th>
                  <th>Tipo de Reconocimiento</th>
                  <th>Sede Medico</th>
                  <th>Clinica</th>
                </tr>
              </thead>
              <tbody>';

              foreach($data as $val){
                $contenido .='<tr>';
                $contenido .= '<td>' . $val["nombre_completo"] . '</td>';
                $contenido .= '<td>' . $val["fecha_revision"] . '</td>';
                $contenido .= '<td>' . $val["numero_dictamen"] . '</td>';
                $contenido .= '<td>' . $val["nombre_evaluado"] . '</td>';
                $contenido .= '<td>' . $val["fecha_evaluacion"] . '</td>';
                $contenido .= '<td>' . $val["nom_reconocimiento"] . '</td>';
                $contenido .= '<td>' . $val["sede_medico"] . '</td>';
                $contenido .= '<td>' . $val["ubicacion"] . '</td>';

                $contenido .='</tr>';
              }
             
              $contenido .='</tbody>
            </table>
          </body>
        </html>';
        $contenido=sprintf($contenido);
  
        // Nombre del pdf
        $filename = 'Reporte de Casos ' . date('Y-m-d H:i:s') .'.pdf';
  
        // Instancia de la clase
        $dompdf = new Dompdf($options);
  
        // Cargar el contenido HTML
        $dompdf->loadHtml($contenido);
  
        // Formato y tamaño del PDF
        $dompdf->setPaper('A4', 'landscape');
  
        // Renderizar HTML como PDF
        $dompdf->render();

        $footer ='Página: {PAGE_NUM}/{PAGE_COUNT}';
        $dompdf->getCanvas()->page_text(270, 900, $footer, null, 10, array(0, 0, 0));
  
        // Salida para descargar
        $dompdf->stream($filename,['Attachment' => $download]);
  
      } catch (DomException $e) {
        echo 'Error al generar el PDF: ' . $e->getMessage();
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
    } 

}

