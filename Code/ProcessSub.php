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
            <h1 class="col-lg-10 text-center">Results</h1>
        </header>
    </div>
<!--   this is the header information   -->
    <div class="row">
        <nav class="col-lg-2">
            <h2 class="text">Navigation bar</h2>
            <ul class="nav nav-pills nav-stacked">
                <li><a href="index.html">Search</a></li>
                <li><a href="MSearched.php">10 Most Searched</a></li>
            	<li><a href="Signup">Subscribe to our newsletter!</a></li>
            </ul>
        </nav>
<!--   this is the navigation bar setup   -->
        <?php
        $name = $_POST["name"];
        $email = $_POST["email"];
        $type = $_POST["subselect"]
        ?>
<!-- these are the variables fed in by the search bars -->
        <main class="col-lg-10">
        <?php
        $command = $pdo->prepare("SELECT * FROM `Subscription` WHERE `Email` LIKE ?");
        $command -> execute([$email]);
        $results = $command->fetchAll();
//         this is the check being executed to test uf the email is already in the database

        if($type == "both"){
            if ($command->rowCount()>0) {
                foreach ($results as $result){
                        if($result['MonthSubStat'] == "no" or $result['NewsSubStat'] == "no"){
                            $command2 = $pdo->prepare("UPDATE `Subscription` SET `MonthSubStat` = 'yes', `NewsSubStat` = 'yes' WHERE `Email` LIKE ?");
                            $command2 -> execute([$result['email']]);
                            ?><h1>Thank you For subscribing.</h1><?php
                        }
                        else{
                            ?><h1>Your email is already on our subscription list.</h1><?php
                        }
                }
            } 
            else{
                $command2 = $pdo->prepare("INSERT INTO `Subscription` (`Name`,`Email`,`MonthSubStat`,`NewsSubStat`) VALUES (?,?,'yes','yes')");
                $command2 -> execute([$name,$email]);
                ?><h1>Thank you for subscribing</h1><?php
            }  
        }

        elseif($type == "news"){
            if ($command->rowCount()>0) {
                foreach ($results as $result){
                        if($result['NewsSubStat'] == "no"){
                            $command2 = $pdo->prepare("UPDATE `Subscription` SET `NewsSubStat` = 'yes' WHERE `Email` LIKE ?");
                            $command2 -> execute([$result['email']]);
                            ?><h1>Thank you For subscribing.</h1><?php
                        }
                        else{
                            ?><h1>Your email is already on our subscription list.</h1><?php
                        }
                }
            } 
            else{
                $command2 = $pdo->prepare("INSERT INTO `Subscription` (`Name`,`Email`,`MonthSubStat`,`NewsSubStat`) VALUES (?,?,'no','yes')");
                $command2 -> execute([$name,$email]);
                ?><h1>Thank you for subscribing</h1><?php
            }   
        }

        elseif($type == "monthly"){
            if ($command->rowCount()>0) {
                foreach ($results as $result){
                        if($result['MonthSubStat'] == "no"){
                            $command2 = $pdo->prepare("UPDATE `Subscription` SET `MonthSubStat` = 'yes' WHERE `Email` LIKE ?");
                            $command2 -> execute([$result['email']]);
                            ?><h1>Thank you For subscribing.</h1><?php
                        }
                        else{
                            ?><h1>Your email is already on our subscription list.</h1><?php
                        }
                }
            } 
            else{
                $command2 = $pdo->prepare("INSERT INTO `Subscription` (`Name`,`Email`,`MonthSubStat`,`NewsSubStat`) VALUES (?,?,'yes','no')");
                $command2 -> execute([$name,$email]);
                ?><h1>Thank you for subscribing</h1><?php
            } 
        }
    //         this checks if the email exists and either re-subs the user if they are unsubscribed or notiyes them they are already subbed if that is the case.
     
//     if the email is new adds to the database.
        ?>
        </main>
    </div>
</body>

</html>