<?php
if (isset($_POST['update'])) {
    $sql = "update sales set ";
    $dd = "";
    foreach ($_FILES as $a => $b) {
        if ($a != 'submit') {
            if (is_array($b['name'])) {
                $dd = '`' . $a . '`=';
                $b['name'] = array_unique(array_values(array_filter($b['name'])));
                $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
                for ($i = 0; $i < count($b['name']); $i++) {
                    $b['name'][$i] = time() . '-' . $b['name'][$i];
                    move_uploaded_file($b['tmp_name'][$i], 'files/' . $b['name'][$i]);
                }
                if ($_POST[$a][0]) {
                    unset($pb1);
                    for ($i = 0; $i < count($_POST[$a]); $i++) {
                        $pb1[] = mysql_escape_string($_POST[$a][$i]);
                    }
                    $dd.="'" . implode(',', $b['name']) . "," . implode(",", $pb1) . "'";
                } else
                    $dd.="'" . implode(',', $b['name']) . "'";
                $escape[] = $a;
            } elseif (is_array($b)) {
                $dd = '`' . $a . '`=';
                $b['name'] = time() . '-' . $b['name'];
                move_uploaded_file($b['tmp_name'], 'files/' . $b['name']);
                $dd.="'" . $b['name'] . "'";
                $escape[] = $a;
            }
            $pa[] = $dd;
        }
    }

    foreach ($_POST as $a => $b) {
        if ($a != 'update' && !in_array($a, $escape)) {
            $dd = "`" . $a . "`=";
            if (is_array($b)) {
                unset($pb1);
                for ($i = 0; $i < count($b); $i++) {
                    $b[$i] = mysql_escape_string($b[$i]);
                    if (strpos($a, "time") || strpos($a, "date") || $a == 'datetime')
                        $pb1[] = dmy2mysql($b[$i]);
                    else
                        $pb1[] = $b[$i];
                }
                $dd.="'" . implode(",", $pb1) . "'";
            }
            else {
                if (strpos($a, "time") || strpos($a, "date") || $a == 'datetime')
                    $dd.= "'" . dmy2mysql($b) . "'";
                else
                    $dd.= "'" . mysql_escape_string($b) . "'";
            }
        }
        $pa[] = $dd;
    }
   echo $sql.=implode(',', $pa) . " where id=" . $_GET['id'];
    // echo $sql;
    // exit;
    $q = mysql_query($sql) or die(mysql_error() . $sql);
    if ($q) {
         if($_POST['status']=='orderconfirm'){                                     
            $sql = "select * from  sales where id=" . $_GET['id'];
            $q = mysql_query($sql) or die(mysql_error() . $sql);
            $rdata = mysql_fetch_assoc($q);
            //debug($rdata);

            $sql7 = "select * from clients where id='" . $rdata['cid'] . "'";
            $q7 = mysql_query($sql7) or die(mysql_error() . $sql7);
            $client = mysql_fetch_assoc($q7);
            //debug($client);                     
            $_SESSION['edata'] = $_POST;
            $_SESSION['edata']['id'] = $pid;
            $subject = 'Welcome to S.P KNIT';
                                        $body = '<p><img alt="logo" src="http://spknit.com/images/logo.png" style="width:200px" /></p>

                                        <p>Hello ' . $client['name'] . ' </p>
                                        <p>Thank you for shopping at  <a href="http://www.spknit.com/">spknit.com</a>. This is a confirmation that we have received your order placed with the details below.</p>
                                        <br/><br/>
                                        <p>ORDER DATE: '. mysql2dmy($rdata['datetime']).' </p>
                                        <p>DELIVERY: STANDARD </p>
                                        <hr>
                                        <div class="col-md-4">
                                            <div class="list-group">
                                                <li class="list-group-item list-group-header"> 
                                                    <span class="">SHIPPING Detail</span> </li>
                                                <div class="well">

                                                    '.$rdata['name'].' <br/>
                                                    E: '.$rdata['billing_email'].'<br/>
                                                    M: '.$rdata['billing_telephone'].'<br/>
                                                    '. $rdata['billing_street1'].',
                                                    '. $rdata['billing_street2'].'<br/>
                                                    '. getcol('cities', 'id', $rdata['billing_city'], 'name').'<br/>
                                                   '. getcol('states', 'id', $rdata['billing_state'], 'name').'<br/>
                                                  '. getcol('countries', 'id', $rdata['billing_country'], 'name').'
                                                </div>
                                            </div> 

                                        </div>
                                        <hr><br/><br/>
                                        <table class="table table-middle" width="100%">
                                        <thead class="cm-first-sibling">
                                            <tr style="border:1px solid black">
                                                <th width="40%" class=" control-label" style="text-align:left;font-weight: normal;border-radius:">Products </th>
                                                <th width="25%" class=" control-label" style="text-align:left;font-weight: normal;">Rate</th>
                                                <th width="25%" class=" control-label" style="text-align:left;font-weight: normal;">Quantity</th>
                                                <th></th>
                                                <th width="20%" class=" control-label" style="text-align:left;font-weight: normal;">Price</th>
                                            </tr>
                                        </thead>
                                    
                                       <tbody>';
                                        
                                              $sql1 = "select * from salesitems where orderid='" . $_GET['id'] . "'";
                                                        $q1 = mysql_query($sql1) or die(mysql_error() . $sql);
                                                        while ($r = mysql_fetch_assoc($q1)) {
                                                      // debug($r);
                                                       $sq = "select * from products where id='" . $r['pid'] . "'";
                                                            $qu = mysql_query($sq) or die(mysql_error());
                                                            $rp = mysql_fetch_assoc($qu);
//                                                        debug($rp);./
                                                         
                                                          
                                                       
                                                  
                                                      $body .= '<tr class="table-row " id="box_add_qty_discount" style=border-bottom:1px solid black;>                                                                
                                                                <td>'.$rp['description'].'</td>
                                                                <td>'.$r['rate'].' </td>
                                                                <td>'.$r['qty'].'<td>
                                                                <td>'.$r['amount'].'</td> 
                                                            </tr>';
                                                            
                                                        }
                                                        

                                               $body .= ' </tbody>
                                               
                                                  <tfoot>';
                                                       $sql = "select * from  sales where id=" . $_GET['id'];
                                                        $q = mysql_query($sql) or die(mysql_error() . $sql);
                                                      $rdata = mysql_fetch_assoc($q);
                                                      
                                                       $body .= ' <tr>
                                                            <th colspan="2"></th>
                                                            <th>Subtotal</th>
                                                            <th>'. $rdata['subtotal'].'</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Shipping Charge</th>
                                                            <th>'. $rdata['shippingcharges'].'</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Tax</th>
                                                            <th>'. $rdata['totaltax'].'</th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Total</th>
                                                            <th>'. $rdata['subtotal']+$rdata['shippingcharges'].'</th>
                                                        </tr>
                                                        }
                                                    </tfoot>
                                        </table>
                                        </p>
                                              
                                        <a href="http://www.spknit.com/">http://www.spknit.com/</a><br />
                                        &nbsp;</p>
                                       ';
                                        $subject = "Confirmed Order";
                                        $to = $client['email'];
                                        smtpmailer($to,'online@spknit.com',$name,$subject,$body,true,'');
                                        //smtpmailer(' vidhi.jstechno@gmail.com ', 'info@spknit.com', 'admin', $subject, $body);
                                        //   exit;

                                                                      
                                                                 
                                        }else
                                        if($_POST['status']=='orderdispatch'){
                                                    $_SESSION['edata'] = $_POST;
                                                 $_SESSION['edata']['id'] = $pid;
                                                 $subject = 'Welcome to S.P KNIT';
                                                 $body = '<p><img alt="logo" src="http://spknit.com/images/logo.png" style="width:200px" /></p>

                                                 <p>Dear '.$client['name'].',</p>
                                                <p> We are pleased to confirm that the '. $r['name'].' which you ordered  ready for dispatch.</p>
                                                 <br /> 
                                                 <p>For help with any of our online services, please email the store-admin :&nbsp;<a href="info@spknit.com">info@spknit.com</a><br />
                                                <br />
                                                Sincerely,<br />
                                                <br />
                                                Paresh <br />
                                                Owner,Esspee<br />
                                                <br />                                               

                                                 ';
                                                 $subject = "Dispatched Order";

                                                 smtpmailer($to,'online@spknit.com',$name,$subject,$body,true,'');
                                                 //   exit;
                                        }
                                        else if($_POST['status']=='orderdelivered'){
                                                        $_SESSION['edata'] = $_POST;
                                                        $_SESSION['edata']['id'] = $pid;
                                                        $subject = 'Welcome to S.P KNIT';
                                                        $body = '<p><img alt="logo" src="http://spknit.com/images/logo.png" style="width:200px" /></p>

                                                        <p>We hereby acknowledge  receipt upon your order. We herewith send our invoice and a prepared contract in the  enclosed files. if you agree with the terms and conditions,please kindly return a signed copy of the contract.</p>
                                                   <p>We  assure you htat your order  will be  performed  to your  entire satisfaction.</p>
                                                        <p>For help with any of our online services, please email the store-admin :&nbsp;<a href="info@spknit.com">info@spknit.com</a><br />
                                                <br />
                                                Sincerely,<br />
                                                <br />
                                                Paresh <br />
                                                Owner,Esspee<br />
                                                <br />   

                                                        
                                                        ';
                                                        $subject = "Delivered Order";
                                                        
                                                        smtpmailer('online@spknit.com',$from,$name,$subject,$body,true,'');
                                                        //smtpmailer('vidhi.jstechno@gmail.com', 'info@spknit.com', 'admin', $subject, $body);
                                                        //   exit;

                                                }
        echo "<script>alert('Order Updated');window.location='index.php?p=orders'; </script>"; //window.location='index.php?p=searchproduct';
    }
}
$sql = "select * from  sales where id=" . $_GET['id'];
$q = mysql_query($sql) or die(mysql_error() . $sql);
$rdata = mysql_fetch_assoc($q);
//debug($rdata);
if ($_GET['del']) {   // when click on delete link this will be called and delete image from database
    $datadel = explode(',', $rdata[$_GET['del']]);
    $_GET['ids'] = $_GET['ids'] ? $_GET['ids'] : 0;
    unset($datadel[$_GET['ids']]);
    $sql = "update  sales set `" . $_GET['del'] . "`='" . implode(',', $datadel) . "' where id=" . $_GET['id'];
    $q = mysql_query($sql);
    echo "<script>alert('Product Updated'); window.location='index.php?p=editorders&id=" . $_GET['id'] . "';</script>";
}
//debug($rdata);
$sql7 = "select * from clients where id='" . $rdata['cid'] . "'";
$q7 = mysql_query($sql7) or die(mysql_error() . $sql7);
$client = mysql_fetch_assoc($q7);
//debug($client);
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Edit Orders 
        </h3>
    </div>
