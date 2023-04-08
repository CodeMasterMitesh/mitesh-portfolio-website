<?php
if (isset($_POST['submit'])) {
    $sql = "insert into products (`";
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
    // debug($_POST);
    if ($q)
        echo "<script>alert('New Product Created'); window.location='index.php?p=vieweditproduct';</script>";
}
?>




<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Products</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;margin-top: -25px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Images</a></li>
        <!--<li class=""><a href="#tab_1_3" data-toggle="tab">Quantity discounts</a></li>-->
        <li class=""><a href="#tab_1_3" data-toggle="tab">Add-ons</a></li>
        <!--<li class=""><a href="#tab_1_5" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate">
    <div class="tab-content">


        <div class="tab-pane active" id="tab_1_1">

            <div class="widget">
                <div class="widget-content">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="margin-left: -5px;">
                            <div class="panel-heading">
                                <!--<div class="widget-header">-->
                                <!--                                <div class="toolbar" style="float:right;">
                                                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                                                    </div>-->
                                <!--</div>-->
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Information </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 


                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">

                                            <div class="form-group has-error" >
                                                <label class="col-md-3 control-label">Name <span class="required">*</span></label> 
                                                <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                    <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                </div>
                                            </div>
                                            <div class="form-group has-error">
                                                <label class="col-md-3 control-label">Categories <span class="required">*</span></label> 
                                                <div class="col-md-9"> 


                                                    <div class="row"> <div class="col-md-12"> <a data-toggle="modal" href="#myModal1" class="btn btn-default btn-block" style="width: 142px;
                                                                                                 border-radius: 6px;">Add Categories</a> </div> <div class="modal fade" id="myModal1" style="display: none;" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> <h4 class="modal-title">Add Categories</h4> </div> <div class="modal-body"> 






                                                                    </div> <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button> </div> </div> </div> </div> </div>


                                                    <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                            </div>

                                            <div class="form-group has-error">
                                                <label class="col-md-3 control-label">Price($) <span class="required">*</span></label> 
                                                <div class="col-md-9"> 
                                                    <input type="text" name="req1" class="form-control required has-error" style="width: 150px;border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>




                                                <div class="form-group" style="border-top:none;">
                                                    <label class="col-md-2 control-label">Detail:</label>
                                                    <div class="col-md-10">
                                                        <textarea rows="5" name="descritop" class="form-control wysiwyg"></textarea>                
                                                    </div>
                                                </div>


                                                <div class="form-group" style="border-top:none;">
                                                    <label class="col-md-3 control-label">Status<span class="required">*</span></label>
                                                    <div class="controls" style="float:left;">
                                                        <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="A">Active</label>

                                                        <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" value="H">Hidden</label>


                                                        <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="D">Disabled</label>
                                                    </div>
                                                </div>
                                                <div style="clear:both;"></div>


                                                <div class="form-group" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label">Images:</label>
                                                        <div class="controls">


                                                            <script type="text/javascript">
                                                                //<![CDATA[
                                                                (function(_, $) {
                                                                    $.ceEvent('on', 'ce.delete_image', function(r, p) {
                                                                        if (r.deleted == true) {
                                                                            $('#' + p.result_ids).closest('a').replaceWith('<div class="no-image"><i class="glyph-image" title="No image"></i></div>');
                                                                            $('a[data-ca-target-id=' + p.result_ids + ']').hide();
                                                                        }
                                                                    });

                                                                    $.ceEvent('on', 'ce.delete_image_pair', function(r, p) {
                                                                        if (r.deleted == true) {
                                                                            $('#' + p.result_ids).remove();
                                                                        }
                                                                    });
                                                                }(Tygh, Tygh.$));
                                                                //]]>
                                                            </script>


                                                            <input type="hidden" name="image" value="" class="cm-image-field">
                                                            <input type="hidden" name="image" value="M" class="cm-image-field">
                                                            <input type="hidden" name="image" value="0" class="cm-image-field">

                                                            <div id="box_attach_images_product_main_0" class="attach-images">
                                                                <span class="desc">Thumbnails will be generated from detailed images automatically, but you can also&nbsp;<a id="sw_load_thumbnail_product_main0" class="cm-combination">upload them manually</a></span>



                                                                <div class="upload-box clearfix hidden" id="load_thumbnail_product_main0">
                                                                    <h5>
                                                                        <span>Thumbnail</span>
                                                                        <span class="small-note">(displayed on products list and product details pages)</span>            </h5>

                                                                    <div class="pull-left image-wrap">
                                                                        <div class="image">
                                                                            <div class="no-image"><i class="glyph-image" title="No image"></i></div>
                                                                        </div>
                                                                        <div class="image-alt clear">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on cm-tooltip cm-hide-with-inputs" title="Alternative text/title"><i class="icon-comment"></i></span>

                                                                                <input type="text" id="alt_icon_product_main_0" name="image" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="image-upload cm-hide-with-inputs">
                                                                        <script type="text/javascript" src="js/fileuploader_scripts.js?ver=4.0.1"></script>
                                                                        <script type="text/javascript" src="js/node_cloning.js?ver=4.0.1"></script>


                                                                        <div class="fileuploader cm-field-container">
                                                                            <input type="hidden" id="" value="">


                                                                            <div id="file_uploader_d3385f69ba092704fbb9bb3dd5345402">
                                                                                <div class="upload-file-section" id="message_d3385f69ba092704fbb9bb3dd5345402" title="">
                                                                                    <p class="cm-fu-file hidden"><i id="clean_selection_d3385f69ba092704fbb9bb3dd5345402" alt="Remove this item" title="Remove this item" onclick="Tygh.fileuploader.clean_selection(this.id);
                                                                    Tygh.fileuploader.toggle_links(this.id, 'show');
                                                                    Tygh.fileuploader.check_required_field('d3385f69ba092704fbb9bb3dd5345402', '');" class="icon-remove-sign cm-tooltip hand"></i>&nbsp;<span></span></p>
                                                                                    <p class="cm-fu-no-file ">Select a file or enter a URL</p>    </div>

                                                                                <input type="hidden" name="image" value="product_main" id="file_d3385f69ba092704fbb9bb3dd5345402"><input type="hidden" name="image" value="local" id="type_d3385f69ba092704fbb9bb3dd5345402"><div class="btn-group " id="link_container_d3385f69ba092704fbb9bb3dd5345402"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Browse</span></a><div class="image-selector"><label for=""><input type="file" name="image" id="local_d3385f69ba092704fbb9bb3dd5345402" onchange="Tygh.fileuploader.show_loader(this.id);
                                                                    Tygh.fileuploader.check_required_field('d3385f69ba092704fbb9bb3dd5345402', '');" class="file" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_d3385f69ba092704fbb9bb3dd5345402">URL</a></div></div>

                                                                        </div>fileuploader



                                                                    </div>
                                                                </div>



                                                                <div class="upload-box clearfix">
                                                                    <div class="pull-left image-wrap" style="margin-left: 150px;">
                                                                        <div class="image">
                                                                            <div class="no-image"><i class="glyph-image" title="No image"></i></div>
                                                                        </div>

                                                                        <div class="image-alt">
                                                                            <div class="input-prepend">

                                                                                <span class="add-on cm-tooltip cm-hide-with-inputs"><i class="icon-comment"></i></span>
                                                                                <input class="form-control required has-error" style="border-radius: 6px;" type="text" id="alt_det_product_main_0" name="image" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="image-upload cm-hide-with-inputs">




                                                                        <div class="fileuploader cm-field-container">
                                                                            <input type="hidden" id="" value="">


                                                                            <div id="file_uploader_608714aa73b5ced0b2509ebc3c42edd0">
                                                                                <div class="upload-file-section" id="message_608714aa73b5ced0b2509ebc3c42edd0" title="">
                                                                                    <p class="cm-fu-file hidden"><i id="clean_selection_608714aa73b5ced0b2509ebc3c42edd0" alt="Remove this item" title="Remove this item" onclick="Tygh.fileuploader.clean_selection(this.id);
                                                                    Tygh.fileuploader.toggle_links(this.id, 'show');
                                                                    Tygh.fileuploader.check_required_field('608714aa73b5ced0b2509ebc3c42edd0', '');" class="icon-remove-sign cm-tooltip hand"></i>&nbsp;<span></span></p>
                                                                                    <p class="cm-fu-no-file ">Select a file or enter a URL</p>    </div>

                                                                                <input type="hidden" name="image" value="product_main" id="file_608714aa73b5ced0b2509ebc3c42edd0"><input type="hidden" name="image" value="local" id="type_608714aa73b5ced0b2509ebc3c42edd0"><div class="btn-group " id="link_container_608714aa73b5ced0b2509ebc3c42edd0"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Browse</span></a><div class="image-selector"><label for=""><input type="file" name="image" id="local_608714aa73b5ced0b2509ebc3c42edd0" onchange="Tygh.fileuploader.show_loader(this.id);
                                                                    Tygh.fileuploader.check_required_field('608714aa73b5ced0b2509ebc3c42edd0', '');" class="file" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_608714aa73b5ced0b2509ebc3c42edd0">URL</a></div></div>

                                                                        </div>fileuploader                                                                        </div>

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

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Options settings </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 
                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">

                                            <div id="acc_options" class="in collapse"  style="height: auto;">
                                                <!--<script type="text/javascript">if(location.host=="envato.stammtec.de"||location.host=="themes.stammtec.de"){var _paq=_paq||[];_paq.push(["trackPageView"]);_paq.push(["enableLinkTracking"]);(function(){var a=(("https:"==document.location.protocol)?"https":"http")+"://analytics.stammtec.de/";_paq.push(["setTrackerUrl",a+"piwik.php"]);_paq.push(["setSiteId","17"]);var e=document,c=e.createElement("script"),b=e.getElementsByTagName("script")[0];c.type="text/javascript";c.defer=true;c.async=true;c.src=a+"piwik.js";b.parentNode.insertBefore(c,b)})()};</script>-->
                                                <div class="form-group has-error"> 
                                                    <label class="col-md-3 control-label">Options type: <span class="required">*</span></label> 
                                                    <div class="col-md-9 clearfix"> 

                                                        <select  class="select1" name="chosen1" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                            <option></option> 
                                                            <option value="1">Option 1</option> 
                                                            <option value="2">Option 2</option> 
                                                            <option value="3">Option 3</option> 
                                                        </select> 
                                                        <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                        </label> 
                                                    </div> 
                                                    <label class="col-md-3 control-label">Exception type: <span class="required">*</span></label> 
                                                    <div class="col-md-9 clearfix"> 

                                                        <select   class="select1 " name="chosen1" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                            <option></option> 
                                                            <option value="1">Option 1</option> 
                                                            <option value="2">Option 2</option> 
                                                            <option value="3">Option 3</option> 
                                                        </select> 
                                                        <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                        </label> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Pricing / inventory  </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 
                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">

                                            <div id="acc_pricing_inventory" class="collapse in">
                                                <div class="form-group has-error">
                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_product_code">CODE:</label>
                                                        <div class="col-md-9"> <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                        <!--                        <div class="controls">
                                                                                    <input type="text" name="product_data[product_code]" id="elm_product_code" size="20" maxlength="32" value="" class="input-long">
                                                                                </div>-->
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_list_price">List price ($) &nbsp;<a class="cm-tooltip" title="Manufacturer suggested retail price."><i class="icon-question-sign"></i></a>:</label>
                                                        <div class="col-md-9"> <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_in_stock">In stock:</label>
                                                        <div class="col-md-9"> <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;width:150px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>            
                                                    </div>

                                                    <div class="form-group has-error"> 
                                                        <label class="col-md-3 control-label">Zero price action:<span class="required">*</span></label> 
                                                        <div class="col-md-9 clearfix"> 

                                                            <select class="select1"  name="chosen1" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                                <option></option> 
                                                                <option value="1">Option 1</option> 
                                                                <option value="2">Option 2</option> 
                                                                <option value="3">Option 3</option> 
                                                            </select> 
                                                            <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                            </label> 
                                                        </div> 
                                                        <label class="col-md-3 control-label">Inventory <span class="required">*</span></label> 
                                                        <div class="col-md-9 clearfix"> 

                                                            <select  class="select1" name="chosen1" class="col-md-12 select2 full-width-fix required select2-offscreen" tabindex="-1">
                                                                <option></option> 
                                                                <option value="1">Option 1</option> 
                                                                <option value="2">Option 2</option> 
                                                                <option value="3">Option 3</option> 
                                                            </select> 
                                                            <label for="chosen1" generated="true" class="has-error help-block" style="display:none;">

                                                            </label> 
                                                        </div> 
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_min_qty">Minimum order quantity:</label>
                                                        <div class="col-md-9"> <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>



                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_max_qty">Maximum order quantity:</label>
                                                        <div class="col-md-9"> <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_qty_step">Quantity step:</label>
                                                        <div class="col-md-9"> <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;width:150px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_list_qty_count">List quantity count:</label>                                                                                       
                                                        <div class="col-md-9"> <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;width:350px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                                    </div>

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label">Taxes:</label>
                                                        <div class="controls">
                                                            <input type="hidden" name="product_data[tax_ids]" value="">

                                                            <label class="col-md-3 control-label" for="elm_taxes_6">
                                                                <input type="checkbox" name="product_data[tax_ids][6]" id="elm_taxes_6" value="6">
                                                                VAT</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> SEO / Meta data </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 
                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">
                                            
                                                <div class="form-group has-error" >
                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_category_page_title">Page title&nbsp;<a class="cm-tooltip"><i class="icon-question-sign"></i></a>:</label>
                                                        <div class="col-md-9"> <input type="text" name="metatitle" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border-top:none;">

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_category_meta_description">Meta description:</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control required has-error" style="border-radius: 6px;" name="metadescri" id="elm_category_meta_description" cols="55" rows="4" class="input-large"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group has-error" style="border-top:none;">

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_category_meta_description">Meta keywords:</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control required has-error" style="border-radius: 6px;" name="metakeyword" id="elm_category_meta_description" cols="55" rows="4" class="input-large"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Availability  </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 


                                    <div class="widget box" style="border:none;">
                                        <div class="widget-content">
                                            
                                            


                                                <div class="form-group has-error" >

                                                    <label class="col-md-3 control-label">User groups&nbsp;<a class="cm-tooltip"><i class="icon-question-sign"></i></a>:</label>
                                                    <div class="controls" style="float:left;">
                                                        <label class="radio inline" for="elm_product_status_0_a"><input type="checkbox" name="usergroup" id="elm_product_status_0_a" checked="checked" value="A">All</label>

                                                        <label class="radio inline" for="elm_product_status_0_h"><input type="checkbox" name="usergroup" id="elm_product_status_0_h" value="H">Guest</label>


                                                        <label class="radio inline" for="elm_product_status_0_d"><input type="checkbox" name="usergroup" id="elm_product_status_0_d" value="D">Registered</label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="category_data[usergroup_ids]" value="0">
                                                <script type="text/javascript">
                                                                //<![CDATA[

                                                                function fn_switch_default_box(holder, prefix, default_id)
                                                                {
                                                                    var $ = Tygh.$;
                                                                    var p = $(holder).parents(':not(li,a,label,ul):first');

                                                                    var default_box = $('input[id^=' + prefix + '_' + default_id + ']', p);
                                                                    var checked_groups = $('input[id^=' + prefix + '_][type=checkbox]:checked', p).not(default_box).not(holder).length + (holder.checked ? 1 : 0);

                                                                    default_box.prop('disabled', (checked_groups == 0));
                                                                    if (checked_groups == 0) {
                                                                        default_box.prop('checked', true);
                                                                    }

                                                                    fn_calculate_usergroups(p);
                                                                    return true;
                                                                }

                                                                function fn_calculate_usergroups(holder)
                                                                {
                                                                    var $ = Tygh.$;
                                                                    if ($(holder).length) {
                                                                        var note = $('.cm-ug-amount', $(holder));
                                                                    } else {
                                                                        var note = $('.cm-ug-amount');
                                                                    }

                                                                    note.each(function() {
                                                                        var p = $(this).parents(':not(li,a,label,ul):first');
                                                                        var total_checked = $('input[type=checkbox]:checked', p).length;
                                                                        $(this).html('(' + total_checked + ')');
                                                                    });

                                                                }

                                                                //]]>
                                                </script>




                                                <div class="form-group has-error" style="border-top:none;">

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_category_position">Position:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="position" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                    </div>
                                                </div>

                                                <div class="form-group has-error" style="border-top:none;">

                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_category_creation_date">Creation date:</label>
                                                        <div class="controls">

                                                            <div class="calendar col-md-9">
                                                                <input class="form-control required has-error" style="border-radius: 6px;width: 150px;" type="text" id="elm_category_creation_date" name="creationtable" class="cm-calendar hasDatepicker" value="09/23/2013" size="10">
                                                                <span data-ca-external-focus-id="elm_category_creation_date" class="icon-calendar cm-external-focus " style=" position: absolute;top: 10;left: 0;"></span>
                                                            </div>

                                                            <script type="text/javascript">
                                                                //<![CDATA[
                                                                (function(_, $) {
                                                                    $(document).ready(function() {
                                                                        $('#elm_category_creation_date').datepicker(
                                                                                {
                                                                                    changeMonth: true,
                                                                                    duration: 'fast',
                                                                                    changeYear: true,
                                                                                    numberOfMonths: 1,
                                                                                    selectOtherMonths: true,
                                                                                    showOtherMonths: true,
                                                                                    firstDay: 1,
                                                                                    dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                                                                                    monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                                                                    yearRange: '2004:2014',
                                                                                    dateFormat: 'mm/dd/yy'
                                                                                });
                                                                    });
                                                                }(Tygh, Tygh.$));
                                                                //]]>
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_date_avail_holder">Avail since:</label>
                                                        <div class="controls">

                                                            <div class="calendar col-md-9">
                                                                <input class="form-control required has-error" style="border-radius: 6px;width: 150px;" type="text" id="elm_category_creation_date" name="creationtable" class="cm-calendar hasDatepicker"  size="10">
                                                                <span data-ca-external-focus-id="elm_category_creation_date" class="icon-calendar cm-external-focus " style=" position: absolute;top: 10;left: 0;"></span>
                                                            </div>

                                                            <script type="text/javascript">
                                                                //<![CDATA[
                                                                (function(_, $) {
                                                                    $(document).ready(function() {
                                                                        $('#elm_date_avail_holder').datepicker(
                                                                                {
                                                                                    changeMonth: true,
                                                                                    duration: 'fast',
                                                                                    changeYear: true,
                                                                                    numberOfMonths: 1,
                                                                                    selectOtherMonths: true,
                                                                                    showOtherMonths: true,
                                                                                    firstDay: 1,
                                                                                    dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                                                                                    monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                                                                    yearRange: '2004:2014',
                                                                                    dateFormat: 'mm/dd/yy'
                                                                                });
                                                                    });
                                                                }(Tygh, Tygh.$));
                                                                //]]>
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-3 control-label" for="elm_out_of_stock_actions">Out of stock actions&nbsp;<a class="cm-tooltip" title="Note that the 'Buy in advance' option requires a positive product amount while the 'Sign up for notification' option requires a non-positive amount. Also note that the 'Sign up for notification' option is not applied to products tracked with options."><i class="icon-question-sign"></i></a>:</label>
                                                        <div class="controls">
                                                            <select class="select1" class="span3" name="product_data[out_of_stock_actions]" id="elm_out_of_stock_actions">
                                                                <option value="N">None</option>
                                                                <option value="B">Buy in advance</option>
                                                                <option value="S">Sign up for notification</option>
                                                            </select>
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

        <div class="tab-pane" id="tab_1_2">
            <div class="widget">
                <div class="widget-content">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" style="margin-left: -5px;">
                            <div class="panel-heading">
                                <!--<div class="widget-header">-->
                                <!--                                <div class="toolbar" style="float:right;">
                                                        <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                                                    </div>-->
                                <!--</div>-->
                                <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Additional Image </a> </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                <div class="panel-body"> 


                                    <div class="form-group" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" style="color:#b94a48;">Images:</label>
                                                        <div class="controls">


                                                            <script type="text/javascript">
                                                                //<![CDATA[
                                                                (function(_, $) {
                                                                    $.ceEvent('on', 'ce.delete_image', function(r, p) {
                                                                        if (r.deleted == true) {
                                                                            $('#' + p.result_ids).closest('a').replaceWith('<div class="no-image"><i class="glyph-image" title="No image"></i></div>');
                                                                            $('a[data-ca-target-id=' + p.result_ids + ']').hide();
                                                                        }
                                                                    });

                                                                    $.ceEvent('on', 'ce.delete_image_pair', function(r, p) {
                                                                        if (r.deleted == true) {
                                                                            $('#' + p.result_ids).remove();
                                                                        }
                                                                    });
                                                                }(Tygh, Tygh.$));
                                                                //]]>
                                                            </script>


                                                            <input type="hidden" name="image" value="" class="cm-image-field">
                                                            <input type="hidden" name="image" value="M" class="cm-image-field">
                                                            <input type="hidden" name="image" value="0" class="cm-image-field">

                                                            <div id="box_attach_images_product_main_0" class="attach-images">
                                                                <span class="desc">Thumbnails will be generated from detailed images automatically, but you can also&nbsp;<a id="sw_load_thumbnail_product_main0" class="cm-combination">upload them manually</a></span>



                                                                <div class="upload-box clearfix hidden" id="load_thumbnail_product_main0">
                                                                    <h5>
                                                                        <span>Thumbnail</span>
                                                                        <span class="small-note">(displayed on products list and product details pages)</span>            </h5>

                                                                    <div class="pull-left image-wrap">
                                                                        <div class="image">
                                                                            <div class="no-image"><i class="glyph-image" title="No image"></i></div>
                                                                        </div>
                                                                        <div class="image-alt clear">
                                                                            <div class="input-prepend">
                                                                                <span class="add-on cm-tooltip cm-hide-with-inputs" title="Alternative text/title"><i class="icon-comment"></i></span>

                                                                                <input type="text" id="alt_icon_product_main_0" name="image" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="image-upload cm-hide-with-inputs">
                                                                        <script type="text/javascript" src="js/fileuploader_scripts.js?ver=4.0.1"></script>
                                                                        <script type="text/javascript" src="js/node_cloning.js?ver=4.0.1"></script>


                                                                        <div class="fileuploader cm-field-container">
                                                                            <input type="hidden" id="" value="">


                                                                            <div id="file_uploader_d3385f69ba092704fbb9bb3dd5345402">
                                                                                <div class="upload-file-section" id="message_d3385f69ba092704fbb9bb3dd5345402" title="">
                                                                                    <p class="cm-fu-file hidden"><i id="clean_selection_d3385f69ba092704fbb9bb3dd5345402" alt="Remove this item" title="Remove this item" onclick="Tygh.fileuploader.clean_selection(this.id);
                                                                    Tygh.fileuploader.toggle_links(this.id, 'show');
                                                                    Tygh.fileuploader.check_required_field('d3385f69ba092704fbb9bb3dd5345402', '');" class="icon-remove-sign cm-tooltip hand"></i>&nbsp;<span></span></p>
                                                                                    <p class="cm-fu-no-file ">Select a file or enter a URL</p>    </div>

                                                                                <input class="form-control required has-error" type="hidden" name="image" value="product_main" id="file_d3385f69ba092704fbb9bb3dd5345402"><input type="hidden" name="image" value="local" id="type_d3385f69ba092704fbb9bb3dd5345402"><div class="btn-group " id="link_container_d3385f69ba092704fbb9bb3dd5345402"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Browse</span></a><div class="image-selector"><label for=""><input type="file" name="image" id="local_d3385f69ba092704fbb9bb3dd5345402" onchange="Tygh.fileuploader.show_loader(this.id);
                                                                    Tygh.fileuploader.check_required_field('d3385f69ba092704fbb9bb3dd5345402', '');" class="file" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_d3385f69ba092704fbb9bb3dd5345402">URL</a></div></div>

                                                                        </div>fileuploader



                                                                    </div>
                                                                </div>



                                                                <div class="upload-box clearfix">
                                                                    <div class="pull-left image-wrap" style="margin-left: 150px;">
                                                                        <div class="image">
                                                                            <div class="no-image"><i class="glyph-image" title="No image"></i></div>
                                                                        </div>

                                                                        <div class="image-alt">
                                                                            <div class="input-prepend">

                                                                                <span class="add-on cm-tooltip cm-hide-with-inputs"><i class="icon-comment"></i></span>
                                                                                <input class="form-control required has-error" style="border-radius: 6px;" type="text" id="alt_det_product_main_0" name="image" value="">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="image-upload cm-hide-with-inputs">




                                                                        <div class="fileuploader cm-field-container">
                                                                            <input type="hidden" id="" value="">


                                                                            <div id="file_uploader_608714aa73b5ced0b2509ebc3c42edd0">
                                                                                <div class="upload-file-section" id="message_608714aa73b5ced0b2509ebc3c42edd0" title="">
                                                                                    <p class="cm-fu-file hidden"><i id="clean_selection_608714aa73b5ced0b2509ebc3c42edd0" alt="Remove this item" title="Remove this item" onclick="Tygh.fileuploader.clean_selection(this.id);
                                                                    Tygh.fileuploader.toggle_links(this.id, 'show');
                                                                    Tygh.fileuploader.check_required_field('608714aa73b5ced0b2509ebc3c42edd0', '');" class="icon-remove-sign cm-tooltip hand"></i>&nbsp;<span></span></p>
                                                                                    <p class="cm-fu-no-file ">Select a file or enter a URL</p>    </div>

                                                                                <input type="hidden" name="image" value="product_main" id="file_608714aa73b5ced0b2509ebc3c42edd0"><input type="hidden" name="image" value="local" id="type_608714aa73b5ced0b2509ebc3c42edd0"><div class="btn-group " id="link_container_608714aa73b5ced0b2509ebc3c42edd0"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Browse</span></a><div class="image-selector"><label for=""><input type="file" name="image" id="local_608714aa73b5ced0b2509ebc3c42edd0" onchange="Tygh.fileuploader.show_loader(this.id);
                                                                    Tygh.fileuploader.check_required_field('608714aa73b5ced0b2509ebc3c42edd0', '');" class="file" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_608714aa73b5ced0b2509ebc3c42edd0">URL</a></div></div>

                                                                        </div>fileuploader                                                                        </div>

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




  
    
    <div class="tab-pane" id="tab_1_3">
        <div class="widget">
                    <!--                <div class="widget-header">
                                        <h4><i class="icon-reorder"></i> Accordion</h4>
                                        <div class="toolbar">
                                            <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                                        </div>
                                    </div>-->

                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Bestselling    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 


                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        
                                            <div class="form-group has-error" >

                                                <div class="controls">
                                                    <div class="control-group cm-no-hide-input">
                                                        <label class="col-md-3 control-label" for="discussion_type">Sales amount:</label>
                                                        <div class="col-md-9"> 
                                                    <input type="text" name="req1" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  
                                                        </div>
                                                    </div>


                                                </div>


                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    <div class="panel panel-default">
                        <div class="panel-heading toolbar">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Age verification  </a> </h3>
                            <div class="btn-group" style="float:right;top:-14;"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 


                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        
                                            <div class="form-group has-error" >

                                                <div class="control-group">
                                                    <label for="age_verification" class="col-md-3 control-label">Age verification:</label>
                                                    <div class="col-md-9" style="margin-top: -10px;">
                                                        <input type="hidden" name="ageverification" value="N">
                                                        <span class="checkbox">
                                                            <input type="checkbox" id="age_verification" name="ageverification" value="Y">
                                                        </span>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-group has-error" style="border-top:none;">

                                                <div class="control-group">
                                                    <label for="age_limit" class=" col-md-3 control-label">Age limit:</label>
                                                    <div class="col-md-9">
                                                        <input   class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="agelimit" size="10" maxlength="2" value="0" class="input-micro">
                                                        <span class="year"> &nbsp; years</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group has-error" style="border-top:none;">

                                                <div class="control-group">
                                                    <label style="margin-top: 15px;" for="age_warning_message" class="col-md-3 control-label">Warning message:</label>
                                                    <div class="col-md-9" style="margin-top: 15px;">
                                                        <textarea  class="form-control required has-error" style="border-radius: 6px;width:300px;" id="age_warning_message" name="warningmessage" cols="55" rows="4"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Comments and reviews   </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 


                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">
                                        
                                            <div class="form-group has-error" >

                                                <div class="controls">
                                                    <div class="control-group cm-no-hide-input">
                                                        <label class="col-md-3 control-label" for="discussion_type">Reviews:</label>
                                                        <div class="controls">
                                                            <select class="select1" name="reviews" id="discussion_type">
                                                                <option value="B">Communication and Rating</option>
                                                                <option value="C">Communication</option>
                                                                <option value="R">Rating</option>
                                                                <option selected="selected" value="D">Disabled</option>
                                                            </select>
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

            <a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;"> Create</a>
            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
            <a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>

        </div>
        
        
   </form> 
</div>