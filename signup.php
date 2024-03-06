<?php
require("includes/header.php");
// redirect to index if already logged in
if (isset($_SESSION['login']) && isset($_SESSION['uid'])) {
    header("location:index.php");
} else {
    $flag = 0;
    // signup operation
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['fname'];
        $age = $_POST['age'];
        $address = $_POST['address'];

        $sql = "SELECT * FROM `user` WHERE `email`='$email'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $sql = "INSERT INTO `user`(`email`,`password`,`fname`,`age`,`address`) VALUES('$email','$password','$fname',$age,'$address');";
            $result = mysqli_query($con, $sql);
            header("location:login.php");
        } else {
            $flag = 1;
        }
    }
}
?>
<!-- signup form -->
<div class="container">
    <form class="m-4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fname">Full Name</label>
                <input type="text" name="fname" value="" class="form-control" id="fname" placeholder="Ram Kumar Das" required>
            </div>
            <div class="form-group col-md-6">
                <label for="age">Age</label>
                <input type="number" name="age" value="" class="form-control" id="age" placeholder="30" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" value="" class="form-control" id="email" placeholder="abc@abc.com" required>
                <?php
                if ($flag == 1) {
                    echo "<b> username already exists, please <a href='login.php'>login</a></b>";
                }
                ?>

            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" name="password" value="" class="form-control" id="inputPassword4" placeholder="Password" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" name="address" value="" class="form-control" id="inputAddress" placeholder="Coochbehar" required>
        </div>



        <button type="submit" name="submit" value="submit" class="btn btn-primary">Sign up</button>
        Existing user?<a href="login.php">login</a>
    </form>
</div>
<?php
require("includes/footer.php");
?>