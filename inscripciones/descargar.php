<?php
  if ($_GET['aut']==99){
    include "connect.php";
    $sent="select * from vexportar";
    $rs=mysql_db_query($sys_dbname,$sent);
    if(mysql_num_rows($rs) > 0 ){
      date_default_timezone_set('America/Lima');
      if (PHP_SAPI == 'cli')
        die('Este archivo solo se puede ver desde un navegador web');
      require_once "../PHPExcel/PHPExcel.php";
      $objPHPExcel = new PHPExcel();
      $objPHPExcel->getProperties()->setCreator("Peru Runners") // Nombre del autor
        ->setLastModifiedBy("Peru Runners") //Ultimo usuario que lo modificó
        ->setTitle("Reporte Incritos y pagados") // Titulo
        ->setSubject("Reporte Incritos y pagados") //Asunto
        ->setDescription("Reporte Inscritos y pagados a través de la web de PeruRunners") //Descripción
        ->setKeywords("reporte web") //Etiquetas
        ->setCategory("Reporte excel"); //Categorias
      $tituloReporte="Reporte de inscritos a Peru Runners via web y con pagos aceptados";
      $titulosColumnas=["Id", "Nombres", "Tipo Doc", "N Doc", "Fecha de Nac.", "Email", "Telef. Fijo", "Celular", "Sexo", "Talla", "Fecha y Hora Inscripcion", "Tipo Inscripcion", "Fecha y Hora Pago", "Tarjeta"];
      $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A1:N1');
      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1',$tituloReporte) // Titulo del reporte
        ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
        ->setCellValue('B3',  $titulosColumnas[1])
        ->setCellValue('C3',  $titulosColumnas[2])
        ->setCellValue('D3',  $titulosColumnas[3])
        ->setCellValue('E3',  $titulosColumnas[4])
        ->setCellValue('F3',  $titulosColumnas[5])
        ->setCellValue('G3',  $titulosColumnas[6])
        ->setCellValue('H3',  $titulosColumnas[7])
        ->setCellValue('I3',  $titulosColumnas[8])
        ->setCellValue('J3',  $titulosColumnas[9])
        ->setCellValue('K3',  $titulosColumnas[10])
        ->setCellValue('L3',  $titulosColumnas[11])
        ->setCellValue('M3',  $titulosColumnas[12])
        ->setCellValue('N3',  $titulosColumnas[13]);
       $i = 4; //Numero de fila donde se va a comenzar a rellenar
       while ($fila = mysql_fetch_array($rs)) {
           $objPHPExcel->setActiveSheetIndex(0)
               ->setCellValue('A'.$i, $fila['id'])
               ->setCellValue('B'.$i, $fila['nombre'])
               ->setCellValue('C'.$i, $fila['tipo_doc'])
               ->setCellValue('D'.$i, $fila['n_doc'])
               ->setCellValue('E'.$i, $fila['fecha_nac'])
               ->setCellValue('F'.$i, $fila['email'])
               ->setCellValue('G'.$i, $fila['telef_fijo'])
               ->setCellValue('H'.$i, $fila['celular'])
               ->setCellValue('I'.$i, $fila['sexo'])
               ->setCellValue('J'.$i, $fila['talla'])
               ->setCellValue('K'.$i, $fila['fecha_ins'])
               ->setCellValue('L'.$i, $fila['tipo'])
               ->setCellValue('M'.$i, $fila['fecha_pros'])
               ->setCellValue('N'.$i, $fila['entidad']);
           $i++;
       }
      for($i = 'A'; $i <= 'N'; $i++){
        $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
      }
      // Se asigna el nombre a la hoja
      $objPHPExcel->getActiveSheet()->setTitle('Registro');

      // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
      $objPHPExcel->setActiveSheetIndex(0);

      // Inmovilizar paneles
      $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,13);
      
      // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Reporteinscritos.xlsx"');
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('php://output');
      exit;
      }
      else{
          print_r('No hay resultados para mostrar');
      }
  }

?>