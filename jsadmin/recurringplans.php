<div>
<div class="page-header" > 
    <div class="page-title"> <h3>Recurring plans</h3> </div> 
    <a href="index.php?p=addrecurringplans">
        <button class="btn" style="float: right;margin: 25px;" title="Add Recurringplans">
            <i class="icol-basket"></i> Add Recurringplans</button>
    </a>
</div>  
<div class="row"> 
    <div class="col-md-12"> 

        <div class="widget box"> 

            <div class="widget-content no-padding"> 
                <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                    <thead>  
                        <tr> 
                            <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th>
                            <th>Title</th>
                            <th>Recurring period</th>
                            <th>Status</th>
                            <th >Edit</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                        $sql = "select * from category";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                                <td><?php echo $r['id']; ?></td> 


                                <td><?php echo $r['name']; ?></td> 
                                <td></td>


                                <td><a href="index.php?p=editcategory&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="delete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        </tbody>
                    <?php } ?>



                </table> 
            </div> 
        </div> 
    </div>
</div> 
</div>