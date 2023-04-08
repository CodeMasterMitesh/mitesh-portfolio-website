<div>
    <div class="page-header">
        <div class="page-title"> <h3>Sitemap</h3> </div>
        <a href="index.php?p=addsitemap">
        <button class="btn" style="float: right;margin: 25px;" title="Add Sitemap">
            <i class="icol-basket"></i> Add Sitemap</button>
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
                                <th>Link</th> 
                                <th>Parent</th>
                                <!--<th>Status</th>-->
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $sql = "select * from news";
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
                                    <td><a href="index.php?p=editsitemap&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                    <td><a href="index.php?p=news&del=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                                </tr> 
                            <?php } ?>
                        </tbody>

                    </table> 
                </div> 
            </div> 
        </div> 
    </div>
</div>