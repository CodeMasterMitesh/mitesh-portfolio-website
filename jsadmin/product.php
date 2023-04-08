<div>
    <div class="page-header"> 
        <div class="page-title">  <h3>Products</h3> </div> 
        <a href="index.php?p=addproduct">
            <button class="btn" style="float: right;margin: 2px;" title="Add Product">
                <i class="icol-basket"></i> Add Product</button>
        </a> 
        
    </div>

    <div class="row"> 
        <div class="col-md-12"> 
            <div class="widget box"> 
                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools" id="example">
                        <thead>
                            <tr> 
                                <th>Sr. No.</th> 
                                <th>Name</th> 
                                <!-- <th>Price</th> -->
                                <!-- <th>Category</th> -->
                                <!-- <th>Code</th> -->
                                <th>Description</th>
                                <th>Status</th>
                                <th >Edit</th>
                                <th>Remove</th>
                            </tr> 
                        </thead>

                        <?php
                        $i = 1;
                        $sql = "select * from products";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                              
                                <td><?php echo $i++;?></td> 
                                <td><?php echo $r['name']; ?></td> 
                                <!-- <td><//?php echo $r['price']; ?></td>  -->
                                <!-- <td ><//?php 
                                $sql2 = "select * from category where id='".$r['category']."'";
                                $q2 = mysql_query($sql2);
                                $r2 = mysql_fetch_array($q2);
                                echo $r2['name'];
                                ?></td> -->
                                <!-- <td><//?php echo $r['code']; ?></td> -->
                                <td><?php echo $r['description']; ?></td>
                                <td> <span class="label label-success">Approved</span></td> 
                                <td><a href="index.php?p=editproduct&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="delete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
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