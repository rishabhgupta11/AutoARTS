<?php
 
include 'vendor/autoload.php';
 
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('ResumeE.pdf');
 
$pages  = $pdf->getPages();
 
foreach ($pages as $page) {
    $a = $page->getText();
}

$array = explode(' ', $a);
foreach($array as $key => $value)
{
    $array[$key] = trim($value);
}

var_dump($array);

$b = preg_grep("/github.com/", $array);
$str = implode("/", $b);
$gitarray = explode('/', $str);
$gituser = $gitarray[1];
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

if($array[0] == NULL){
    $firstname = $array[1];
    $lastname = $array[2];
}
else{
    $firstname = $array[0];
    $lastname = $array[1];
}
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
    $percentageArray = explode('%', $str);
    $percentage12 = $percentageArray[0];
    $percentage10 = $percentageArray[1];
}
if($seniorIdx < $higherIdx){
    $b = preg_grep("/(\d)+%/", $array);
    $str = implode('', $b);
    $percentageArray = explode('%', $str);
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


ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
$api_json = file_get_contents('https://api.github.com/users/'.$gituser.'/repos', true);
$api_data = json_decode($api_json);
var_dump($api_data);
echo "<br><br>";
echo count($api_data);
echo "<br>";
$languages = array();
for($i=0; $i<count($api_data); $i++){
    if($api_data[$i]->{'language'} == NULL){
        continue;
    }
    echo $api_data[$i]->{'language'};
    if(!isset($languages[$api_data[$i]->{'language'}])){
        $languages += array($api_data[$i]->{'language'} => 1);
    }
    else{
        $languages[$api_data[$i]->{'language'}]++;
    }
    echo "<br>";
}

var_dump($languages);
?>