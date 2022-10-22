<?php
include_once("header.php");
include_once("connect.php");

if (isset($_POST['btnRegister'])) {
    $uname = $_POST['Username'];
    $pwd = md5($_POST['txtPass1']);
    $cpwd =  md5($_POST['txtPass2']);
    $fname = $_POST['CustName'];
    $gender = $_POST['grpRender'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $Address = $_POST['Address'];
    $date = $_POST['slDate'];
    $month = $_POST['slMonth'];
    $year = $_POST['slYear'];


    if ($pwd == $cpwd) {
		$sql = "SELECT * FROM customer WHERE email='$email'";
		$re = mysqli_query($conn, $sql);

        $sql1 = "SELECT Username FROM customer WHERE Username = '$uname'";
        $re1 = mysqli_query($conn, $sql1);

        if(mysqli_num_rows($re1)>0){
            echo "<script>alert('Oops! Username already exists.')</script>";
        } 
        else if (mysqli_num_rows($re) == 0) {
			$sql = "INSERT INTO `customer` (`Username`, `Password`, `CustName`, 
            `gender`, `Address`, `telephone`, `email`, `CusDate`, `CusMonth`, 
            `CusYear`, `ActiveCode`, `state`) VALUES ('$uname', '$pwd', '$fname', $gender, 
            '$Address', '$telephone', '$email', $date, $month, $year, '123', '1')";
			if (mysqli_query($conn, $sql)) {
				echo "<script>alert('User Registration Completed.')</script>";
				// header ("Location: login.php");
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

<div class="container regis">

    <form id="form-regis" name="form1" method="POST" class="form-horizontal was-validated" action="" role="form">
        <h2>Register</h2>
        <div class="input-group">

            <label for="txtTen" class="col-sm-2 control-label">Username(*): </label>
            <div class="col-sm-10">
                <input type="text" name="Username" id="Username" class="form-control" placeholder="Username" value="" required />
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>

        <div class="input-group">
            <label for="" class="col-sm-2 control-label">Password(*): </label>
            <div class="col-sm-10">
                <input type="password" name="txtPass1" id="txtPass1" class="form-control" placeholder="Password" required/>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>

        <div class="input-group">
            <label for="" class="col-sm-2 control-label">Confirm Password(*): </label>
            <div class="col-sm-10">
                <input type="password" name="txtPass2" id="txtPass2" class="form-control" placeholder="Confirm your Password" required/>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>

        <div class="input-group">
            <label for="lblFullName" class="col-sm-2 control-label">Customer name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="CustName" id="CustName" value="" class="form-control" placeholder="Enter Fullname" required/>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>

        <div class="input-group">
            <label for="lblGioiTinh" class="col-sm-2 control-label">Gender(*): </label>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="grpRender" value="0" id="grpRender" checked/>
                    Male</label>

                <label class="radio-inline"><input type="radio" name="grpRender" value="1" id="grpRender" />

                    Female</label>

            </div>
        </div>
        <div class="input-group">
            <label for="lblAddress" class="col-sm-2 control-label">Address(*): </label>
            <div class="col-sm-10">
                <input type="text" name="Address" id="Address" value="" class="form-control" placeholder="Address" required/>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>
        <div class="input-group">
            <label for="lblphone" class="col-sm-2 control-label">Phone(*): </label>
            <div class="col-sm-10">
                <input type="number" name="telephone" id="telephone" value="" class="form-control" placeholder="Telephone" required/>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>
        <div class="input-group">
            <label for="lblEmail" class="col-sm-2 control-label">Email(*): </label>
            <div class="col-sm-10">
                <input type="email" name="email" id="email" value="" class="form-control" placeholder="Email" required/>
                
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
        </div>

        <div class="input-group">
            <label for="lblNgaySinh" class="col-sm-2 control-label">Date of Birth(*): </label>
            <div class="col-sm-10 input-group">
                <!-- <input type="date" id="txtBirth" name="txtBirth">  -->
                <span class="input-group-btn">
                    <select name="slDate" id="slDate" class="form-control">
                        <option value="0">Choose Date</option>
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <span class="input-group-btn">
                    <select name="slMonth" id="slMonth" class="form-control">
                        <option value="0">Choose Month</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }

                        ?>
                    </select>
                </span>
                <span class="input-group-btn">
                    <select name="slYear" id="slYear" class="form-control">
                        <option value="0">Choose Year</option>
                        <?php
                        for ($i = 1970; $i <= 2020; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                </span>
            </div>
        </div>
        <p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
        <div class="input-group-btn">
            <input type="submit" class="btn btn-primary" name="btnRegister" id="btnRegister" value="Register" />
        </div>
    </form>
</div>