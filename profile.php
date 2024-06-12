<?php 
include 'header.php'

?>

<?php if(isset($_SESSION["userid"])){?>
<h2>Profile page for </h2>

<table class="table table-responsive table-bordered border-primary">
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
        <td scope="col"><?= $_SESSION['userfname']?></td>
        <td scope="col"><?= $_SESSION['userlname']?></td>
        <td scope="col"><?= $_SESSION['useremail']?></td>
        <td>
            <img src="" alt="user profile pic">
        </td>
    </tr>
    </tbody>
    </table>
    <?php }?>

<?php 
include 'footer.php'
?>