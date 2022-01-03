<!DOCTYPE html>
<html lang="en">
<?php require_once("conscrip.php")?>
<head>
    <title>10 highest rated</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<!-- this is all of the required setups -->
</head>

<body>
    <div class="row">
        <header class="col-lg-12 bg-info">
            <class="col-lg-2">
            <h1 class="col-lg-10 text-center">10 Most rated</h1>

        </header>
    </div>
<!--   this is the header information   -->
    <div class="row">
        <nav class="col-lg-2">
            <h2 class="text">Navigation bar</h2>
            <ul class="nav nav-pills nav-stacked">
            <li><a href="index.html">Search</a></li>
            <li><a href="MSearched.php">10 Most Searched</a></li>
            <li><a href="Signup.html">Subscribe to our newsletter!</a></li>
            <li><a href="Admin.php">Admin page</a></li>
            <li><a href="signin.php">Signin</a></li>
            <li><a href="review.html">rate a movie</a></li>
            </ul>
<!--   this is the navigation bar setup   -->
        </nav>
        <main class="col-lg-10">
        <?php

        $command = $pdo->prepare("SELECT * FROM `movie` ORDER BY `score` DESC LIMIT 10");
        $command -> execute();
        $results = $command->fetchAll();
        $dataPoints = array( 
            array("y" => $results[9]['score'],"label" => $results[9]['Title']),
            array("y" => $results[8]['score'],"label" => $results[8]['Title']),
            array("y" => $results[7]['score'],"label" => $results[7]['Title']),
            array("y" => $results[6]['score'],"label" => $results[6]['Title']),
            array("y" => $results[5]['score'],"label" => $results[5]['Title']),
            array("y" => $results[4]['score'],"label" => $results[4]['Title']),
            array("y" => $results[3]['score'],"label" => $results[3]['Title']),
            array("y" => $results[2]['score'],"label" => $results[2]['Title']),
            array("y" => $results[1]['score'],"label" => $results[1]['Title']),
            array("y" => $results[0]['score'],"label" => $results[0]['Title']),
        );
//         this feeds the search results into an array to use later for the chart

        ?>
<!--     this reads in all the results and places them into the table appropriatly     -->
        <?php  ?>
        <div id="chartContainer" style="height: 70vh; width: 80vw;"></div>
<!--     this is the sizing and location information for the chart     -->
        <script>
        window.onload = function() {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: false,
            title:{
                text: "10 highest rated"
            },
            axisY: {
                title: "score/10",
                includeZero: true,
            },
            data: [{
                type: "bar",
                yValueFormatString: "###",
                indexLabel: "{y}",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bolder",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
//         this creates the chart based on the fed in results in the array created earlier
        
        }
        </script>
        </main>
        <?php header('Refresh: 10; URL = Hrated.php'); ?>
    </div>
<!--   this closes the containers everything is in   -->
</body>

</html>