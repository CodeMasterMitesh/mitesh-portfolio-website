

<div class="page-header" > 
    <div class="page-title"> <h3>Sales Reports</h3> </div> 

</div>

<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">Products Sales</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Orders Status</a></li>
        <li class=""><a href="#tab_1_3" data-toggle="tab">Shipping Status</a></li>

    </ul>


    <div class="tab-content">
        <div class="tab-pane active" id="tab_1_1">

            <div class="widget">
                <div class="widget-content">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="margin-left: -5px;">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href=""> Products Sales </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 


                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">

                                            <style>
                                                .tables td:nth-child(3)
                                                {
                                                    padding: 10px;
                                                }
                                            </style>
                                            <form action="" method="post" enctype="multipart/form-data">
                                            <table style="width: 100%; " class="tables">
                                                <tr>
                                                    <td>
                                                        Start Date
                                                    </td>
                                                    <td>
                                                        <input type="text" name="startdate"  class="form-control required has-error datepicker" style="border-radius: 6px;width: 73%;">
                                                    </td>

                                                    <td>
                                                        End Date
                                                    </td>
                                                    <td>
                                                        <input type="text"  name="enddate" class="form-control required has-error datepicker" style="border-radius: 6px; width: 73%;"> 
                                                    </td>
                                                </tr>
                                            </table>


                                            <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

                                                 <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="productsales" value="Submit"/>

                                            </div>
                                            </form>


                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>



                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="">Reports </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 


                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">


                                            <table  class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                                                <thead>  
                                                    <tr> <td>Image</td>
                                                        <td>Product Name</td>
                                                        <td>price</td>
                                                        <td>Discounted price</td>
                                                        <td>Category</td>
                                                        
                                                </thead>
                                                <?php 
                                                if(isset($_POST['productsales']))
                                                {
                                                $sqll="select * from  orders where datetime between '".dmy2mysql($_POST['startdate'])."'and '".dmy2mysql($_POST['enddate'])."' " ;
                                                    $qq=  mysql_query($sqll) or die(mysql_error());
                                                    while($rr=  mysql_fetch_assoc($qq))
                                                    {
                                                       
                                                       $sql_1="select * from orderproducts where oid ='".$rr['id']."'"; 
                                                       $qq_1=mysql_query($sql_1) or die(mysql_error());
                                                      while($rr_1=  mysql_fetch_assoc($qq_1)){
                                                     
                                                       $sql_11="select * from products where id='".$rr_1['pid']."'";
                                                       $qq_11=  mysql_query($sql_11) or die(mysql_error());
                                                       while($rr_11=  mysql_fetch_assoc($qq_11)){
                                                     
                                                       ?>
                                                <tr>
                                                    <td><img src="<?php echo $adminpath.$rr_11['image']; ?>"></td>
                                                  <td><?php echo $rr_11['name']; ?></td>
                                                    <td><?php echo $rr_11['price']; ?></td>
                                                      <td><?php echo $rr_11['discountedprice']; ?></td>
                                                      
                                                      <?php $sql4="select * from category where id='".$rr_11['subcatid']."'";
                                                            $qqq=  mysql_fetch_assoc($sql4);
                                                            while($rrr=  mysql_fetch_assoc($qqq))
                                                            {
                                                                
                                                            
                                                      ?>
                                                        <td> <?php echo $rrr['name']; ?> </td>
                                                         
                                                </tr>
                                                <?php
                                                       
                                                    }}}}
                                                }
                                                        ?>
                                               
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
        <div class="tab-pane" id="tab_1_2">

            <div class="widget">
                <!--                <div class="widget-header">
                                    <h4><i class="icon-reorder"></i> Accordion</h4>
                                    <div class="toolbar">
                                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                                    </div>
                                </div>-->

                <div class="panel panel-default">
                    <div class="panel-heading toolbar">
                        <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href=""> Order status  </a> </h3>
                        <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body"> 


                            <div class="widget box" style="border:none;">
                                <div class="widget-content">

                                    <style>
                                        .tables td:nth-child(3)
                                        {
                                            padding: 10px;
                                        }
                                    </style>

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <table style="width: 100%; " class="tables">
                                            <tr>
                                                <td>
                                                    Start Date
                                                </td>
                                                <td>
                                                    <input type="text" name="startdate"  class="form-control required has-error datepicker" style="border-radius: 6px;width: 73%;">
                                                </td>

                                                <td>
                                                    End Date
                                                </td>
                                                <td>
                                                    <input type="text"  name="enddate" class="form-control required has-error datepicker" style="border-radius: 6px; width: 73%;"> 
                                                </td>
                                            </tr>
                                        </table>



                                        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

                                            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="order" value="Submit"/>

                                        </div>

                                    </form>



                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="panel panel-default ">
                    <div class="panel-heading ">
                        <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Order Status Reports  </a> </h3>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body"> 


                            <div class="widget box" style="border:none;">
                                <div class="widget-content">
                                    <table  class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                                        <thead>  
                                            <tr> 
                                                <td>Customer Name</td>
                                                <td>Billing Name</td>
                                                <td>Address</td>
                                                <td>Email</td>
                                                <td>Contact Number</td>
                                                <td>City</td>
                                                <td>State</td>
                                                <td>Order Status</td>
                                            </tr>
                                        </thead>

                                        <?php
                                        if (isset($_POST['order'])) {

                                            $sql = "select * from  orders where datetime between '" . dmy2mysql($_POST['startdate']) . "' and '" . dmy2mysql($_POST['enddate']) . "'";
                                            $q = mysql_query($sql);
                                            while ($r = mysql_fetch_assoc($q)) {
                                                ?>


                                                <tr>

                                                    <?php
                                                    $sql1 = "select * from  customers where id='" . $r['eid'] . "'";
                                                    $q1 = mysql_query($sql1);
                                                    $r1 = mysql_fetch_assoc($q1);
                                                    ?>
                                                    <?php if ($r1['name']) { ?>
                                                        <td> <?php echo $r1['name'] ?></td><?php
                                        } else if ($r1['name'] == NULL) {
                                                        ?>
                                                        <td>Guest</td>
                                                        <?php
                                                    }
                                                    ?>


                                                    <td><?php echo $r['billing_firstname'] . " " . $r['billing_lastname']; ?></td>
                                                    <td><?php echo $r['billing_address1	']; ?></td>
                                                    <td><?php echo $r['billing_email']; ?></td>
                                                    <td><?php echo $r['billing_telephone']; ?></td>
                                                    <td><?php echo $r['billing_city'] ?></td>
                                                    <td><?php echo $r['billing_state'] ?></td>
                                                    <td><?php echo $r['orderstatus']; ?></td>
                                                </tr>
                                                <?php
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

        </div>
        <div class="tab-pane" id="tab_1_3">

            <div class="widget">
                <!--                <div class="widget-header">
                                    <h4><i class="icon-reorder"></i> Accordion</h4>
                                    <div class="toolbar">
                                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                                    </div>
                                </div>-->

                <div class="panel panel-default">
                    <div class="panel-heading toolbar">
                        <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href=""> Order Status  </a> </h3>
                        <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body"> 



                            <style>
                                .tables td:nth-child(3)
                                {
                                    padding: 10px;
                                }
                            </style>
                            <table style="width: 100%; " class="tables">
                                <tr>
                                    <td>
                                        Start Date
                                    </td>
                                    <td>
                                        <input type="text" name="startdate"  class="form-control required has-error datepicker" style="border-radius: 6px;width: 73%;">
                                    </td>

                                    <td>
                                        End Date
                                    </td>
                                    <td>
                                        <input type="text"  name="enddate" class="form-control required has-error datepicker" style="border-radius: 6px; width: 73%;"> 
                                    </td>
                                </tr>
                            </table>


                            <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

                                <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="productsales" value="Submit"/>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
