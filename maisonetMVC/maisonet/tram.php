<?php
/**
 * Created by PhpStorm.
 * User: cwy
 * Date: 11/06/2019
 * Time: 08:48
 */



$ch = curl_init();
curl_setopt(
    $ch,
    CURLOPT_URL,
    "http://projets-tomcat.isep.fr:8080/appService/?ACTION=GETLOG&TEAM=003D");
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($ch);
curl_close($ch);
echo "Raw Data:<br />";
echo("$data");

$data_tab = str_split($data,33);
echo "Tabular Data:<br />";
for($i=0, $size=count($data_tab); $i<$size; $i++){
    echo "Trame $i: $data_tab[$i]<br />";
}

//rsort($data_tab);
$trame = $data_tab[count($data_tab)-2];
// décodage avec des substring
$t = substr($trame,0,1);
$o = substr($trame,1,4);
// …
// décodage avec sscanf
list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
    sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");
echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");
echo ($t==1)? "logueur fixe": "logeur variable" ;
echo "<br /> numéro groupe : $o"."<br /> ";
echo "<br />type requete : ".($r=="1")?'donnée':'commande';
echo "<br />type capteur : ".$c;
echo "<br />numéro capteur : ".$n;
echo "<br />valeur : ".$v;
echo "<br />numero tram : ".$a;
echo "<br />check sum : ".$x;
echo "<br />TIME : ".$year.".".$month.".".$day."  ".$hour.":".$min.":".$sec;

