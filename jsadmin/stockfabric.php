
<div>
    <div class="page-header"> 
        <div class="page-title">  <h3>Ready Stock Fabric</h3> </div> 
        <a href="index.php?p=addstockfabric">
            <button class="btn" style="float: right;margin: 2px;" title="Add Product">
                <i class="icol-basket"></i> Add Ready Stock Fabric Product</button>
        </a> 
        
    </div>

    <div class="row"> 
        <div class="col-md-12"> 
            <div class="widget box"> 
                <div class="widget-content no-padding" > 
                    <table class="table table-striped table-bordered table-hover table-checkable" id="example">
                        <thead>
                            <tr> 
                                <th class="text-center">Sr. No.</th> 
                                <th class="text-center">Image</th>
                                <th class="text-center">Name</th> 
                                <th class="text-center">Swatches card Price</th>
                                <th class="text-center">Meter Price</th>
                                <th class="text-center">KG Price</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Remove</th>
                            </tr> 
                        </thead>

                        <?php
                        $i = 1;
                        //$sql = "select * from products where sample=1";
                        $sql = "SELECT * FROM products WHERE sample=1 ORDER BY itemcode ASC";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
                        //debug($r);
                            ?>
                            <tr> 
                                <td><?php echo $i++;?></td> 
                                <td>
                                    <img src="../productimages/<?php echo $r['thumbnail']?>" width="100" height="100">
                                </td>
                                <td><?php echo $r['name']; ?></td>  
                                <td>
                                    <?php if($r['name'] != "Esspee Color Chart") { 
                                        echo $r['scprice']; 
                                    } else {
                                         echo "Price = ".$r['price'];
                                    } ?>
                                </td> 
                                <td><?php echo $r['meterprice']; ?></td>
                                <td><?php echo $r['kgprice']; ?></td> 
                                <td><a href="index.php?p=editstockfabric&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="stockfabric_delete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                                <!--<td><a href="index.php?p=editproduct&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="delete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>-->
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
        $(document).ready( function() {
            $('#example').dataTable( {
		 "iDisplayLength": -1,
		 "aLengthMenu": [[-1, 10, 25, 50], ["All", 10, 25, 50]]
            } );
	} );
   } );
</script>







