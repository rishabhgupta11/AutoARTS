<?php
require("../includes/connect.php");

$number = $_POST['number'];
$email = $_SESSION['email'];
$query = "SELECT * FROM applicants WHERE Email='$email' ORDER BY Star, Score DESC";
$result = mysqli_query($con, $query);
for($n=1; $n<=$number; $n++){
    $row = mysqli_fetch_array($result);
}
$gituser = $row['GithubID'];

ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)');
$api_json = file_get_contents('https://api.github.com/users/'.$gituser.'/repos', true);
$api_data = json_decode($api_json);

$languages = array("cols"=>array(array("id"=>"", "label"=>"Language", "pattern"=>"", "type"=>"string"), array("id"=>"", "label"=>"Projects", "pattern"=>"", "type"=>"number")), "rows"=>array());

for($i=0; $i<count($api_data); $i++){
    if($api_data[$i]->{'language'} == NULL){
        continue;
    }
    $newData = array("c"=>array(array("v"=>$api_data[$i]->{'language'}, "f"=>NULL), array("v"=>1, "f"=>NULL)));
    array_push($languages["rows"], $newData);
}

$newLang = array();
for($j=0; $j<count($languages["rows"]); $j++)
{
    $lang = $languages["rows"][$j]["c"][0]["v"];
    if(!array_key_exists($lang, $newLang))
    {
        $newLang += array($lang => $j);
    }
    else{
        $oldEntry = $newLang[$lang];
        $languages["rows"][$oldEntry]["c"][1]["v"]++;
        array_splice($languages["rows"], $j, 1); 
        $j--;
    }
}

echo json_encode($languages);

?>
