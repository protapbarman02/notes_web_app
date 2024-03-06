<?php
require("includes/header.php");
?>
<img src="images/myacc_back.jpg" alt="" class="signup-background">

<?php
if (isset($_SESSION['login']) && isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];
    echo "<div class='details'>";
    $sql = "SELECT * FROM `user` WHERE `ID`=$id;";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo "<p class='fname'>welcome : </b>" . $row['fname'] . "</p>";
        echo "<p><b>Age : </b>" . $row['age'] . "</p>";
        echo "<p><b>Address : </b>" . $row['address'] . "</p>";
        echo "<p><b>Email : </b>" . $row['email'] . "</p>";
    }
    echo "<p><b>Total Notes</b> : " . $_SESSION['notecount'] . "</p>";
    echo "</div>";
?>
    <button class="btn btn-primary m-4">
        <a href="logout.php" class="text-white">logout</a>
    </button>

<?php
} else {
    header("location:login.php");
}
?>
<?php
require("includes/footer.php");
?>