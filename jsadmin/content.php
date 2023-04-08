<div>
    <div class="page-header">
        <div class="page-title"> <h3>Content</h3> </div>
        <a href="index.php?p=addcontent">
        <button class="btn" style="float: right;margin: 25px;" title="Add Product">
            <i class="icol-basket"></i> Add Content</button>
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
                                <th>Name</th> 
                                <th>Pagelink</th> 
                                <th>Parent</th>
                                <!--<th>Status</th>-->
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $sql = "select * from pages";
                            $q = mysql_query($sql);
                            while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                                ?>
                                <tr> 
                                    <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                                    <td><?php echo $r['name']; ?></td>
                                    <td><?php echo $r['pagelink']; ?></td>
                                    <td><?php echo $r['parent']; ?></td>
                                    <!--<td><?php echo $r['status']; ?></td>-->
                                    <td><a href="index.php?p=editcontent&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                </tr> 
                            <?php } ?>
                        </tbody>

                    </table> 
                </div> 
            </div> 
        </div> 
    </div>
</div>