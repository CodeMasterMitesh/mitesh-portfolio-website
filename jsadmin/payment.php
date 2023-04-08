<?php 
if ($_GET['del']) {
    $sql = "delete from payments where id='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    $sql = "delete from payment_details where pid='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Payment Deleted");window.location="index.php?p=payment";</script>';
    }
}
?>
<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Payment</h3> </div> 
        <a href="index.php?p=addpayment">
            <button class="btn" style="float: right;margin: 25px;" title="Add Order">
                <i class="icol-basket"></i>Add Payment</button>
        </a>
    </div>  
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead>  
                            <tr> 
                                
                                <th>Name</th>
                                <th>HelpUrl</th>
                                <th>Status</th>
                                
                                <th >Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $sql = "select * from payments order by id desc";
                            $q = mysql_query($sql);
                            while ($r = mysql_fetch_array($q)) {
                                ?>
                                <tr>
                                    
                                    <td><?php echo $r['name'] ?> </td>
                                    <td><?php echo $r['helpurl']; ?></td>
                                    <td><?php echo $r['status'] ?> </td>

                                  
                                    <td><a href="index.php?p=editpayment&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                    <td><a href="index.php?p=payment&del=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                                </tr> 
                            <?php } ?>
                        </tbody>
                    </table>
                </div> 
            </div>
        </div> 
    </div> 
</div>