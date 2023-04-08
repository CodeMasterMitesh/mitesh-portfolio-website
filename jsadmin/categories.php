<div>
    <div class="page-header" s>
        <div class="page-title">
            <h3>Categories</h3>
        </div>

        <a href="index.php?p=addcategory">
            <button class="btn" style="float: right;margin: 25px;" title="Add Product">
                <i class="icol-basket"></i> Add Category</button>
        </a>

    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="widget box">

                <div class="widget-content no-padding">
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools"
                        id="example">
                        <thead>
                            <tr>
                                <!-- <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th> -->
                                <th>Id.</th>
                                <th>Product Name</th>
                                <!-- <th>Name</th> -->
                                <th>Parameters</th>
                                <th>Name Tag</th>

                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "select * from category";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
                            //                    debug($r);
                        ?>
                        <tr>
                            <!-- <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td> -->
                            <td>
                                <?php echo $r['id']; ?>
                            </td>
                            <td><?php echo $r['name']; ?></td>
                            <!-- <td>
                                <? //php echo $r['name']; 
                                ?>
                            </td> -->

                            <td><?php echo $r['parameters']; ?></td>
                            <td><?php echo $r['tag']; ?></td>

                            <td><a href="index.php?p=editcategory&id=<?php echo $r['id'] ?>"><img
                                        src="images/file_edit.png"></a></td>
                            <td><a href="delete1.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                        </tr>
                        <?php } ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $(document).ready(function() {
        $('#example').dataTable({
            "iDisplayLength": -1,
            "aLengthMenu": [
                [-1, 10, 25, 50],
                ["All", 10, 25, 50]
            ]
        });
    });
});
</script>