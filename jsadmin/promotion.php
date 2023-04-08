<?php 
if (isset($_GET['del'])) {
    $sql = "delete from promotion where id='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Promotion Record Deleted.");window.location="index.php?p=promotion";</script>';
    }
}
?>

<div class="page-header" style="margin: 38px;"> <div class="page-title"> <h3>Promotions</h3> </div> 
    <h4 style="float: right;margin-top: 23px;">Add promotion</h4>
    <a href="index.php?p=addpromotion">
        <button class="btn" style="float: right;margin-top: 19px;margin-left: -66px;margin-right: 25px;" title="Add promotion">
            <i class="icol-basket">
            </i>
        </button>
    </a>
</div>
<div class="container">
    <div class="row"> <div class="col-md-12"> 
            <div class="widget box" style="margin-top: -46px;"> 
                <div class="widget-header">
                    <div class="toolbar no-padding" > <div class="btn-group">
                            <span class="btn btn-xs widget-collapse">
                                <i class="icon-angle-down"></i>
                            </span> 
                        </div> 
                    </div> 
                </div>
                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead> 
                            <tr> 
                                <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th>
                                <th>Name</th> 
                                <th>Description</th> 
                                <th>Available From</th>
                                <th>Available Till</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr> 
                        </thead>
                        <?php
                        $sql = "select * from promotion";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                                <td><?php echo $r['name']; ?></td> 
                                <td><?php echo $r['description']; ?></td> 
                                <td><?php echo $r['availablefromdate']; ?></td> 
                                <td><?php echo $r['availabletilldate']; ?></td> 
                                <td><?php echo $r['priority']; ?></td> 
                                <td><?php echo $r['status']; ?></td> 
                                <td><a href="index.php?p=editpromotion&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="index.php?p=promotion&del=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        <?php } ?>
                    </table> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>

<style>
    .DTTT_button_csv div{
        display: none !important;
    }
    .DTTT_button_copy div{
        display: none !important;
    }
    .DTTT_button_xls div{
        display: none !important;
    }
    .DTTT_button_pdf div{
        display: none !important;
    }
    </style>