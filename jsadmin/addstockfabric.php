<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $scprice = $_POST['scprice'];
    $mprice = $_POST['mprice'];
    $kgprice = $_POST['kgprice'];
    $itemcode = $_POST['itemcode'];
    
    $filename = $_FILES["thumbnail"]["name"];
    $tempname = $_FILES["thumbnail"]["tmp_name"];   
    $folder = "../productimages/".$filename;
    
    move_uploaded_file($tempname, $folder);
    $sql = "INSERT INTO products (name, thumbnail, scprice, meterprice, kgprice, sample, itemcode) VALUES ('".$name."','".$filename."','".$scprice."','".$mprice."','".$kgprice."','1','".$itemcode."')";
    $q = mysql_query($sql) or die(mysql_error());
    $pid = mysql_insert_id();
    if ($q){
      echo "<script>alert('New Product Created');window.location='index.php?p=stockfabric';</script>";
    } 
    
    }
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Product</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    
    <form class="form-horizontal row-border" id="validate-1" method="POST"  action="" novalidate="novalidate" enctype="multipart/form-data">
        <div class="tab-content">
            <div class="tab-pane active">
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
                                                    
                                                    <!--<label class="col-md-2 control-label">Weight <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="weight" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>-->
                                                    
                                                    <label class="col-md-2 control-label">Swatches Card Price <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="scprice" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                    
                                                    <label class="col-md-2 control-label">Meter Price <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="mprice" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                    
                                                    <label class="col-md-2 control-label">KG Price <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="kgprice" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                    
                                                    <label class="col-md-2 control-label">Item Code <span class="required">*</span></label>
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="itemcode" class="form-control required has-error" style="border-radius: 6px; width: 300px">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>
                                                    </div>
                                                </div>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Images  </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div id="acc_images" class="collapse in">
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="thumbnail">Thumbnail:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="thumbnail" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
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
            <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->
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