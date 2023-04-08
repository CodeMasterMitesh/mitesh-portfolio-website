<?php
if (isset($_POST['submit'])) {
    $sql = "insert into options (`";
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
        echo "<script>alert('New Option Created'); window.location='index.php?p=option';</script>";
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Option</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
<!--        <li class=""><a href="#tab_1_2" data-toggle="tab">Variants</a></li>     -->

    </ul>
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

                                                <div class="form-group has-error" >

                                                    <div class="control-group">
                                                        <label for="elm_filter_name_0" class="col-md-2 control-label">Name<span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="elm_filter_name_0" name="name" class="addimage form-control required has-error" style="border-radius: 6px;" value="">
                                                        </div>
                                                    </div>
                                                </div>

<!--                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 col-md-2 control-label" for="elm_filter_position_0">Position:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;width:150px;" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >

                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_inventory_0">Inventory&nbsp;<a class="cm-tooltip" title="If enabled, the option is taken into account when forming the product inventory."><i class="icon-question-sign"></i></a></label>
                                                        <div class="col-md-10">           
                                                            <p>-</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_option_type_0">Type</label>
                                                        <div class="col-md-10">
                                                            <select class="select1"id="elm_option_type_0" name="option_data[option_type]" onchange="fn_check_option_type(this.value, this.id);"><option value="S">Select box</option><option value="R">Radio group</option><option value="C">Check box</option><option value="I">Text</option><option value="T">Text area</option><option value="F">File</option></select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_option_description_0">Description</label>
                                                        <div class="col-md-10">
                                                            <textarea class="addimage form-control required has-error" id="elm_option_description_0" name="option_data[description]" cols="55" rows="8" class="cm-wysiwyg span9"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_option_comment_0">Comment</label>
                                                        <div class="col-md-10">
                                                            <input class="addimage form-control required has-error" type="text" name="option_data[comment]" id="elm_option_comment_0" value="" class="span9">
                                                            <p class="description">Enter your comment to appear below the option</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_option_file_required_0">Required&nbsp;<a class="cm-tooltip" title="If enabled, the option is mandatory to fill in."><i class="icon-question-sign"></i></a></label>
                                                        <div class="col-md-10">
                                                            <label class="checkbox">
                                                                <input type="hidden" name="option_data[required]" value="N"><input type="checkbox" id="elm_option_file_required_0" name="option_data[required]" value="Y">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_option_missing_variants_0">Missing variants handling</label>
                                                        <div class="col-md-10">
                                                            <p>-</p>
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
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Categories    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">

                                        <div class="form-group has-error" style="border:none;">
                                            <div  id="content_tab_option_variants_0" style="display: block;">
                                                <fieldset>
                                                    <table class="table table-middle">
                                                        <thead>
                                                            <tr class="first-sibling">
                                                                <th class="cm-non-cb">Pos.</th>
                                                                <th class="cm-non-cb">Name</th>
                                                                <th>Modifier&nbsp;/&nbsp;Type</th>
                                                                <th>Weight modifier&nbsp;/&nbsp;Type</th>
                                                                <th class="cm-non-cb">Status</th>
                                                                <th>
                                                        <div id="on_st_0" alt="Expand / collapse the list of items" title="Expand / collapse the list of items" class="hand cm-combinations-options-0 exicon-expand"></div><div id="off_st_0" alt="Expand / collapse the list of items" title="Expand / collapse the list of items" class="hand hidden cm-combinations-options-0 exicon-collapse"></div>
                                                        </th>
                                                        <th class="cm-non-cb">&nbsp;</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody class="hover cm-row-item " id="box_add_variant_0">
                                                            <tr>
                                                                <td class="cm-non-cb">
                                                                    <input class="addimage form-control required has-error" style="width:70px;border-radius: 6px;" type="text" name="option_data[comment]" id="elm_option_comment_0" value="" class="span9"></td>
                                                                <td class="cm-non-cb">
                                                                     <input class="addimage form-control required has-error" style="border-radius: 6px;"type="text" name="option_data[comment]" id="elm_option_comment_0" value="" class="span9"></td>
                                                                <td>
                                                                     <input class="addimage required has-error" style="width:50px;border-radius: 6px;" type="text" name="option_data[comment]" id="elm_option_comment_0" value="" class="span9">&nbsp;/
                                                                     <select class="select1 input-mini" style="width:50px;" name="option_data[variants][1][modifier_type]">
                                                                        <option value="A">$</option>
                                                                        <option value="P">%</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input class="addimage required has-error" style="width:50px;border-radius: 6px;" type="text" name="option_data[comment]" id="elm_option_comment_0" value="" class="span9">&nbsp;/&nbsp;
                                                                    <select class="select1 input-mini" style="width:50px;" name="option_data[variants][1][weight_modifier_type]">
                                                                        <option value="A">lbs</option>
                                                                        <option value="P">%</option>
                                                                    </select>
                                                                </td>
                                                                <td class="cm-non-cb">
                                                                    <select class="select1 input-small input-small" style="width:100px;" name="option_data[variants][1][status]">
                                                                        <option value="A">Active</option>
                                                                        <option value="D">Disabled</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td class="right cm-non-cb">


                                                                    <a class="icon-plus cm-tooltip" name="add" id="add_variant_0" title="Add" onclick="Tygh.$('#box_' + this.id).cloneNode(2); "></a>&nbsp;<a class="exicon-clone cm-tooltip" name="clone" id="add_variant_0" title="Clone" onclick="Tygh.$('#box_' + this.id).cloneNode(2, true);"></a>&nbsp;	<a class="icon-remove cm-opacity cm-tooltip " name="remove" id="add_variant_0" title="Remove"></a>
                                                                    <a name="remove_hidden" id="add_variant_0" class="icon-remove cm-tooltip  hidden cm-delete-row" title="Remove"></a>
                                                                </td>
                                                            </tr>
                                                            <tr id="extra_option_variants_0_1" class="cm-ex-op hidden">
                                                                <td colspan="7">

                                                                    <div class="control-group cm-non-cb">
                                                                        <label class="control-label">Icon</label>
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


                                                                            <input type="hidden" name="variant_image_image_data[1][pair_id]" value="" class="cm-image-field">
                                                                            <input type="hidden" name="variant_image_image_data[1][type]" value="V" class="cm-image-field">
                                                                            <input type="hidden" name="variant_image_image_data[1][object_id]" value="0" class="cm-image-field">

                                                                            <div id="box_attach_images_variant_image_1" class="attach-images">



                                                                                <div class="upload-box clearfix " id="load_thumbnail_variant_image1">

                                                                                    <div class="pull-left image-wrap">
                                                                                        <div class="image">
                                                                                            <div class="no-image"><i class="glyph-image" title="No image"></i></div>
                                                                                        </div>
                                                                                        <div class="image-alt clear">
                                                                                            <div class="input-prepend">
                                                                                                <span class="add-on cm-tooltip cm-hide-with-inputs" title="Alternative text/title"><i class="icon-comment"></i></span>

                                                                                                <input type="text" id="alt_icon_variant_image_1" name="variant_image_image_data[1][image_alt]" value="">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="image-upload cm-hide-with-inputs">




                                                                                        <div class="fileuploader cm-field-container">
                                                                                            <input type="hidden" id="" value="">


                                                                                            <div id="file_uploader_070625e552f9adfb229fdd65c973894e5">
                                                                                                <div class="upload-file-section" id="message_070625e552f9adfb229fdd65c973894e5" title="">
                                                                                                    <p class="cm-fu-file hidden"><i id="clean_selection_070625e552f9adfb229fdd65c973894e5" alt="Remove this item" title="Remove this item" onclick="Tygh.fileuploader.clean_selection(this.id); Tygh.fileuploader.toggle_links(this.id, 'show'); Tygh.fileuploader.check_required_field('070625e552f9adfb229fdd65c973894e5', '');" class="icon-remove-sign cm-tooltip hand"></i>&nbsp;<span></span></p>
                                                                                                    <p class="cm-fu-no-file ">Select a file or enter a URL</p>    </div>

                                                                                                <input type="hidden" name="file_variant_image_image_icon[1]" value="variant_image" id="file_070625e552f9adfb229fdd65c973894e5" class="cm-image-field"><input type="hidden" name="type_variant_image_image_icon[1]" value="local" id="type_070625e552f9adfb229fdd65c973894e5" class="cm-image-field"><div class="btn-group " id="link_container_070625e552f9adfb229fdd65c973894e5"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Local</span></a><div class="image-selector"><label for=""><input type="file" name="file_variant_image_image_icon[1]" id="local_070625e552f9adfb229fdd65c973894e5" onchange="Tygh.fileuploader.show_loader(this.id);  Tygh.fileuploader.check_required_field('070625e552f9adfb229fdd65c973894e5', '');" class="file cm-image-field" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="server_070625e552f9adfb229fdd65c973894e5">Server</a><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_070625e552f9adfb229fdd65c973894e5">URL</a></div></div>

                                                                                        </div>fileuploader



                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="control-group">
                                                                        <label class="control-label" for="point_modifier_0">Earned point modifier&nbsp;/ Type:</label>
                                                                        <div class="controls">
                                                                            <input type="text" id="point_modifier_0" name="option_data[variants][1][point_modifier]" value="0.000" size="5" class="input-mini">&nbsp;/&nbsp;<select name="option_data[variants][1][point_modifier_type]">
                                                                                <option value="A">(points)</option>
                                                                                <option value="P">(%)</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </fieldset>
                                                content_tab_option_variants_0</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>-->








        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
            <a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>

        </div>


    </form> 
</div>