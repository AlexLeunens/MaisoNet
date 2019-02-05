<?php
include '..\..\models\connect.php';
?>
<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
    <title>Graphe Temperature</title>

    <link rel="stylesheet" href="views/user/utilisateur1.css"> <!--feuille css-->
    <link rel="icon" href="Images-utilisateur/logo_provisoire_mini.png"> <!--icone-->

</head>

<body>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div id="container"></div>

<script>
    Highcharts.chart('container', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Température de vos pieces'
        },
        subtitle: {
            text: "Depuis le début de l'acquisition"
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Température (°C)'
            },
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
        },

        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },


        series: [{
            name: 'Température',
            data: [<?php
                $numcapteur = 1;
                $sql = "SELECT * FROM valeurcapteur WHERE valeurcapteur.Capteur_idCapteur = " . $numcapteur . " ";
                $result = $conn->query($sql);

                $row = $result->fetch_assoc();
                $valeur = $row["Valeur"];
                $date = $row["Date"];

                $year = date('Y', strtotime($date));
                $month = date('m', strtotime($date));
                $day = date('d', strtotime($date));

                echo "[Date.UTC(" . "$year" . "," . "$month" . "," . "$day" . "), " . $valeur . "]";

                while ($row = $result->fetch_assoc()) {
                    $valeur = $row["Valeur"];
                    $date = $row["Date"];

                    $year = date('Y', strtotime($date));
                    $month = date('m', strtotime($date));
                    $day = date('d', strtotime($date));

                    echo ",\n [Date.UTC(" . "$year" . "," . "$month" . "," . "$day" . "), " . $valeur . "]";
                }
                echo "\n";

                ?>]

        }]
    });
</script>


</body>