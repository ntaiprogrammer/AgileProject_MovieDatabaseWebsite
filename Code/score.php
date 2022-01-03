<!DOCTYPE html>
<html lang="en">
<?php require_once("conscrip.php")?>
<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- this is all of the required setups -->
</head>

<body>
    <div class="row">
        <header class="col-lg-12 bg-info">
            <class="col-lg-2">
            <h1 class="col-lg-10 text-center">Score save</h1>
        </header>
    </div>
<!--   this is the header information   -->
    <div class="row">
        <nav class="col-lg-2">
            <h2 class="text">Navigation bar</h2>
            <ul class="nav nav-pills nav-stacked">
            <li><a href="index.html">Search</a></li>
                <li><a href="MSearched.php">10 Most Searched</a></li>
                <li><a href="Hrated.php">Highest rated movies</a></li>
            	<li><a href="Signup.html">Subscribe to our newsletter!</a></li>
            	<li><a href="Admin.php">Admin page</a></li>
                <li><a href="signin.php">Signin</a></li>
                <li><a href="review.html">rate a movie</a></li>
            </ul>
        </nav>
<!--   this is the navigation bar setup   -->
        <?php
        $genre = $_POST["genre"];
        $name = $_POST["name"];
        $rating = $_POST["rating"];
        $year = $_POST["year"];
        $score = $_POST["score"];
        ?>
<!-- these are the variables fed in by the search bars -->
        <main class="col-lg-10">
        <?php

        $command = $pdo->prepare("SELECT * FROM `movie` WHERE `Genre` LIKE ? AND `Rating` LIKE ? AND `Year` LIKE ? AND `Title` LIKE  ?");
        $command -> execute(['%'.$genre.'%','%'.$rating.'%','%'.$year.'%','%'.$name.'%']);
        $results = $command->fetchAll();
//         this is the search being executed using the search variables in a sql command
        if ($command->rowCount()==1) {
            $command2 = $pdo->prepare("UPDATE `movie` SET `reviewCount` = `reviewCount` + 1 WHERE `Genre` LIKE ? AND `Rating` LIKE ? AND `Year` LIKE ? AND `Title` LIKE  ?");
            $command2 -> execute(['%'.$genre.'%','%'.$rating.'%','%'.$year.'%','%'.$name.'%']);
            $command -> execute(['%'.$genre.'%','%'.$rating.'%','%'.$year.'%','%'.$name.'%']);
            $results = $command->fetchAll();
            foreach ($results as $result) {
                
                if($result['reviewCount'] != 1){
                    $add = ($score + $result['score']);
                    $avg = intdiv($add, 2);
                }
                else{
                    $avg = ($score);
                }
                $command2 = $pdo->prepare("UPDATE `movie` SET `score` = ? WHERE `Genre` LIKE ? AND `Rating` LIKE ? AND `Year` LIKE ? AND `Title` LIKE  ?");
                $command2 -> execute([$avg,'%'.$genre.'%','%'.$rating.'%','%'.$year.'%','%'.$name.'%']);
            }
            ?> <H1>review processed</H1><?php
        }
//         this if statement checks if the search returned no resulsts and prints a message if so
        else{ 
            ?> <H1>either no result found or too many results found</H1><?php
        }?>
        </main>
    </div>
</body>

</html>