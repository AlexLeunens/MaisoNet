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

function typeCapteur($capteur)
{

    switch ($capteur) {
        case 1:
            return 'capteur distance IR';
            break;
        case 3:
            return 'capteur temperature';
            break;
        default:
            return 'unknown';
            break;
    }
}

$num =10; //    10 last trames
for($i=2;$i!=$num+2;$i++){  // last trame empty (I don't know why)

    $trame = $data_tab[count($data_tab)-$i];
// décodage avec des substring
    $t = substr($trame,0,1);
    $o = substr($trame,1,4);
// …
// décodage avec sscanf
    list($t, $o, $r, $c, $n, $v, $a, $x, $year, $month, $day, $hour, $min, $sec) =
        sscanf($trame,"%1s%4s%1s%1s%2s%4s%4s%2s%4s%2s%2s%2s%2s%2s");

    echo("<br />$t,$o,$r,$c,$n,$v,$a,$x,$year,$month,$day,$hour,$min,$sec<br />");

    echo ($t==1)? "logueur fixe": "logeur variable" ;
    echo "<br />numero groupe : $o"."<br /> ";
    echo "<br />type requete : ".($r==1)?'donnée':'commande';
    echo "<br />type capteur : ".$c." => ".typeCapteur($c);        // 1=distance   3=temperature
    //echo "<br />numéro capteur : ".$n;    // not very useful to display
    echo "<br />valeur : ".hexdec($v);      // hexa to dec
    //echo "<br />numero tram : ".$a;       // not very useful to display
    echo "<br />check sum : ".$x;
    echo "<br />TIME : ".$year.".".$month.".".$day."  ".$hour.":".$min.":".$sec."<br />";

}



