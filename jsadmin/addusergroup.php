<?php
if (isset($_POST['submit'])) {
    $sql = "insert into customers (`";
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
        if ($a != 'submit') {
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
    if ($q)
        echo "<script>alert('New Users Created');window.location='index.php?p=user';</script>";
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New User Group(s)</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> User account information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div class="form-group has-error" >
                                                    <div class="control-group">
                                                        <label for="email" class=" col-md-2 control-label cm-required cm-email">User Group:<span class="required">*</span></label> 
                                                        <div class="col-md-9">
                                                            <input type="text" name="email" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-2 control-label">Type  <span class="required">*</span></label> 
                                                    <div class="col-md-9"> 
                                                        <select name="type" id="user_language" class="select1">
                                                            <option>Customer</option>
                                                            <option>Administrator</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group has-error" style="border-top:none;">

                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="A">Active</label>
                                                            <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="D">Hidden</label>
                                                             <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="D">Disabled</label>
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
            </div>
            

        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">
            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
           
        </div>
    </form>
</div>

