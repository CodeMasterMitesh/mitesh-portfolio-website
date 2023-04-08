<div>
    <div class="page-header">
        <div class="page-title"> <h3>Option</h3> </div> 
        <a href="index.php?p=addoption">
            <button class="btn" style="float: right;margin: 25px;" title="Add Option">
                <i class="icol-basket"></i> Add Option</button>
        </a>
    </div>  
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead> 
                            <tr> 
                                <th>Option Id</th>
                                <th>Option Name</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $sql = "select * from options order by id desc";
                            $q = mysql_query($sql);
                            while ($r = mysql_fetch_array($q)) {
                                ?>
                                <tr> 
                                    <td><?php echo $r['id']; ?></td> 
                                       <td><?php echo $r['name']; ?></td> 



                                    <td><a href="index.php?p=editoption&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                    <td><a href="delete.php?id=<?php echo $r['id'] ?>&option=yes"><img src="images/delete.png"></a></td>
                                </tr> 
                            </tbody>
                        <?php } ?>

                    </table>
                </div> 
            </div> 
        </div>
    </div> 
</div>