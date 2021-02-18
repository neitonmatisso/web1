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

    /*   function wherePoint ($ax,$ay,$bx,$by,$px,$py) {
        $s = ($bx-$ax)*($py-$ay)-($by-$ay)*($px-$ax);
        if ($s>0) { return 1; }
        elseif ($s<0) { return -1; }
        else  { return 0; }
    }
    function pointInsideTriangle ($ax,$ay,$bx,$by,$cx,$cy,$px,$py) {
        $pit = false;
        $s1 = wherePoint($ax,$ay,$bx,$by,$px,$py);
        $s2 = wherePoint($bx,$by,$cx,$cy,$px,$py);
        if ($s2*$s1<=0) { $pit = false;};
        $s3 = wherePoint($cx,$cy,$ax,$ay,$px,$py);
        if ($s3*$s2<=0) {$pit = false;};
        $pit = true;
        return $pit;
    } */

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

    @session_start();
    if (!isset($_SESSION["rows"])) $_SESSION["rows"] = array();
    date_default_timezone_set('Europe/Moscow');

    $x = $_POST["coordinateX"];
    $y = $_POST["coordinateY"];
    $r = $_POST["coordinateR"];

    $time = date("H:i:s");
    $exec = round( (microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"]), 5);

    if (checkData($x, $y, $r)) {

        $coordinateQuarter = checkCoordinateQuarter($x,$y);
    
    switch($coordinateQuarter) {
        case "1" : $result = checkRectangle($x,$y,$r); break;
        case "2" : $result = checkTriangle($x,$y,$r); break;
        case "3" : $result = checkCircle($x,$y,$r); break;
        case "4" : $result = "no"; break;
     }
    } else {
        echo "Вы ввели некорректные значения";
        return;
    }
    
    array_push($_SESSION['rows'], "<td class='scroll'>$x</td><td class='scroll'>$y</td><td class='scroll'>$r</td><td>$time</td><td>$exec sec</td><td>$result</td>");
    $html = file_get_contents('index.html');
    echo $html;
    echo "<table id='out' align='center' border='1'>";
    echo "<thead><tr><td>X</td><td>Y</td><td>R</td><td>Current time</td><td>Script executed in</td><td>Result</td></tr></thead>";
    echo "<tbody>";
    foreach ($_SESSION["rows"] as $row) {
    echo "<tr>$row</tr>";
    }
    echo "</tbody></table>";

?>