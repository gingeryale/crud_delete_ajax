<?php 
include 'header.php';

$userId = htmlspecialchars($_SESSION["userid"]) ?? null;
$result = mysqli_query($dbc, "SELECT * FROM users where u_id=$userId");
$row = mysqli_fetch_assoc($result);

?>

<?php if(isset($_SESSION["userid"])){?>
<h2>Profile page for </h2>

<table class="table table-responsive table-bordered border-primary mt-4">
    <thead>
    <tr>
        <td scope="col">Name</td>
        <td scope="col">Last name</td>
        <td scope="col">Email</td>
        <td>Profile pic</td>
    </tr>
    </thead>
    <tbody class="table-group-divider">
    <tr>
        <td scope="col"><?= $row['u_fname'];?></td>
        <td scope="col"><?= $row['u_lname']?></td>
        <td scope="col"><?= $row['u_email'];?></td>
        <td>
            <img src="uploads/<?= $row['u_pic'];?>" alt="profile image" style="width:100px">
        </td>
    </tr>
    </tbody>
    </table>
    <div class="mt-4">
       
        <a href="./profile_edit.php" class="btn btn-primary">Edit Profile</a>
    </div>
    <?php }?>

<?php 
include 'footer.php'
?>