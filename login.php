<?php
require("includes/header.php");
?>
<?php
$flag = 0;
if (isset($_SESSION['login']) && isset($_SESSION['uid'])) {
    header("location:index.php");
} else {
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $_SESSION['login'] = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION['uid'] = $row['id'];
            }
            header("location:index.php");
        } else {
            $flag = 1;
        }
    }
}
?>
    <div class="container">
        <form class="m-4" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" value="" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                <?php
                if ($flag == 1) {
                    echo "<p><b><a href='signup.php'>new user? Signup</a></b></p>";
                }
                ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" value="" class="form-control" id="password" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-primary">login</button>
            <button class="btn btn-primary">
                <a href="signup.php" class="text-white">Sign up</a>
            </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquslimery-3.2.1..min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <?php
    require("includes/footer.php");
    ?>