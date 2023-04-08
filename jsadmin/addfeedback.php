<?php
if (isset($_POST['submit'])) {
    $sql = "insert into feedback1 (`";
    foreach ($_FILES as $a => $b) {
        if (is_array($b['name'])) {
            $pa[] = $a;
            $b['name'] = array_unique(array_values(array_filter($b['name'])));
            $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
            for ($i = 0; $i < count($b['name']); $i++) {
                $b['name'][$i] = time() . '-' . $b['name'][$i];
                move_uploaded_file($b['tmp_name'][$i], '../productimages/' . $b['name'][$i]);
            }
            $pb[] = implode(',', $b['name']);
        } elseif (is_array($b)) {
            $pa[] = $a;
            $b['name'] = time() . '-' . $b['name'];
            move_uploaded_file($b['tmp_name'], '../productimages/' . $b['name']);
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
        echo "<script>alert('New Feedback Created');window.location='index.php?p=feedback';</script>";
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Feedback</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate" enctype="multipart/form-data">
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
                                                <div class="form-group has-error">
                                                    <label class="col-md-2 control-label">Name <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="col-md-2 control-label">Email <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="email" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="col-md-2 control-label">Phone <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="phone" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="col-md-2 control-label">Message <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="message" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
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

<script>
    function getsubcategory(d) {
        $.ajax({
            url: 'ajax/getsubcategory.php',
            type: "POST",
            dataType: 'json',
            data: {
                id: d.val()
            }
        }).done(function (msg) {
            if(msg!=null)
            {
            str="<option value=''>None</option>";
            $('.name').html(str);
            for(i=0;i<msg.length;i++){
                str+="<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";;
            }
            $('.name').html(str);
            }
            else
            {
               str="<option value=''>None</option>"; 
                $('.name').html(str);
            }

        });
    }

 function getsupersubcategory(d) {
        $.ajax({
            url: 'ajax/supersubcategory.php',
            type: "POST",
            dataType: 'json',
            data: {
                id: d.val()
            }
        }).done(function (msg) {
            if(msg!=null)
            {
            str="<option value=''>None</option>";
            $('.gname').html(str);
            for(i=0;i<msg.length;i++){
                str+="<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";;
            }
            $('.gname').html(str);
            }
            else
            {
               str="<option value=''>None</option>"; 
                $('.gname').html(str);
            }

        });
    }
    
//    function getsubcategory(d) {
//        if ($('.category').val() == '') {
//            $('.subcategory').html("");
//        }
//        else {
//            $.ajax({
//                url: 'ajax/getsubcategory.php',
//                type: "POST",
//                dataType: 'json',
//                data: {term: d.val()}
//            }).done(function (msg) {
//                str = "<option> None </option>";
//                for (i = 0; i < msg.length; i++) {
//                    str += "<option value='" + msg[i].id + "'>" + msg[i].name + " </option>";
//                }
//                $('.subcategory').html(str);
//            });
//        }
//    }
</script>