</div>

<div class="widget-content"> 
    <div class="row" style="margin-left: -8px;"> 
        <div class="col-md-4">
            <div class="list-group">
                <li class="list-group-item list-group-header"> 
                    <span class="">CUSTOMER Detail </span></li>
                <div class="well">
                    <?php echo $client['name']; ?><br/>
                    E: <?php echo $client['email']; ?><br/>
                    M: <?php echo $client['mobile']; ?>,<?php echo $client['phone']; ?><br/>
                    <?php echo $client['address']; ?><br/>
                    <?php echo getcol('cities', 'id', $client['city'], 'name'); ?><br/>
                    <?php echo getcol('states', 'id', $client['state'], 'name'); ?><br/>
                    <?php echo getcol('countries', 'id', $client['country'], 'name'); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="list-group">
                <li class="list-group-item list-group-header"> 
                    <span class="">SHIPPING Detail</span> </li>
                <div class="well">
                    
                    <?php echo $rdata['billing_firstname']; ?> <?php echo $rdata['billing_lastname']; ?><br/>
                    E: <?php echo $rdata['billing_email']; ?><br/>
                    M: <?php echo $rdata['billing_telephone']; ?><br/>
                    <?php echo $rdata['billing_street1']; ?>,
                    <?php echo $rdata['billing_street2']; ?><br/>
                    <!--<?php echo $rdata['billing_city']; ?><br/>
                    <?php echo $rdata['billing_state']; ?><br/>
                    <?php echo $rdata['billing_country']; ?><br/>-->
                    <?php echo getcol('cities', 'id', $rdata['billing_city'], 'name'); ?><br/>
                    <?php echo getcol('states', 'id', $rdata['billing_state'], 'name'); ?><br/>
                    <?php echo getcol('countries', 'id', $rdata['billing_country'], 'name'); ?>
                </div>
            </div> 

        </div>

        <div class="col-md-4">
            <div class="list-group">
                <li class="list-group-item list-group-header"> 
                    <span class="">Payment Detail</span> </li>
                <div class="well">
                    Order Date: <?php echo mysql2dmy($rdata['datetime']);?> 
                </div>
                
            </div>
        </div>
    </div>

    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" enctype="multipart/form-data">

        <div class="tab-content">
            <div class="" id="">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="" data-toggle="collapse" data-parent="" href="">Products  </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 


                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">

                                        <div class="form-group has-error" >

                                            <div id="content_qty_discounts">
                                                <table class="table table-middle" width="100%" >
                                                    <thead class="cm-first-sibling">
                                                        <tr><td>
                                                                    <select name="status" class="select1 " id="" >
                                                                            <option value="Pending" >Pending</option>
                                                                            <option value="orderconfirm">orderconfirm</option>
                                                                            <option value="orderdispatch">orderdispatch</option>
                                                                            <option value="orderdelivered">orderdelivered</option>
                                                                    </select>
                                                                </td>
                                                        </tr>      
                                                        <tr>
                                                            <th width="40%" class=" control-label" style="text-align:left;font-weight: normal;">Products </th>                                         
                                                            <th width="25%" class=" control-label" style="text-align:left;font-weight: normal;">Rate</th>
                                                            <th width="12.5%" class=" control-label" style="text-align:left;font-weight: normal;">Quantity</th>
                                                            <th width="12.5%" class=" control-label" style="text-align:left;font-weight: normal;">Size</th>
                                                            <th width="10%" class=" control-label" style="text-align:left;font-weight: normal;">Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                        $sql1 = "select * from salesitems where orderid='" . $_GET['id'] . "'";
                                                        $q1 = mysql_query($sql1) or die(mysql_error() . $sql);
                                                        while ($r = mysql_fetch_assoc($q1)) {
//                                                        debug($r);
                                                            $sq = "select * from products where id='" . $r['pid'] . "'";
                                                            $qu = mysql_query($sq) or die(mysql_error());
                                                            $rp = mysql_fetch_assoc($qu);
//                                                        debug($rp);
                                                            ?>
                                                       
                                                        
                                                            <tr class="table-row " id="box_add_qty_discount">
                                                                <td width="40%"><?php echo $rp['code']; ?>-<?php echo $rp['description']; ?><?php echo $rp['description']; ?></td>
                                                                <td width="25%"><?php echo $r['rate']; ?> </td>
                                                                <td width="12.5%"><?php echo $r['qty']; ?></td>
                                                                <td width="12.5%"><?php echo $r['size']; ?></td>
                                                                <td width="10%"><?php echo $r['amount']; ?></td> 
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Subtotal</th>
                                                            <th><?php echo $rdata['subtotal']; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Shipping Charge</th>
                                                            <th><?php echo $rdata['shippingcharges']; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Tax</th>
                                                            <th><?php echo $rdata['totaltax']; ?></th>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2"></th>
                                                            <th>Total</th>
                                                            <th><?php echo $rdata['subtotal']+$rdata['shippingcharges']; ?></th>
                                                        </tr>
                                                    </tfoot>
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

<div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">
    <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update" value="Update"/>
</div>
</form>
</div>
<script type="text/javascript">
    datas = Array();
<?php
foreach ($rdata as $a => $b) {
    // echo "$('input[name=\"".$a."\"]').val('".$b."');";
    // echo "$('select[name=\"".$a."\"] option[value=\"".$b."\"]').attr('selected','selected');";
    if (strpos($a, "date") || $a == "date" || strpos($a, "datetime") || $a == 'datetime')
        echo 'datas["' . $a . '"]="' . mysql2dmy($b) . '";';
    elseif ($a != 'description')
        echo 'datas["' . $a . '"]="' . mysql_escape_string($b) . '";';
}
?>
    $(document).ready(function () {
        $('#validate-1 input[type="text"]').each(function () {
            if (typeof datas[$(this).attr('name')] != 'undefined') {
                $(this).val(datas[$(this).attr('name')]);
            }
        });
        $('#validate-1 input[type="hidden"]').each(function () {
            if (typeof datas[$(this).attr('name')] != 'undefined') {
                $(this).val(datas[$(this).attr('name')]);
            }
        });
        $('#validate-1 textarea').each(function () {
            if (typeof $(this).attr('name') != 'undefined')
                $(this).html(datas[$(this).attr('name')]);
        });
        $('#validate-1 input[type="checkbox"]').each(function () {
            if ($(this).val() == datas[$(this).attr('name')]) {
                $(this).attr('checked', 'checked')
            }
        });
        $('#validate-1 input[type="radio"]').each(function () {
            if ($(this).val() == datas[$(this).attr('name')]) {
                $(this).attr('checked', 'checked')
            }
        });
        $('#validate-1 select').each(function () {
            $(this).find('option[value="' + $.trim(datas[$(this).attr('name')]) + '"]').attr('selected', 'selected');
        });
    });
</script>


<!--<script type="text/javascript">   
function getSelectedValue() {   
    var index = document.getElementById('mySelect').selectedIndex;   
    alert("value="+document.getElementById('mySelect').value);   
    alert("text="+document.getElementById('mySelect').options[index].text);   
}   
</script>-->




