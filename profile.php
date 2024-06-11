<?php 
include 'header.php'

?>

<?php if(isset($_SESSION["userid"])){?>
<h2>Profile page for </h2>

<table class="table table-responsive">
    <tr>
        <td>Name</td>
        <td>Last name</td>
        <td>Email</td>
    </tr>
    <tr>
        <td><?= $_SESSION['userfname']?></td>
        <td><?= $_SESSION['userlname']?></td>
        <td><?= $_SESSION['useremail']?></td>
    </tr>
</table>
    <?php }?>

<?php 
include 'footer.php'
?>