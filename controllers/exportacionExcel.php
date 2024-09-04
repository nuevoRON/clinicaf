<?php
//verifica si hay sesiones iniciadas
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require 'vendor/autoload.php';
require 'models/ProveidosModel.php';
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

class exportacionExcel extends Controller
{
    public function exportarProveidos(){
      $data = $this->model->listarProveidos();

      $documento = new Spreadsheet();
      $documento
      ->getProperties()
      ->setCreator("ADMIN")
      ->setLastModifiedBy('ADMIN')
      ->setTitle('Archivo generado desde MySQL')
      ->setDescription('Reporte de Proveidos');

      $hojaDeProductos = $documento->getActiveSheet();
      $documento->getActiveSheet()->getDefaultColumnDimension()->setWidth(35); 
      $documento->getActiveSheet()->getStyle('A1:D4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

      $hojaDeProductos->setCellValue('C1','Reporte de Proveidos');
      $hojaDeProductos->setCellValue('B2','Fecha: '.date('Y-m-d H:i:s'));
      $hojaDeProductos->setCellValue('B3','Generado por: '.$_SESSION['usuario']);
      $hojaDeProductos->getStyle('C1')->getFont()->setSize(20);
      $documento->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
      $hojaDeProductos->getStyle('B2')->getFont()->setSize(12);
      $documento->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
      $hojaDeProductos->getStyle('B3')->getFont()->setSize(12);
      $documento->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

      $hojaDeProductos->setTitle("Reporte de Proveidos");
      $hojaDeProductos->setCellValue('A5','N° Caso');
      $hojaDeProductos->setCellValue('B5','DNI Evaluado');
      $hojaDeProductos->setCellValue('C5','Nombre Evaluado');
      $hojaDeProductos->setCellValue('D5','Dependencia');
      $hojaDeProductos->setCellValue('E5','Tipo de Reconocimiento');
      $hojaDeProductos->setCellValue('F5','Fecha de Citación');
      
      # Comenzamos en la fila 2
      $numeroDeFila = 6;
      foreach($data as $val){
        $nombre = $val['nombre_evaluado'] . ' '. $val['apellido_evaluado'];
        $dni = $val['dni_evaluado'];
        $num_caso = $val['num_caso'];
        $nom_dependencia = $val['nom_dependencia'];
        $nom_reconocimiento = $val['nom_reconocimiento'];
        $fecha_citacion = $val['fecha_citacion'];

        # Escribir registros en el documento
        $hojaDeProductos->setCellValue('A'. $numeroDeFila, $num_caso);
        $hojaDeProductos->setCellValue('B'. $numeroDeFila, $dni);
        $hojaDeProductos->setCellValue('C'. $numeroDeFila, $nombre);
        $hojaDeProductos->setCellValue('D'. $numeroDeFila, $nom_dependencia);
        $hojaDeProductos->setCellValue('E'. $numeroDeFila, $nom_reconocimiento);
        $hojaDeProductos->setCellValue('F'. $numeroDeFila, $fecha_citacion);
         $numeroDeFila++;
      }

      //Bordes de tabla
      $documento->getActiveSheet()->getStyle('A5:A'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('B5:B'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('C5:C'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('D5:D'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A5:D5')->getBorders()->getTop()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('A6:D6')->getBorders()->getTop()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('D5:D'.$numeroDeFila)->getBorders()->getRight()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A'.$numeroDeFila.':D'.$numeroDeFila)->getBorders()->getBottom()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A5:D'.$numeroDeFila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
      $documento->getActiveSheet()->getStyle('A5:D5')->getFont()->setBold(true);
      $documento->getActiveSheet()->getStyle('A5:D5')->getFill()
          ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
          ->getStartColor()->setARGB('FFCB27');
      /* Here there will be some code where you create $spreadsheet */
          
      $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
      $drawing->setName('Paid');
      $drawing->setDescription('Paid');
      $drawing->setCoordinates('B15');
      $drawing->setOffsetX(110);
      $drawing->setRotation(25);
      $drawing->getShadow()->setVisible(true);
      $drawing->getShadow()->setDirection(45);
          
      // redirect output to client browser
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Reporte de Proveidos '.date('Y-m-d H:i:s').'.xlsx"');
      header('Cache-Control: max-age=0');
          
      $writer = IOFactory::createWriter($documento, 'Xlsx');
      $writer->save('php://output');
    }  


    public function exportarVacaciones(){
      $data = $this->model->listarVacaciones();

      $documento = new Spreadsheet();
      $documento
      ->getProperties()
      ->setCreator("ADMIN")
      ->setLastModifiedBy('ADMIN')
      ->setTitle('Archivo generado desde MySQL')
      ->setDescription('Reporte de Vacaciones');

      $hojaDeProductos = $documento->getActiveSheet();
      $documento->getActiveSheet()->getDefaultColumnDimension()->setWidth(35); 
      $documento->getActiveSheet()->getStyle('A1:D4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

      $hojaDeProductos->setCellValue('C1','Reporte de Vacaciones');
      $hojaDeProductos->setCellValue('B2','Fecha: '.date('Y-m-d H:i:s'));
      $hojaDeProductos->setCellValue('B3','Generado por: '.$_SESSION['usuario']);
      $hojaDeProductos->getStyle('C1')->getFont()->setSize(20);
      $documento->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
      $hojaDeProductos->getStyle('B2')->getFont()->setSize(12);
      $documento->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
      $hojaDeProductos->getStyle('B3')->getFont()->setSize(12);
      $documento->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

      $hojaDeProductos->setTitle("Reporte de Vacaciones");
      $hojaDeProductos->setCellValue('A5','N° Empleado');
      $hojaDeProductos->setCellValue('B5','Nombre');
      $hojaDeProductos->setCellValue('C5','Estado');
      $hojaDeProductos->setCellValue('D5','Fecha de Inicio');
      $hojaDeProductos->setCellValue('E5','Fecha Final');
      $hojaDeProductos->setCellValue('F5','Días de Vacaciones');
      $hojaDeProductos->setCellValue('G5','Observaciones');
      
      # Comenzamos en la fila 2
      $numeroDeFila = 6;
      foreach($data as $val){
        $nombre = $val['nombre_completo'];
        $num_empleado = $val['num_empleado'];
        $nom_estado = $val['nom_estado'];
        $fecha_inicio = $val['fecha_inicio'];
        $fecha_final = $val['fecha_final'];
        $dias_vacaciones = $val['dias_vacaciones'];
        $observaciones = $val['observaciones'];

        # Escribir registros en el documento
        $hojaDeProductos->setCellValue('A'. $numeroDeFila, $num_empleado);
        $hojaDeProductos->setCellValue('B'. $numeroDeFila, $nombre);
        $hojaDeProductos->setCellValue('C'. $numeroDeFila, $nom_estado);
        $hojaDeProductos->setCellValue('D'. $numeroDeFila, $fecha_inicio);
        $hojaDeProductos->setCellValue('E'. $numeroDeFila, $fecha_final);
        $hojaDeProductos->setCellValue('F'. $numeroDeFila, $dias_vacaciones);
        $hojaDeProductos->setCellValue('G'. $numeroDeFila, $observaciones);
         $numeroDeFila++;
      }

      //Bordes de tabla
      $documento->getActiveSheet()->getStyle('A5:A'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('B5:B'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('C5:C'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('D5:D'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('E5:E'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('F5:F'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('G5:G'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A5:G5')->getBorders()->getTop()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('A6:G6')->getBorders()->getTop()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('G5:G'.$numeroDeFila)->getBorders()->getRight()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A'.$numeroDeFila.':G'.$numeroDeFila)->getBorders()->getBottom()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A5:G'.$numeroDeFila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
      $documento->getActiveSheet()->getStyle('A5:G5')->getFont()->setBold(true);
      $documento->getActiveSheet()->getStyle('A5:G5')->getFill()
          ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
          ->getStartColor()->setARGB('FFCB27');
      /* Here there will be some code where you create $spreadsheet */
          
      $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
      $drawing->setName('Paid');
      $drawing->setDescription('Paid');
      $drawing->setCoordinates('B15');
      $drawing->setOffsetX(110);
      $drawing->setRotation(25);
      $drawing->getShadow()->setVisible(true);
      $drawing->getShadow()->setDirection(45);
          
      // redirect output to client browser
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Reporte de Vacaciones '.date('Y-m-d H:i:s').'.xlsx"');
      header('Cache-Control: max-age=0');
          
      $writer = IOFactory::createWriter($documento, 'Xlsx');
      $writer->save('php://output');
    }  


    public function exportarRevisionCasos(){
      $data = $this->model->getRevisiones();

      $documento = new Spreadsheet();
      $documento
      ->getProperties()
      ->setCreator("ADMIN")
      ->setLastModifiedBy('ADMIN')
      ->setTitle('Archivo generado desde MySQL')
      ->setDescription('Reporte de Casos');

      $hojaDeProductos = $documento->getActiveSheet();
      $documento->getActiveSheet()->getDefaultColumnDimension()->setWidth(35); 
      $documento->getActiveSheet()->getStyle('A1:D4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

      $hojaDeProductos->setCellValue('C1','Reporte de Casos');
      $hojaDeProductos->setCellValue('B2','Fecha: '.date('Y-m-d H:i:s'));
      $hojaDeProductos->setCellValue('B3','Generado por: '.$_SESSION['usuario']);
      $hojaDeProductos->getStyle('C1')->getFont()->setSize(20);
      $documento->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
      $hojaDeProductos->getStyle('B2')->getFont()->setSize(12);
      $documento->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
      $hojaDeProductos->getStyle('B3')->getFont()->setSize(12);
      $documento->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);

      $hojaDeProductos->setTitle("Reporte de Casos");
      $hojaDeProductos->setCellValue('A5','Medico');
      $hojaDeProductos->setCellValue('B5','Fecha de Revisión');
      $hojaDeProductos->setCellValue('C5','N° Dictamen');
      $hojaDeProductos->setCellValue('D5','Nombre Evaluado');
      $hojaDeProductos->setCellValue('E5','Fecha de Evaluacion');
      $hojaDeProductos->setCellValue('F5','Tipo de Reconocimiento');
      $hojaDeProductos->setCellValue('G5','Sede Medico');
      $hojaDeProductos->setCellValue('H5','Clinica');
      
      # Comenzamos en la fila 2
      $numeroDeFila = 6;
      foreach($data as $val){
        $nombre_completo = $val['nombre_completo'];
        $fecha_revision = $val['fecha_revision'];
        $numero_dictamen = $val['numero_dictamen'];
        $nombre_evaluado = $val['nombre_evaluado'];
        $fecha_evaluacion = $val['fecha_evaluacion'];
        $nom_reconocimiento = $val['nom_reconocimiento'];
        $sede_medico = $val['sede_medico'];
        $ubicacion = $val['ubicacion'];

        # Escribir registros en el documento
        $hojaDeProductos->setCellValue('A'. $numeroDeFila, $nombre_completo);
        $hojaDeProductos->setCellValue('B'. $numeroDeFila, $fecha_revision);
        $hojaDeProductos->setCellValue('C'. $numeroDeFila, $numero_dictamen);
        $hojaDeProductos->setCellValue('D'. $numeroDeFila, $nombre_evaluado);
        $hojaDeProductos->setCellValue('E'. $numeroDeFila, $fecha_evaluacion);
        $hojaDeProductos->setCellValue('F'. $numeroDeFila, $nom_reconocimiento);
        $hojaDeProductos->setCellValue('G'. $numeroDeFila, $sede_medico);
        $hojaDeProductos->setCellValue('H'. $numeroDeFila, $ubicacion);

         $numeroDeFila++;
      }

      //Bordes de tabla
      $documento->getActiveSheet()->getStyle('A5:A'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('B5:B'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('C5:C'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('D5:D'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('E5:E'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('F5:F'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('G5:G'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('H5:H'.$numeroDeFila)->getBorders()->getLeft()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

          
      $documento->getActiveSheet()->getStyle('A5:H5')->getBorders()->getTop()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
      $documento->getActiveSheet()->getStyle('A6:H6')->getBorders()->getTop()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('H5:H'.$numeroDeFila)->getBorders()->getRight()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A'.$numeroDeFila.':H'.$numeroDeFila)->getBorders()->getBottom()->
      setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
          
      $documento->getActiveSheet()->getStyle('A5:H'.$numeroDeFila)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
      $documento->getActiveSheet()->getStyle('A5:H5')->getFont()->setBold(true);
      $documento->getActiveSheet()->getStyle('A5:H5')->getFill()
          ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
          ->getStartColor()->setARGB('FFCB27');
      /* Here there will be some code where you create $spreadsheet */
          
      $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
      $drawing->setName('Paid');
      $drawing->setDescription('Paid');
      $drawing->setCoordinates('B15');
      $drawing->setOffsetX(110);
      $drawing->setRotation(25);
      $drawing->getShadow()->setVisible(true);
      $drawing->getShadow()->setDirection(45);
          
      // redirect output to client browser
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Reporte de Casos '.date('Y-m-d H:i:s').'.xlsx"');
      header('Cache-Control: max-age=0');
          
      $writer = IOFactory::createWriter($documento, 'Xlsx');
      $writer->save('php://output');
    }  

}

