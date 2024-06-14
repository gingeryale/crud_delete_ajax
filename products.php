<?php
require 'header.php';
?>
    <h2>All our Products</h2>
<?   if(isset($_SESSION["userid"])){?>
    <a href="./create.php" class="m-4 btn btn-primary">Add Products</a>
    <? } ?>
    <ul class="m-4 list-group border-primary border-2">
    <?php
    
    $sql="SELECT * FROM products";
    $prepared = mysqli_query($dbc, $sql);
    $rowNum = mysqli_num_rows($prepared);

    if($rowNum > 0){
        foreach ($prepared as $row){?>
        <li id="<?= $row['p_id'];?>" class="list-group-item d-flex justify-content-between <?= $row['p_inStock'] ? 'bg-success-subtle' : ''?>">
            <a href="product.php?id=<?= $row['p_id']; ?>" class="<?= $row['p_inStock'] ? 'text-dark' : ''?>">
                <?= $row['p_name'];?>
            </a>
            <?php if(isset($_SESSION["userid"])){?>
            <span>
            <button name="delete" class="btn btn-danger">Delete</button>
            <a name="edit" href="edit.php?id=<?= $row['p_id']; ?>" class="btn btn-light border">Edit</a>
            </span>
            <?php } ?>
        </li>
        <?php }
    }
    ?>
</ul>
<script>
$('button[name="delete"]').click(function(){
    let pid = $(this).parents('li').attr( "id" );
    console.log(pid);
    $.ajax({
    method:"POST",
    url:"delete.php",
    data:{id:pid},
    success:function(data){
        window.location.href = './products.php'; 
    }
})
})

    </script>

<?php
require 'footer.php';
?>