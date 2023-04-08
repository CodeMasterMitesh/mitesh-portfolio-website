<?php
if ($_GET['del']) {
    $sql = "delete from sales where id='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    $sql = "delete from salesitems where oid='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Order Deleted");window.location="index.php?p=orders";</script>';
    }
}
?>
<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Orders</h3> </div> 
    </div>  
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools" id="example">
                        <thead>  
                            <tr> 
                                <th></th>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th >Edit</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $sql = "select * from sales order by id desc";
                            $q = mysql_query($sql);
                            while ($r = mysql_fetch_array($q)) {
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $r['id'] ?> </td>
                                    <td><?php echo mysql2dmy($r['datetime']); ?></td>
                                    <td><?php echo $r['status'] ?> </td>

                                    <?php
                                    $sql1 = "select * from  clients where id='" . $r['cid'] . "'";
                                    $q1 = mysql_query($sql1);
                                    $r1 = mysql_fetch_assoc($q1);
                                    ?>
                                    <?php if($r1['name']) { ?>
                                    <td> <?php  echo $r1['name'] ?></td><?php }
                                    else if($r1['name']==NULL)
                                    {
                                    ?>
                                    <td>Guest</td>
                                    <?php
                                    }
                                    ?>
                                    <td> <?php echo $r['total'] ?></td>
                                    <td><a href="index.php?p=editorders&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                 </tr> 
                            <?php } ?>
                        </tbody>
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