<div>
    <div class="page-header">
        <div class="page-title">
            <h3>Blog</h3>
        </div>
        <a href="index.php?p=addblog">
            <button class="btn" style="float: right;margin: 25px;" title="Add Blog">
                <i class="icol-basket"></i> Add Blog</button>
        </a>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="widget box">

                <div class="widget-content no-padding">
                    <table
                        class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead>
                            <tr>
                                <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th>
                                <th>Name</th>
                                <!--                                <th>Link</th> -->
                                <th>Description</th>
                                <th>Start date</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $sql = "select * from blog";
                            $q = mysql_query($sql);
                            while ($r = mysql_fetch_array($q)) {
                                //                    debug($r);
                            ?>
                            <tr>
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                                <td><?php echo $r['name']; ?></td>
                                <!--<td><?php // echo $r['pagelink']; 
                                            ?></td>-->
                                <td><?php echo $r['description']; ?></td>
                                <td><?php echo mysql2dmy($r['startdate']); ?></td>
                                <td><a href="index.php?p=editblog&id=<?php echo $r['id'] ?>"><img
                                            src="images/file_edit.png"></a></td>
                                <td><a href="dele.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>