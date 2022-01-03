<!DOCTYPE html>
<?php require_once("conscrip.php")?>
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
                <h1 class="col-lg-10 text-center">Signin page</h1>
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
                <li><a href="review.html">rate a movie</a></li>
            </ul>
        </nav>
    </div>
<!--   navigation bar being setup and made   -->
                 <?php if ($_SESSION['username'] == ''){
// only opens login if not logged in
					?>
                <div class = "container form-signin">
                <h1>Enter Admin Username and Password</h1>
                <?php
                    $msg = '';

                    if (isset($_POST['login']) && !empty($_POST['username']) 
                        && !empty($_POST['password'])) {
                        
                        $command = $pdo->prepare("SELECT * FROM `users`");
                        $command -> execute();
                        $results = $command->fetchAll();
                        $logcheck = "no";
                        foreach ($results as $result){
                        if ($_POST['username'] == $result['name'] && 
                            $_POST['password'] == $result['password']) {
                            $_SESSION['valid'] = true;
                            $_SESSION['timeout'] = time();
                            $_SESSION['username'] = $result['group'];
                            $logcheck = "yes";

                            echo 'You have entered the correct username and password';
                        	header("Refresh:0");
                            }
                        }
                        if ($logcheck == "no") {
                            $msg = 'Wrong username or password';
                        }
                    }
				
                ?>
                </div> <!-- core setup for the login system -->

                <div class = "container">

                <form class = "form-signin" role = "form" 
                    action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
                    ?>" method = "post">
                    <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
                    <input type = "text" class = "form-control" 
                        name = "username" placeholder = "username" 
                        required autofocus></br>
                    <input type = "password" class = "form-control"
                        name = "password" placeholder = "password" required>
                    <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
                        name = "login">Login</button>
                </form>
				</div>
                <?php
                 }else{
                 ?>
<!--   the actual container for the login   -->
        			 <div>
            		</form>
					<?php $mess = "you are logged in as a " . $_SESSION['username'] ?>
					<h1><?php echo $mess ?></h1>
                     <a href = "LogoutA.php" tite = "LogoutA"> logout.
                    </main>
                    </div>
                    <?php
                 }
                 ?>
                   
        </main>
<!--   this is the code for the input boxes and how they send to the specific page for using them   -->
    


</body>

</html>