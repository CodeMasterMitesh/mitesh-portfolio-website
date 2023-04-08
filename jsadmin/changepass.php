<?php
if (isset($_POST['update'])) {
    $sql1 = "update login set username='" . $_POST['username'] . "', password='" . $_POST['password'] . "'";
    $q1 = mysql_query($sql1) or die(mysql_error());
    if ($q1) {
//        echo '<script>alert("Username and Password successfully changed.")window.location="index.php?p=changepass";</script>';
          echo "<script>alert('Username and Password successfully changed');window.location='index.php?';</script>";
        }
}
$sql = "select * from login";
$q = mysql_query($sql) or die(mysql_error());
$r = mysql_fetch_assoc($q);
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Change Password</h3>
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
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-2 control-label">Username: <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" value="<?php echo $r['username'] ?>" name="username" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Password: <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" value="<?php echo $r['password'] ?>" name="password" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
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
    <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="update"/>
    <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->
</div>
</form>
</div>