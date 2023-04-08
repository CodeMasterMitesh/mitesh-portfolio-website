<?php
if ($_GET['del']) {
    $sql = "delete from orders where id='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    $sql = "delete from orderproducts where oid='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Order Deleted");window.location="index.php?p=orderstatus";</script>';
    }
}
?>
<div>
    <div class="page-header"> 
        <div class="page-title">  <h3>Order Status</h3> </div> 
        <a href="index.php?p=addorderstatus">
            <button class="btn" style="float: right;margin: 2px;" title="Add Product">
                <i class="icol-basket"></i> Add Status</button>
        </a>
    </div>



    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead>
                            <tr> 
                                <th>Processed</th> 
                                <th>Complete</th> 
                                <th>Open</th>
                                <th>Failed</th>

                                <th>Declined</th>
                                <th>Status</th>
                                <th >Edit</th>
                                <th>Remove</th>

                            </tr> 

                        </thead>

                         <?php
                            $sql = "select * from orders order by id desc";
                            $q = mysql_query($sql);
                            while ($r = mysql_fetch_array($q)) {
                                ?>
                            <tr> 
                              
                                <td><?php echo $r['eid']; ?> </td> 
                                <td><?php echo $r['orderstatus']; ?></td> 

         <!--<td><?php echo $r['id']; ?></td>--> 

                                <td><?php echo $r['price']; ?></td> 
                                <td ><?php echo $r['discountedprice']; ?></td>
                                <td>good</td>
                                <td> <span class="label label-success">Approved</span></td> 
                                <td><a href="index.php?p=editorderstatus&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="index.php?p=orderstatus&del<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        <?php } ?>


                    </table> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>
