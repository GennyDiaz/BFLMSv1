<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylelogin.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/notify/jquery.jnotify.css" media="all">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/cdnjs/jquery.jnotify.min.js"></script>
</head>
<body>
    <div class="background"></div>
    <div class="login">
        <h1 class="text-center">Admin Login</h1>
        <form class="needs-validation" method="post">
            <div class="form-group was-validated">
                <label class="form-label" for="username">Username</label>
                <input class="form-control" type="text" id="username" name="username" required>
                <div class="invalid-feedback">
                    Please enter your username!
                </div>
            </div>
            <div class="form-group was-validated">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
                <div class="invalid-feedback">
                    Please enter your password!
                </div>
            </div>
            <div class="form-group form-check">
                <input class="form-check-input" type="checkbox" id="check">
                <label class="form-check-label" for="check">Remember me</label>
            </div>
                <input class="btn btn-success w-40" type="submit" value="Submit">
                <input class="btn btn-back w-40" type="submit" onclick="goBack()" value="Back">
        </form>
        <?php
        include ('connection.php');
        session_destroy();
        if(isset($_SESSION['error_login'])){
            echo "<script>

            $.jnotify('".$_SESSION['error_login']."','error',{
                autoHide: true,
                clickOverlay: false,
                minWidth: 250,
                timeShown: 3000
            });
            
            localStorage.clear();
            </script>
                ";
        }
        ?>
    </div>
    <script>
        localStorage.clear()
        function goBack(){
            window.location.href = "index.php";
        }
    </script>
</body>
</html>