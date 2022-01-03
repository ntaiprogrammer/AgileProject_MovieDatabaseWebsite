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
                <li><a href="Hrated.php">Highest rated movies</a></li>
            	<li><a href="Signup.html">Subscribe to our newsletter!</a></li>
            	<li><a href="Admin.php">Admin page</a></li>
                <li><a href="signin.php">Signin</a></li>
                <li><a href="review.html">rate a movie</a></li>
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
        if ($type == "both"){   
            if ($command->rowCount()>0) {
                foreach ($results as $result) {
                    if($result['MonthSubStat'] == "yes" or $result['NewsSubStat'] == "yes"){
                        $command2 = $pdo->prepare("UPDATE `Subscription` SET `MonthSubStat` = 'no', `NewsSubStat` = 'no' WHERE `Email` LIKE ?");
                        $command2 -> execute([$result['Email']]);
                        ?><h1>user has been unsubscribed.</h1><?php
                    }
                    else{
                        ?><h1>this user is already not subscribed at all.</h1><?php
                    }
                }
            }
            //         this checks if the email exists and either re-subs the user if they are unsubscribed or notifes them they are already subbed if that is the case.
            else{
                ?><h1>No user exists with this email.</h1><?php
            }
        }
        elseif ($type == "news"){
            if ($command->rowCount()>0) {
                foreach ($results as $result) {
                    if( $result['NewsSubStat'] == "yes"){
                        $command2 = $pdo->prepare("UPDATE `Subscription` SET`NewsSubStat` = 'no' WHERE `Email` LIKE ?");
                        $command2 -> execute([$result['Email']]);
                        ?><h1>user has been unsubscribed.</h1><?php
                    }
                    else{
                        ?><h1>this user is already not subscribed at all.</h1><?php
                    }
                }
            }
            //         this checks if the email exists and either re-subs the user if they are unsubscribed or notifes them they are already subbed if that is the case.
            else{
                ?><h1>No user exists with this email.</h1><?php
            } 
        }
        elseif($type == "monthly"){
            if ($command->rowCount()>0) {
                foreach ($results as $result) {
                    if($result['MonthSubStat'] == "yes"){
                        $command2 = $pdo->prepare("UPDATE `Subscription` SET `MonthSubStat` = 'no' WHERE `Email` LIKE ?");
                        $command2 -> execute([$result['Email']]);
                        ?><h1>user has been unsubscribed.</h1><?php
                    }
                    else{
                        ?><h1>this user is already not subscribed at all.</h1><?php
                    }
                }
            }
            //         this checks if the email exists and either re-subs the user if they are unsubscribed or notifes them they are already subbed if that is the case.
            else{
                ?><h1>No user exists with this email.</h1><?php
            }
        }

        ?>
        </main>
    </div>
</body>

</html>