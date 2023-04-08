<div>
<div class="page-header" > 
    <div class="page-title"> <h3>Filters</h3> </div> 
    <a href="index.php?p=addfilters">
        <button class="btn" style="float: right;margin: 25px;" title="Add Filter">
            <i class="icol-basket"></i> Add Filter</button>
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
                                <th>Brand</th> 
                                <th>Price</th> 
                                <th>Operating System</th>
                                <th>Display</th>
                                <th>Storage Capacity</th>
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

                                    <td>1220</td> 
                                    <td >450</td>
                                    <td></td>
                                    <td><a href="index.php?p=editfilter&id=<?php echo $r['id']?>"><img src="images/file_edit.png"></a></td>
                               <td><a href="delete.php?id=<?php echo $r['id']?>"><img src="images/delete.png"></a></td>
                                </tr> 
                            </tbody>
                        <?php } ?>

                    </table> 
                </div> 
            </div> 
        </div>
</div> 
</div>