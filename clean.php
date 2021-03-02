<?php
session_start();
if (isset($_SESSION['rows'])) {
    $_SESSION['rows'] = array();
}
$html = file_get_contents('index.html');
    echo $html;
?>
<table class="out">
    <tr>
        <th class="variable">X</th>
        <th class="variable">Y</th>
        <th class="variable">R</th>
        <th>Time</th>
        <th>Script executed in</th>
        <th>Result</th>
    </tr>
</table>