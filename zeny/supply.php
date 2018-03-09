<?php

$halving_time = 500000;

$url1="https://zeny.insight.monaco-ex.org/api/status?q=getInfo";
$url2= "http://namuyan.dip.jp/MultiLightBlockExplorer/apis.php?data=zeny/api/status?q=getBlockCount";
$reward = 250;
$supply = 0;
$height = 0;



if($data = file_get_contents($url1)){
    $array = json_decode($data, true);
    $height = $array['info']['blocks'];
}else{
    if($data = file_get_contents($url2)){
        $array = json_decode($data, true);
        $height = $array['blockcount'];
        }else{
            echo "Not available";
        }
}

$blocks = $height + 1;

while($blocks > $halving_time){
    $supply += $halving_time * $reward;
    $blocks = $blocks - $halving_time;
    $reward = $reward / 2;
}
$supply += $blocks * $reward;

echo $supply;
?>
