<?php

    if ($_SERVER['REQUEST_METHOD'] == 'GET') { 
        header('Location: index.php');
    }

    $fileplh = $_FILES['fileplh'] ?? '';
    if($fileplh == ''){
        $data['errors'] = ['El archivo es un campo requerido.'];
        echo json_encode($data);
        return;
    }
    
    if(!strpos($fileplh['name'], 'xlsx') || !strpos($fileplh['name'], 'xls')){
        $data['errors'] = ['El archivo debe ser en formato xls o xlsx.'];
        return;
    }
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    $year = $_POST['year'];
    $month = $_POST['month'];
    $nombreArchivo = $fileplh['tmp_name'];
    
    $doc = IOFactory::load($nombreArchivo);
    $totalHojas = $doc->getSheetCount();
    $hojaActual = $doc->getSheet(0);
    $numFilas = $hojaActual->getHighestDataRow();
    $letra = $hojaActual->getHighestColumn();
    $numLetra = Coordinate::columnIndexFromString($letra);
    $header = '';
    $matriz = [];
    for ($indiceFila = 1; $indiceFila <= $numFilas; $indiceFila++) {
        $fila = '';
        for ($indiceColumna = 1; $indiceColumna <= $numLetra; $indiceColumna++) { 
            $datoCelda = $hojaActual->getCellByColumnAndRow($indiceColumna, $indiceFila);
            if($indiceColumna <= $numLetra && $indiceFila == 1) {
                $header .= $datoCelda . ',';
            }
            if($indiceFila != 1){
                if ($datoCelda == '') {
                    $datoCelda = 0; 
                }
                $fila .= $datoCelda . ',';
                if($indiceColumna == $numLetra){
                    array_push($matriz,$fila);
                }
            }
        }
    }
    $header = rtrim($header, ',');
    $header = explode(',', $header);
    $table = 'create table plh (';
    $c = 0;
    foreach($header as $head){
        if ($c < 34) {
            $table .= $head . ' varchar(255),';
        } else {
            $table .= $head . ' decimal(8,2),';
        }
        $c++;
    }
    $table = rtrim( $table, ',');
    $table .= ')Engine=INNODB;'; 
    $mysqli = new mysqli('localhost', 'root', '', 'of_personal');
    
    $mysqli->query('DROP TABLE IF EXISTS plh');
    $mysqli->query($table);
    // var_dump($table);
    // echo '<br>';
    $limit = $numLetra - 1;
    // echo '<pre>';
    // var_dump($matriz);
    // echo '</pre>';
    // return;
    $insert = 'insert into plh values (';
    foreach ($matriz as $mat) {
        $mat = rtrim($mat, ',');
        $mat = explode(',', $mat);
        $a = 0;
        foreach ($mat as $m) {
            if ($a == $limit) {
                $insert .= $m . '),(';
            } else if ($a < 34) {
                $insert .= '"' . $m . '",';
            } else {
                $insert .= $m . ',';
            }
            $a++;
        }
    }
    $insert = rtrim($insert, ',(');
    $insert .= ";";
    $mysqli->query($insert);
    echo json_encode(['mes' => $month, 'anio' => $year]);