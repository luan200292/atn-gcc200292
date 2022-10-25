<?php
include_once("connect.php");
include_once("header.php");

if (isset($_POST['btnRegister'])) {
    $uname = $_POST['Username'];
    $pwd = md5($_POST['txtPass1']);
    $cpwd =  md5($_POST['txtPass2']);
    $fname = $_POST['CustName'];
    $gender = $_POST['grpRender'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $Address = $_POST['Address'];
    $date = $_POST['ProDate'];


    if ($pwd == $cpwd) {
		$sql = "SELECT * FROM public.user WHERE email='$email'";
		$re = pg_query($connect, $sql);

        $sql1 = "SELECT username FROM public.user WHERE username = '$uname'";
        $re1 = pg_query($connect, $sql1);

        if(pg_num_rows($re1)>0){
            echo "<script>alert('Oops! Username already exists.')</script>";
        } 
        else if (pg_num_rows($re) == 0) {
			$sql = "INSERT INTO public.user (username, password, custname, gender, 
            address, phone, email, date) VALUES ('$uname', '$pwd', '$fname', $gender, 
            '$Address', $telephone, '$email', '$date')";
			if (pg_query($connect, $sql)) {
				echo "<script>alert('User Registration Completed.')</script>";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}
?>

<div class="container">
    <section class="vh-50 gradient-custom">
        <div class="container py-5 h-70">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-11 col-lg-10 col-xl-8">
                    <div class="card bg-light text-dark" style="border-radius: 1rem; border: solid 1px black;">
                        <div class="card-body p-5 text-center">
                            <form id="" name="form1" method="POST" action="" role="form">
                                <h1 class="h3 mb-3 font-weight-normal">REGISTER</h1>
                                <p class="text-black-50 mb-3">Please fill in the required information to register new
                                    account!</p>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="txtTen" class="col-sm-2 control-label">Username(*): </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Username" id="Username" class="form-control"
                                                placeholder="Username" value="" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Password(*): </label>
                                        <div class="col-sm-10">
                                            <input type="password" name="txtPass1" id="txtPass1" class="form-control"
                                                placeholder="Password" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="" class="col-sm-2 control-label">Confirm Password(*): </label>
                                        <div class="col-sm-10">
                                            <input type="password" name="txtPass2" id="txtPass2" class="form-control"
                                                placeholder="Confirm your Password" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="lblFullName" class="col-sm-2 control-label">Customer name(*):
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="CustName" id="CustName" value=""
                                                class="form-control" placeholder="Enter Fullname" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="lblGioiTinh" class="col-sm-2 control-label">Gender(*): </label>
                                        <div>
                                            <label class="radio-inline"><input type="radio" name="grpRender" value="0"
                                                    id="grpRender" checked />
                                                Male</label>
                                            <label class="radio-inline"><input type="radio" name="grpRender" value="1"
                                                    id="grpRender" />
                                                Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="lblAddress" class="col-sm-2 control-label">Address(*): </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="Address" id="Address" value="" class="form-control"
                                                placeholder="Address" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="lblphone" class="col-sm-2 control-label">Phone(*): </label>
                                        <div class="col-sm-10">
                                            <input type="text" name="telephone" id="telephone" value=""
                                                class="form-control" placeholder="Telephone" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="lblEmail" class="col-sm-2 control-label">Email(*): </label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" id="email" value="" class="form-control"
                                                placeholder="Email" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-outline form-white mb-2">
                                    <div class="input-group">
                                        <label for="first-name-vertical" class="col-sm-2 control-label">Date(*):
                                        </label>
                                        <div class="col-sm-10">
                                            <input id="ProDate" class="form-control" type="date" name="ProDate" value=""
                                                class="form-control" placeholder="mm/dd/yyyy" required />
                                        </div>
                                    </div>
                                </div>
                                <p class="login-register-text">Have an account? <a href="login.php"
                                        class="text-black-50">Login Here!</a></p>
                                <div class="input-group-btn">
                                    <input type="submit" class="btn btn-outline-dark btn-lg px-5" name="btnRegister"
                                        id="btnRegister" value="Register" />
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include_once("footer.php");
?>