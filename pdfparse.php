<?php
 
include 'vendor/autoload.php';
 
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('ResumeA.pdf');
 
$pages  = $pdf->getPages();
 
foreach ($pages as $page) {
    $a = $page->getText();
}
echo "$a";

$array = explode(' ', $a);
foreach($array as $key => $value)
{
    $array[$key] = trim($value);
}
var_dump($array);

$b = preg_grep("/github.com/", $array);
$str = implode("/", $b);
echo $str;

$gitarray = explode('/', $str);
var_dump($gitarray);

$gituser = $gitarray[1];
echo "<br><br>";
echo $gituser;


$lang='';
for($i=0; $i<count($array); $i++)
{
    if($array[$i] == "C/C++" || $array[$i] == "C++" || $array[$i] == "C")
    {
        echo "<br><br>";
        $lang = $array[$i].',';
        echo $lang;
    }
}


$firstname = $array[0];
$lastname = $array[1];
echo "<br><br>".$firstname." ".$lastname;


$getRegex = preg_grep("/@/", $array);
$str = implode(" ",$getRegex);
$emailArray = explode(" ", $str);
$applicantEmail = $emailArray[0];
echo "<br><br>".$applicantEmail;


$totalduration = 0;
for($i=0; $i<count($array); $i++)
{
    if($array[$i] == "Duration:")
    {
        echo "<br><br>";
        $totalduration += $array[$i+1];
        echo $totalduration;
    }
}

echo "<br><br>";

$higherIdx = 0;
$seniorIdx = 0;
for($i=0; $i<count($array); $i++){
    if($array[$i] == "Higher" && $array[$i+1] == "Secondary" && $array[$i+2] == "School"){
        $higherIdx = $i;
    }
    if($array[$i] == "Senior" && $array[$i+1] == "Secondary" && $array[$i+2] == "School"){
        $seniorIdx = $i;
    }
}
if($higherIdx < $seniorIdx){
    $b = preg_grep("/(\d)+%/", $array);
    $str = implode('', $b);
    echo $str;
    $percentageArray = explode('%', $str);
    var_dump($percentageArray);
    $percentage12 = $percentageArray[0];
    $percentage10 = $percentageArray[1];
}
if($seniorIdx < $higherIdx){
    $b = preg_grep("/(\d)+%/", $array);
    $str = implode('', $b);
    echo $str;
    $percentageArray = explode('%', $str);
    var_dump($percentageArray);
    $percentage10 = $percentageArray[0];
    $percentage12 = $percentageArray[1];
}
echo $percentage12."<br>";
echo $percentage10;

for($i=0; $i<count($array); $i++){
    if($array[$i] == "CGPA:" || $array[$i] == "GPA:"){
        $cgpa = $array[$i+1];
        break;
    }
}
$cgpa = explode("/", $cgpa);
$applicantCGPA = $cgpa[0];
echo "<br><br>";
echo $applicantCGPA;
?>