<?php
include_once("connect.php");
include_once("header.php");
//session
if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $pwd = md5($_POST['Password']);

    $sql = "SELECT * FROM public.user WHERE email = '$email' and password = '$pwd'";
    $re = pg_query($connect, $sql);

    if (pg_num_rows($re) > 0) {
        $row = pg_fetch_assoc($re);
        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == "admin") {
            echo "<script> location.href = 'admin/index.php'</script>";
        } else {
            echo "<script> location.href = 'index.php'</script>";
        }
    } else {
        echo "<script>alert('Wrong username or password')</script>";
    }
}
?>

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