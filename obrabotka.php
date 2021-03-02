<?php

    function checkData($x, $y, $r) {
        return is_numeric($x) && ($x >= -5 && $x <= 3) &&
        is_numeric($y) && ($y >= -3 && $y <= 3) &&
        is_numeric($r) && ($r >= 1 && $r <=5);
    }

    function checkCoordinateQuarter ($x, $y) {
        if ($x>= 0 && $y>=0) {
         return 1;}
        if ($x<=0 && $y>=0) {
         return 2;}
        if ($x<=0 && $y <=0) {
         return 3;}
        if ($x>0 && $y<0) {
         return 4;}
    }

    function checkTriangle($x,$y,$r) {
        if ($r + $x >= 2 * $y) { 
            return  "yes";
         }
        return "no"; 
    }

    function checkRectangle($x,$y,$r) {
        if ($x <= $r && $y<=$r/2) {
            return "yes";
        }
        return "no";
    }

    function checkCircle($x,$y,$r) {
        $h = sqrt($x*$x+$y*$y);
        if ($h <= $r/2) {
            return "yes";
        }
        return "no";
    } 


    session_start();
    date_default_timezone_set('Europe/Moscow');
    $start = microtime(true);
    $x = $_POST["coordinateX"];
    $y = $_POST["coordinateY"];
    $r = $_POST["coordinateR"];
    
    if (checkData($x, $y, $r)) {
        $coordinateQuarter = checkCoordinateQuarter($x,$y);
     switch($coordinateQuarter) {
        case "1" : $result = checkRectangle($x,$y,$r); break;
        case "2" : $result = checkTriangle($x,$y,$r); break;
        case "3" : $result = checkCircle($x,$y,$r); break;
        case "4" : $result = "no"; break;
     }
    }
    
    

    $now = date("H:i:s");
    $exec = round(microtime(true) - $start , 7);
    $answer = array($x, $y, $r, $result, $now, $exec);

    if (!isset($_SESSION["rows"])) $_SESSION["rows"] = array();
    array_push($_SESSION['rows'], $answer);
    $html = file_get_contents('index.html');
    echo $html;
?>

<table class="out">
    <tr>
        <th class="variable">X</th>
        <th class="variable">Y</th>
        <th class="variable">R</th>
        <th>Result</th>
        <th>Time</th>
        <th>Script executed in</th>
    </tr>
    <?php foreach ($_SESSION['rows'] as $row) { ?>
    <tr>
        <td><?php echo $row[0] ?></td>
        <td><?php echo $row[1] ?></td>
        <td><?php echo $row[2] ?></td>
        <td><?php echo $row[3] ?></td>
        <td><?php echo $row[4] ?></td>
        <td><?php echo number_format($row[5], 10, ".", "") ?></td>
    </tr>
    <?php }?>
</table>