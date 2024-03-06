<?php
require("includes/header.php");
// if not logged in: redirect to login page 
if (!isset($_SESSION['login']) && !isset($_SESSION['uid'])) {
    header("location:login.php");
} else {
    $id = $_SESSION['uid'];
    //insert operation
    $insert = false;
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $note = $_POST['note'];
        $sql = "INSERT INTO `notes` (`uid`,`title`, `note`) VALUES ($id,'$title', '$note');";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $insert = true;
        }
    }
    //update operation
    $update = false;
    if (isset($_POST['update'])) {
        $nid = $_POST['editsno'];
        $title = $_POST['title'];
        $note = $_POST['note'];
        $sql = "UPDATE `notes` SET `title` = '$title', `note` = '$note' WHERE `nid` = $nid;";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $update = true;
        }
    }
    //delete operation
    $delete = false;
    if (isset($_GET['delete'])) {
        $nid = $_GET['deletesno'];
        $sql = "DELETE FROM `notes` WHERE `nid` = $nid;";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $delete = true;
        }
    }
}
?>
<img src="images/index_back.jpg" alt="" class="index-background">
<!-- update popup -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="editsno">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" id="edittitle" name="title" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Note</label>
                        <textarea class="form-control" id="editnote" name="note" value="" id="exampleFormControlTextarea1" rows="3" placeholder="write..." required></textarea>
                    </div>
                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-block">
                </form>
                <button type="button" class="btn btn-secondary btn-block mt-2" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- delete pop up -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="deletesno">
                    <p class="text-center">Do you want to delete ? </p>
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-block">
                </form>
                <button type="button" class="btn btn-secondary btn-block mt-2" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php
// alert when note added
if ($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Note added succesfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
}
// alert when note updateded
if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Note updated succesfully
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
}
// alert when note deleted
if ($delete) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> Note deleted
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
}

?>
<!-- add note form -->
<div class="container mt-2">
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" name="title" value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="title">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Note</label>
            <textarea class="form-control" name="note" value="" id="exampleFormControlTextarea1" rows="3" placeholder="write..." required></textarea>
        </div>
        <input type="submit" name="submit" value="Add Note" class="btn btn-primary">
    </form>
</div>

<!-- display notes -->
<div class="container my-4">
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">sno</th>
                <th scope="col">Title</th>
                <th scope="col">Note</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `notes` where `uid`=$id;";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            $sno = 0;
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno += 1;
                    $nid = $row['nid'];
                    echo "<tr>
                        <th scope='row'>" . $sno . "</th>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['note'] . "</td>
                        <td>
                            <button class='btn btn-primary edit' id='$nid' data-toggle='modal' data-target='#editmodal'>Update</button>
                            <button class='btn btn-primary delete' id='$nid' data-toggle='modal' data-target='#deletemodal'>Delete</button>
                        </td>
                        </tr>";
                }
            }
            //for my account page, shown total note count
            $_SESSION['notecount'] = $sno;
            ?>
        </tbody>
    </table>
</div>
<script>
    //mapping of edit button and populating edit modal on specific note id
    let edit = document.getElementsByClassName('edit');
    Array.from(edit).forEach((e) => {
        e.addEventListener("click", (obj) => {
            let tr = obj.target.parentNode.parentNode;
            let title = tr.getElementsByTagName('td')[0].innerText;
            let note = tr.getElementsByTagName('td')[1].innerText;
            document.getElementById('edittitle').value = title;
            document.getElementById('editnote').value = note;
            let editsno = document.getElementsByName('editsno')[0];
            editsno.value = obj.target.id;
        })
    })
    
    //mapping of delete button for delete operation
    let del = document.getElementsByClassName('delete');
    Array.from(del).forEach((e) => {
        e.addEventListener("click", (obj) => {
            let deletesno = document.getElementsByName('deletesno')[0];
            deletesno.value = obj.target.id;
        })
    })
</script>

<?php
require("includes/footer.php");
?>
