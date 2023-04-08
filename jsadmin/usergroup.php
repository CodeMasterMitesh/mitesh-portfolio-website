<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Usergroups</h3> </div> 
        <a href="index.php?p=addusergroup">
            <button class="btn" style="float: right;margin: 25px;" title="Add Usergroup">
                <i class="icol-basket"></i> Add Usergroup</button>
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
                                <th>Usergroup</th> 
                                <th>Type</th> 
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr> 

                        </thead>

                        <?php
                        $sql = "select * from customers";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>

                                <td><?php echo $r['id']; ?></td> 
                                <td><?php echo $r['name']; ?></td> 

                                <td> <span class="label label-success">Approved</span></td> 
                                <td><a href="index.php?p=editusergroup&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="usergroupdelete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        <?php } ?>




                    </table> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>