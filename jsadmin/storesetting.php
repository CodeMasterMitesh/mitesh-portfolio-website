<?php
if (isset($_POST['save'])) {
    foreach($_POST as $a=>$b)
    {
        if($a!='save'){
        $sql="replace into settings (`name`,`value`) values('".$a."','".$b."')";        
        $q = mysql_query($sql) or die(mysql_error().$sql);
        }
    }
    if ($q)
        echo "<script>alert('Setting saved');window.location='index.php?p=storesetting';</script>";
}
function  getdata($name)
{
    $sql1="select * from settings where name like '".$name."'";
    $q1= mysql_query($sql1) or die(mysql_error().$sql1);    
    $r=  mysql_fetch_assoc($q1);
     return $r['value'];   
}
//    $sql1="select * from settings where name like 'ship_%'";
//    $q1= mysql_query($sql1) or die(mysql_error().$sql1);    
//    while($r=  mysql_fetch_assoc($q1)){
//        debug($r);
//    }

?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3> 
            Settings: Stores</h3>
    </div>
</div>

<div class="tab-pane active" id="tab_1_1">

    <div class="widget">
        <div class="widget-content">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default" style="margin-left: -5px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Store settings</a> </h3>
                    </div>
                    <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                        <div class="panel-body"> 


                            <div class="widget box" style="border:none;">
                                <div class="widget-content">
                                    <style>
                                        .tables td:nth-child(3)
                                        {
                                            padding-left: 30px;
                                        }
                                    </style>
                                    <table style="width: 100%; vertical-align: top;line-height: 45px;" class="tables">
                                        <tr>
                                            <td>
                                                Share users among stores:
                                            </td>
                                            <td>
                                            <td>
                                                <input type="radio"  name="" > Yes
                                                <input type="radio"  name="" > No

                                            </td>


                                            <td >
                                                Default state of the "Update for all stores" icon:
                                            </td>
                                            <td>
                                                <select name="" class="form-control required has-error" style="border-radius: 6px;width:150px;">
                                                    <option value="not_active" selected="selected">Not Active</option>
                                                    <option value="active">Active</option>
                                                </select>
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

<div class="btn-bar btn-toolbar dropleft pull-right" style="margin-right: 10px;">

    <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="save" value="Save"/>

</div>