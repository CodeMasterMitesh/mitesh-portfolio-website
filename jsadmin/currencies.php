<?php

if($_GET['del']){
$sql="delete from currency where id='".$_GET['del']."'";
$q=  mysql_query($sql) or die(mysql_error());
if($q){
    echo '<script>alert("Currency Deleted");window.location="index.php?p=currencies";</script>';
}
}
?>
<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Currencies</h3> </div> 
         <a href="index.php?p=addcurrencies">
            <button class="btn" style="float: right;margin: 25px;" title="Add currencies">
                <i class="icol-basket"></i> Add Currencies</button>
        </a>
    </div>  
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead>  
                            <tr> 
                                <th>Date</th>
                                <th>1 USD = </th>
                                
                                <th >Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "select * from currency";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                                <td><?php echo mysql2dmy($r['date']); ?></td> 
                                <td><?php echo $r['inr']; ?> INR</td> 
                                <td><a href="index.php?p=editcurrencies&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="index.php?p=currencies&del=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        <?php } ?>
                            
                        </tbody>
                    </table>
                </div> 
            </div>
        </div> 
    </div> 
</div>