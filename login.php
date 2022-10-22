<?php
include_once("connect.php");
session_start();

//session
if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $pwd = md5($_POST['Password']);

    $sql = "SELECT * FROM customer WHERE email = '$email' and Password = '$pwd'";
    $re = mysqli_query($conn, $sql);

    if (mysqli_num_rows($re) > 0) {
        $row = mysqli_fetch_assoc($re);
        $_SESSION['user'] = $row['Username'];
        if ($row['Username'] == "admin") {
            // echo "<script> location.href = './admin/index.php'</script>";
            header("Location: ./admin/index.php");
        } else {
            // echo "<script> location.href = './index.php'</script>";
            header("Location: ./index.php");
        }
    } else {
        echo "<script>alert('Wrong username or password')</script>";
    }
}
//cookie
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background-position: center;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-login {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .login {
            width: 30%;
            min-height: 400px;
            background: #FFF;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, .3);
            padding: 40px 30px;
        }

        div{
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <title>Login</title>
</head>

<body class="d-flex text-center" style="background: url(./img/backgr1.jpg);">
    <div class="login">
        <form class="form-login" method="POST" action="">
            <h1 class="h3 mb-3 font-weight-normal"> Login</h1>

            <div class="input-group">
                <!-- 'sr-only' will hide the text : 'Email Address'. So, 'Email Address' will be invisible -->
                <label for="email" class="sr-only">Email</label>
                <!-- 'autofocus' will highlight the input column initially -->
                <input type="text" id="email" name="email" class="form-control mb-2" placeholder="Email" required autofocus>
            </div>

            <div class="input-group">
                <!-- 'sr-only' will hide the text : 'Password'. So, 'Password' will be invisible -->
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="Password" name="Password" class="form-control mb-2" placeholder="Password" required>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
            <!-- 'btn-block' will make the button wider -->
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin">
                Login
            </button>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>