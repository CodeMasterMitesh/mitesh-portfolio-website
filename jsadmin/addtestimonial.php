<?php
if (isset($_POST['submit'])) {
    $sql = "insert into testimonial (`";
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
        echo "<script>alert('New Testimonial Created');window.location='index.php?p=testimonial';</script>";
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Testimonial</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
<!--        <li class=""><a href="#tab_1_2" data-toggle="tab">Media</a></li>
        <li class=""><a href="#tab_1_3" data-toggle="tab">Quantity discounts</a></li>
        <li class=""><a href="#tab_1_4" data-toggle="tab">Add-ons</a></li>
        <li class=""><a href="#tab_1_5" data-toggle="tab">Option</a></li>
        <li class=""><a href="#tab_1_6" data-toggle="tab">SEO/Meta data</a></li>-->
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
                                                <div class="form-group has-error" style="border:none;">
                                                    
<!--                                                    <label class="col-md-2 control-label">Categories <span class="required">*</span></label> 
                                                    <div class="col-md-2"> 
                                                        <?php echo getoptn('category', 'name', 'id', 'category', 'select1', ' id="select" onchange="getsubcategory($(this))" ', "", 'None'); ?>
                                                        <input type="hidden" id="e21"  style="width:300px;" tabindex="-1" class="select2-offscreen" value="<?php echo $rdata['subcatid']; ?>">

                                                        <input type="hidden" id="e15" style="width:300px;" value="red,cyan,green,orange" tabindex="-1" class="select2-offscreen">


                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                    </div>-->
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
<!--                                                    <label class="col-md-2 control-label">Sub Categories <span class="required">*</span></label> 
                                                    <div class="col-md-2" id="subcategory"> 
                                                        <select name="subcategory" class="form-control name">
                                                                <option value=""></option>
                                                        </select>

                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                    </div>-->
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Detail:</label>
                                                        <div class="col-md-10">
                                                            <textarea style="width: 500px" rows="5" class="form-control" name="description"></textarea>
                                                            <script src="tinymce/tinymce.min.js"></script>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="Active">Active</label>
<!--                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" value="Hidden">Hidden</label>-->
                                                            <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="Disable">Disabled</label>
                                                        </div>
                                                    </div>
                                                    <div style="clear:both;"></div>
                                                    <div class="form-group" style="border-top:none;">
<!--                                                        <label class="col-md-2 control-label">Is Available<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="isavailable" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>
                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="isavailable" id="elm_product_status_0_h" value="No">No</label>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<!--                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Pricing / inventory  </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <div id="acc_pricing_inventory" class="collapse in">
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_product_code">CODE:</label>
                                                            <div class="col-md-9"> <input type="text" name="code" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>-->
<!--                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_in_stock">In stock:</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" style="width: 70px;" name="instock" >
                                                                    <option>yes</option>
                                                                    <option>no</option>
                                                                </select>
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_min_qty">Minimum order quantity:</label>
                                                            <div class="col-md-9"> <input type="text" value="1" name="minqty" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="elm_max_qty">Maximum order quantity:</label>
                                                            <div class="col-md-9"> <input type="text" name="maxqty" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">Price:</label>
                                                            <div class="col-md-9"> <input type="text" name="price" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">VAT:</label>
                                                            <div class="col-md-9"> <input type="text" name="vat" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">Service TAX:</label>
                                                            <div class="col-md-9"> <input type="text" name="servicetax" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="price">Commission:</label>
                                                            <div class="col-md-9"> <input type="text" name="commission" class="form-control required has-error" style="border-radius: 6px;width:100px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label">Taxes:</label>
                                                            <div class="controls">
                                                                <input type="hidden" name="taxes" value="">
                                                                <label class="col-md-2 control-label" for="elm_taxes_6">
                                                                    <input type="checkbox" name="taxes" id="elm_taxes_6" value="6">
                                                                    VAT</label>
                                                            </div>
                                                        </div>
                                                        <label class="col-md-2 control-label">Is Taxable<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="istaxable" id="elm_product_status_0_a" checked="checked" value="Yes">Yes</label>
                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="istaxable" id="elm_product_status_0_h" value="No">No</label>
                                                        </div>
                                                    </div>-->
<!--                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
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
                                                            <label class="col-md-2 control-label" for="image">Image:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="image" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
<!--                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image1">Image 1:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="image1" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image2">Image 2:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="image2" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image3">Image 3:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="image3" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image4">Image 4:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="image4" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image5">Image 5:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="image5" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label" for="image6">Image 6:</label>
                                                            <div class="col-md-9"> 
                                                                <input type="file" name="image6" class="form-control required has-error" style="border-radius: 6px;width:350px;">
                                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                            </div>
                                                            <div class="controls"></div>
                                                        </div>
                                                    </div>-->
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