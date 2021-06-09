<?php
require("../includes/connect2.php");

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 

$fileName = "autoarts-download".date('Ymd') .".xlsx"; 
    
$fields = array('Name', 'Email'); 

$excelData = implode("\t", array_values($fields)) . "\n"; 

$query = $conn->query("SELECT ApplicantName, ApplicantEmail FROM applicants ORDER BY Score, Star DESC"); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $rowData = array($row['ApplicantName'], $row['ApplicantEmail']); 
        array_walk($rowData, 'filterData'); 
        $excelData .= implode("\t", array_values($rowData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
    
} 

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$fileName);  

echo $excelData; 
   
?>