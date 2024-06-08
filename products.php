<?php
require 'header.php';
?>
    <h2>All our Products</h2>
    <a href="./create.php" class="badge badge-success">Add Products</a>
    <ul class="list-group">
    <?php
    
    $sql="SELECT * FROM products";
    $prepared = mysqli_query($dbc, $sql);
    $rowNum = mysqli_num_rows($prepared);

    if($rowNum > 0){
        foreach ($prepared as $row){?>
        <li id="<?= $row['p_id'];?>" class="list-group-item d-flex justify-content-between <?= $row['p_inStock'] ? 'bg-success' : ''?>">
            <a href="product.php?id=<?= $row['p_id']; ?>" class="<?= $row['p_inStock'] ? 'text-white' : ''?>">
                <?= $row['p_name'];?>
            </a>
            <span>
            <button name="delete" class="btn btn-danger">Delete</button>
            <a name="edit" href="edit.php?id=<?= $row['p_id']; ?>" class="btn btn-info">Edit</a>
            </span>
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