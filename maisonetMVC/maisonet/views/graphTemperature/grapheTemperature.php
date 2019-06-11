<?php
include '..\..\models\connect.php';
session_start();

$name = $_SESSION["name"];
$firstname = $_SESSION["firstname"];
$adresse = $_SESSION["adresse"];
$userType = $_SESSION['type'];
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
            min: -10
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e %b}: {point.y:.2f} °C'
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

                // Get user id
                $sql = "SELECT idUtilisateur FROM utilisateur WHERE utilisateur.Nom = '" . $name . "' AND utilisateur.Prenom = '" . $firstname . "'";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $idUser = $row["idUtilisateur"];
                }

                // Get maison id
                if ($userType == 3) {
                    $sql = "SELECT idMaison FROM maison WHERE Utilisateur_idUtilisateur = " . $idUser . " AND Adresse = '" . $adresse . "' ";
                } else {
                    $sql = "SELECT * FROM maison WHERE Adresse = '" . $_SESSION["adresse"] . "' ";
                }
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    $maison = $row["idMaison"];
                }

                // Get pieces in maison (multiple results)
                $sql = " SELECT * FROM piece WHERE Maison_idMaison = " . $maison . " ";
                $resultPieces = $conn->query($sql);

                while ($rowPieces = $resultPieces->fetch_assoc()) {
                    // Get capteurs w/ type Temperature in current piece (loop)
                    $sql = " SELECT idCapteur FROM capteur WHERE Piece_idPiece = " . $rowPieces["idPiece"] . " AND Type = 'Temperature' ";
                    $resultCapteur = $conn->query($sql);


                    while ($rowCapteur = $resultCapteur->fetch_assoc()) {

                        // get values with current capteur
                        $sql = "SELECT * FROM valeurcapteur WHERE valeurcapteur.Capteur_idCapteur = " . $rowCapteur["idCapteur"] . " ";
                        $resultValeurs = $conn->query($sql);

                        if (mysqli_num_rows($resultValeurs) == 0) {
                        } else {
                            $rowGraphe = $resultValeurs->fetch_assoc();

                            $valeur = $rowGraphe["Valeur"];
                            $date = $rowGraphe["Date"];

                            $year = date('Y', strtotime($date));
                            $month = date('m', strtotime($date));
                            $day = date('d', strtotime($date));

                            echo "\n [Date.UTC(" . "$year" . "," . "$month" . "," . "$day" . "), " . $valeur . "]";

                            while ($rowGraphe = $resultValeurs->fetch_assoc()) {
                                $valeur = $rowGraphe["Valeur"];
                                $date = $rowGraphe["Date"];

                                $year = date('Y', strtotime($date));
                                $month = date('m', strtotime($date));
                                $day = date('d', strtotime($date));

                                echo ",\n [Date.UTC(" . "$year" . "," . "$month" . "," . "$day" . "), " . $valeur . "]";
                            }
                            echo "\n";
                        }

                    }

                }
                ?>]

        }]
    });
</script>


</body>