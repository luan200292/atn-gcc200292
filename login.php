<?php
include_once("connect.php");
include_once("header.php");
//session
if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $pwd = md5($_POST['Password']);

    $sql = "SELECT * FROM customer WHERE email = '$email' and Password = '$pwd'";
    $re = mysqli_query($conn, $sql);

    if (mysqli_num_rows($re) > 0) {
        $row = mysqli_fetch_assoc($re);
        $_SESSION['user'] = $row['Username'];
        // $_SESSION['role'] = $row['Role'];
        if ($row['Username'] == "admin") {
            echo "<script> location.href = 'admin/index.php'</script>";
        } else {
            echo "<script> location.href = 'index.php'</script>";
        }
    } else {
        echo "<script>alert('Wrong username or password')</script>";
    }
}
?>

<!-- <body class="d-flex text-center" style="background: url(./img/backgr1.jpg);"> -->
<!-- <div class="login">
        <form class="form-login" method="POST" action="">
            <h1 class="h3 mb-3 font-weight-normal"> Login</h1>

            <div class="input-group">
                <label for="email" class="sr-only">Email</label>
                <input type="text" id="email" name="email" class="form-control mb-2" placeholder="Email" required autofocus>
            </div>

            <div class="input-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="Password" name="Password" class="form-control mb-2" placeholder="Password" required>
            </div>
            <p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="btnLogin">
                Login
            </button>
        </form>
    </div> -->
<!-- Optional JavaScript -->
<!-- Popper.js first, then Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script> -->

<section class="vh-50 gradient-custom">
    <div class="container py-5 h-70">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light text-dark" style="border-radius: 1rem; border: solid 1px black; ">
                    <div class="card-body p-5 text-center">

                        <form method="post">
                            <h1 class="h3 mb-3 font-weight-normal">LOGIN</h1>
                            <p class="text-black-50 mb-5">Please enter your username and password!</p>
                            <div class="form-outline form-white mb-2">
                                <input class="form-control" type="text" id="email" name="email" autocomplete="email"
                                    placeholder="Email" required autofocus>
                            </div>
                            <div class="form-outline form-white mb-2">
                                <input class="form-control" type="password" id="Password" name="Password"
                                    autocomplete="current-password" placeholder="Password" required>
                            </div>
                            <p class="small mb-3 pb-lg-2">Don't have an account?<a class="text-black-50"
                                    href="register.php"> Register here!</a></p>

                            <button class="btn btn-outline-dark btn-lg px-5" type="submit"
                                name="btnLogin">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once("footer.php");
?>