<!DOCTYPE html>
<?php
   ob_start();
   session_start();
?>
<html lang="en">

<head>
    <title>Database search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- this is all the required links and imports being set up -->
</head>

<body>
    <div class="row">
        <header class="col-lg-12 bg-info">
            <class="col-lg-2">
                <h1 class="col-lg-10 text-center">Admin page</h1>
        </header>
<!--    header information being set up      -->
    </div>
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
    </div>
<!--   navigation bar being setup and made   -->
    			<?php
    			if($_SESSION['username'] == 'admin'){
//                 only opens menu if logged in
                	?>
        			<div class="row">
    				<main class="col-lg-10">
                	<h1 class="text">Unsubscribe user</h1>
                	<form action="UnSubadmin.php" method="POST">
                	  Name: <input type="text" name="name" id="name" maxlength="80" required><br>             
              	      Email: <input type="email" id="email" name="email" maxlength="150" required><br>
                    <input type="radio" id="news" name="subselect" value="news">
                    <label for="news">News</label><br>
                    <input type="radio" id="monthly" name="subselect" value="monthly">
                    <label for="monthly">Monthly</label><br>
                    <input type="radio" id="both" name="subselect" value="both" checked>
                    <label for="both">Both</label>
              	    <input type="submit">
            		</form>
                     <a href = "LogoutA.php" tite = "LogoutA"> logout.
                    </main>
                    </div>
            <!-- checks if logged in then brings up the fields for unsubbing a user  -->
            		<?php
            		}
                    else{
                        ?><H1>you are not logged in as an admin.</H1><?php
                    }
    				?>
                   
        </main>
<!--   this is the code for the input boxes and how they send to the specific page for using them   -->
    


</body>

</html>