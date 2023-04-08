
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Reports</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">

    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate">
        <div class="tab-content">


            <div class="tab-pane active" id="tab_1_1">

                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Coupon </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 


                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">

                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td>
                                                            <div class="form-group has-error" style="border:none;">
                                                                <label class="col-md-2 control-label">Start Date <span class="required">*</span></label> 
                                                                <div class="col-md-9"> 
                                                                    <input type="text" name="startdate" class="form-control required has-error datepicker" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group has-error" style="border:none;">
                                                                <label class="col-md-2 control-label">End Date <span class="required">*</span></label> 
                                                                <div class="col-md-9"> 
                                                                    <input type="text" name="enddate" class="form-control required has-error datepicker" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                                </div>
                                                            </div> 
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

    <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
    <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->

</div>


</form> 
<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Results</h3> </div> 
        <a href="index.php?p=addcoupon">
            <button class="btn" style="float: right;margin: 25px;" title="Add Coupon">
                <i class="icol-basket"></i> Add Coupon</button>
        </a>
    </div>



    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead> 
                            <tr> 
    <!--                          <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th>-->
                                <th>Product_id</th> 
                                <th>Name</th> 
                                <th class="hidden-xs">Code</th>
                                <th>Total ($)</th>
                                <th >Edit</th>
                                <th>Remove</th>

                            </tr> 

                        </thead>

                        <?php
                        if (isset($_POST['submit'])) {
                         echo   $sql2 = "select * from orders where datetime between '%" . $_POST['startdate'] . "%' and '%" . $_POST['enddate'] . "%'";
                            $q2 = mysql_query($sql2) or die(mysql_error());
                            while ($r2 = mysql_fetch_array($q2)) {
                                debug($r2);
                                //exit;
                                echo $sql1 = "select * from orderproducts where oid='" . $r2['id'] . "'";
                                $q1 = mysql_query($sql1) or die(mysql_error());
                                while ($r1 = mysql_fetch_array($q1)) {
                                    echo $sql = "select * from products where id='" . $r1['pid'] . "'";
                                    $q = mysql_query($sql) or die(mysql_error());
                                    while ($r = mysql_fetch_array($q)) {
                                debug($r);
                                exit;
                                        ?>
                                        <tr> 
                <!--                            <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>-->

                                            <td><?php echo $r['id']; ?> </td> 
                                            <td><?php echo $r['name']; ?></td> 

                                            <td><?php echo $r['code']; ?></td> 

                                            <td><?php echo $r1['amount']; ?></td> 
                                            <td><a href="index.php?p=editcoupon&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                            <td><a  href="delete.php?id=<?php echo $r['id'] ?>&del=yes"><img src="images/delete.png"></a></td>
                                        </tr> 
                                    <?php
                                    }
                                }
                            }
                        }
                        ?>


                    </table> 
                </div>
            </div> 
        </div> 
    </div> 
</div>
</div>

