<?php
if (isset($_POST['submit'])) {
    $sql = "insert into shipping (`";
    foreach ($_FILES as $a => $b) {
        if (is_array($b['name'])) {
            $pa[] = $a;
            $b['name'] = array_unique(array_values(array_filter($b['name'])));
            $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
            for ($i = 0; $i < count($b['name']); $i++) {
                $b['name'][$i] = time() . '-' . $b['name'][$i];
                move_uploaded_file($b['tmp_name'][$i], 'files/' . $b['name'][$i]);
            }
            $pb[] = implode(',', $b['name']);
        } elseif (is_array($b)) {
            $pa[] = $a;
            
            $b['name'] = time() . '-' . $b['name'];
            move_uploaded_file($b['tmp_name'], 'files/' . $b['name']);
            $pb[] = $b['name'];
        }
    }
    foreach ($_POST as $a => $b) {
        if ($a != 'submit' && substr($a,0,3)!='pd_') {
            if (is_array($b)) {
                $pa[] = $a;
                unset($pb1);
                for ($i = 0; $i < count($b); $i++) {
                    $b[$i] = mysql_escape_string($b[$i]);
                    if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                        $pb1[] = dmy2mysql($b[$i]);
                    else
                        $pb1[] = $b[$i];
                }
                $pb[] = implode(',', $pb1);
            }
            else {
                $pa[] = $a;
                if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                    $pb[] = dmy2mysql($b);
                else
                    $pb[] = mysql_escape_string($b);
            }
        }
    }
    $sql.=implode('`,`', $pa) . "`) values('" . implode("','", $pb) . "')";
    $q = mysql_query($sql) or die(mysql_error());
     $pid = mysql_insert_id();
    if ($q) {
        $sql1 = "delete from  shipping_details where pid=" . $pid;
        $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);

        for ($i = 0; $i < count($_POST['pd_name']); $i++) {
            if ($_POST['pd_name'][$i]) {
                $sql1 = "insert into  shipping_details (`pid`,`name`,`value`)
                values('" . $pid . "','" . $_POST['pd_name'][$i] . "','" . $_POST['pd_value'][$i] . "')";
                $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
            }
        }
        echo "<script>alert('New shipping added');window.location='index.php?p=shipping';</script>";
    }
}
?>

<div class="page-header" > 
            <div class="page-title"> <h3>Shipping</h3> </div> 
            <a href="index.php?p=shipping">

            </a>
        </div> 

 <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate">
<div class="panel panel-default" style="vertical-align: top; ">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Shipping</a> </h3>
        </div>
       
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
            
                  <style>
                    .reports td:nth-child(3){
                        padding-left: 16px;
                    }
                </style>
                <table style="width: 100%;vertical-align: top;line-height: 46px; " class="reports">
                    <tr>
                        <td>
                           Name
                        </td>
                        <td>
                              <input type="text" name="name"  class="form-control required has-error discount" style="border-radius: 6px; "> 
                        </td>
                        
                        <td>
                           Help Url 
                        </td>
                      
                        <td>
                            <input type="text" name="helpurl"  class="form-control required has-error discount" style="border-radius: 6px; "> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Status
                        </td>
                        <td>
                            <select name="status" class="form-control required has-error discount" style="border-radius: 6px;">
                                <option>Active</option>
                                 <option>Inactive</option>
                                
                            </select>
                        </td>
                    </tr>
                </table>                
               

                    

            </div>
        </div>
    </div>

<div class="panel panel-default" style="vertical-align: top; ">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Shipping Detail</a> </h3>
        </div>
       
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="form-group" >
                                            <table style="width:100%" id="imgtable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Value</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input type="text" name="pd_name[]" value="<?php echo $r1['name']?>" class="form-control"  /></td>
                                                        <td><input type="text" name="pd_value[]" value="<?php echo $r1['value']?>" class="form-control"  /></td>
                                                        <td><img src="images/delete.png" onclick="if ($(this).parent().parent().parent().find('tr').size() != 1)
                                                                    $(this).parent().parent().remove()" /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <button><a href="#" onclick="$('#imgtable tbody').append($('#imgtable tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">+Add More</a></button>
                                        </div>
            
        </div>
    </div>

<!-- <div class="form-group" style="border-top:none;margin-left: 10px;">
                                                <button><a href="#" onclick="$('#content_qty_discounts table tbody ').append($('#content_qty_discounts table tbody tr:last').clone());" id="addmore" style="text-decoration: none;color:#000;">Add More</a></button>
                                            </div>-->

<div class="btn-bar btn-toolbar dropleft pull-right" style="margin-right: 10px;">

    <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit" value="Submit"/>

</div>
 </form>