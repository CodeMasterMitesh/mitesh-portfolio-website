<?php
if (isset($_POST['submit'])) {
//    debug($_POST);
//    exit;
   $sql = "insert into category (`";
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
    echo $sql;
    exit;
    $q = mysql_query($sql) or die(mysql_error());
    if ($q)
        echo "<script>alert('New category Created');window.location='index.php?p=categories';</script>";
}
?>






<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Category</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Add-ons</a></li>
        <li class=""><a href="#tab_1_3" data-toggle="tab">Layout</a></li>
        <li class=""><a href="#tab_1_4" data-toggle="tab">Reward points</a></li>
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
                                                    <label class="col-md-3 control-label">Category <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <?php echo getoptn('pcid', 'name', 'id', 'category', 'select1', 'id="select"', '', 'None'); ?><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>




                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-3 control-label">Name <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-3 control-label">Header <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="header" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>

                                                <div class="form-group has-error" style="border-top:none;">
                                                    <label class="col-md-3 control-label" for="elm_category_parent_id">Location:</label>

                                                    <div class="controls" >
                                                        <select class="select1" name="location" id="elm_category_parent_id" >
                                                            <option value="0">- Root level -</option>
                                                            <option value="166">Electronics</option>
                                                            <option value="167">Computers</option>
                                                            <option value="168">Desktops</option>
                                                            <option value="169">Laptops</option>
                                                            <option value="165">Tablets</option>
                                                            <option value="170">Monitors</option>
                                                            <option value="171">Networking</option>
                                                            <option value="172">Printers  Scanners</option>
                                                            <option value="201">Processors</option>
                                                            <option value="175">Car Electronics</option>
                                                            <option value="176">GPS  Navigation</option>
                                                            <option value="185">In-Dash Stereos</option>
                                                            <option value="186">Speakers</option>
                                                            <option value="202">Subwoofers</option>
                                                            <option value="187">Amplifiers</option>
                                                            <option value="188">Car DVD  Video</option>
                                                            <option value="189">Radar Detectors</option>
                                                            <option value="174">TV  Video</option>
                                                            <option value="190">LED TVs</option>
                                                            <option value="191">Plasma TVs</option>
                                                            <option value="193">3D TVs</option>
                                                            <option value="194">DVD  Blu-ray Players</option>
                                                            <option value="195">Home Theater Systems</option>
                                                            <option value="234">Cell Phones</option>
                                                            <option value="235">Apple iPhone</option>
                                                            <option value="236">HTC</option>
                                                            <option value="240">Motorola</option>
                                                            <option value="238">Nokia</option>
                                                            <option value="237">Samsung</option>
                                                            <option value="177">MP3 Players</option>
                                                            <option value="178">iPods</option>
                                                            <option value="182">Android</option>
                                                            <option value="179">MP3 Players</option>
                                                            <option value="180">MP3 Speaker Systems</option>
                                                            <option value="181">Headphones</option>
                                                            <option value="196">Cameras  Photo</option>
                                                            <option value="198">Digital Cameras</option>
                                                            <option value="197">DSLR Cameras</option>
                                                            <option value="199">Camcorders</option>
                                                            <option value="200">Lenses</option>
                                                            <option value="254">Apparel</option>
                                                            <option value="255">Men</option>
                                                            <option value="228">Music</option>
                                                            <option value="229">Blues</option>
                                                            <option value="230">Classical</option>
                                                            <option value="231">Jazz</option>
                                                            <option value="232">Rock</option>
                                                            <option value="241">Movies  TV</option>
                                                            <option value="242">Blu-ray Discs</option>
                                                            <option value="243">Movies (DVD)</option>
                                                            <option value="244">TV Shows (DVD)</option>
                                                            <option value="245">Video Games</option>
                                                            <option value="246">Nintendo Wii</option>
                                                            <option value="247">PlayStation 3</option>
                                                            <option value="249">PlayStation Vita</option>
                                                            <option value="248">Xbox 360</option>
                                                            <option value="250">Office Supplies</option>
                                                            <option value="251">Calculators</option>
                                                            <option value="252">Desk Accessories</option>
                                                            <option value="253">Safes</option>
                                                        </select>
                                                    </div>
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

                                                                                    <input type="hidden" name="image" value="product_main" id="file_d3385f69ba092704fbb9bb3dd5345402"><input type="hidden" name="image" value="local" id="type_d3385f69ba092704fbb9bb3dd5345402"><div class="btn-group " id="link_container_d3385f69ba092704fbb9bb3dd5345402"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Local</span></a><div class="image-selector"><label for=""><input type="file" name="image" id="local_d3385f69ba092704fbb9bb3dd5345402" onchange="Tygh.fileuploader.show_loader(this.id);
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

                                                                                    <input type="hidden" name="image" value="product_main" id="file_608714aa73b5ced0b2509ebc3c42edd0"><input type="hidden" name="image" value="local" id="type_608714aa73b5ced0b2509ebc3c42edd0"><div class="btn-group " id="link_container_608714aa73b5ced0b2509ebc3c42edd0"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Local</span></a><div class="image-selector"><label for=""><input type="file" name="image" id="local_608714aa73b5ced0b2509ebc3c42edd0" onchange="Tygh.fileuploader.show_loader(this.id);
                                                                        Tygh.fileuploader.check_required_field('608714aa73b5ced0b2509ebc3c42edd0', '');" class="file" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_608714aa73b5ced0b2509ebc3c42edd0">URL</a></div></div>

                                                                            </div>fileuploader                                                                        </div>

                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" style="border-top:none;">
                                                        <div class="control-group">
                                                            <label class="col-md-2 control-label">Banner:</label>
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
                                                                <input type="hidden" name="banner" value="" class="cm-image-field">
                                                                <input type="hidden" name="banner" value="M" class="cm-image-field">
                                                                <input type="hidden" name="banner" value="0" class="cm-image-field">

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

                                                                                    <input type="text" id="alt_icon_product_main_0" name="product_main_image_data[0][image_alt]" value="">
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

                                                                                    <input type="hidden" name="banner" value="product_main" id="file_d3385f69ba092704fbb9bb3dd5345402"><input type="hidden" name="banner" value="local" id="type_d3385f69ba092704fbb9bb3dd5345402"><div class="btn-group " id="link_container_d3385f69ba092704fbb9bb3dd5345402"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Local</span></a><div class="image-selector"><label for=""><input type="file" name="banner" id="local_d3385f69ba092704fbb9bb3dd5345402" onchange="Tygh.fileuploader.show_loader(this.id);
                                                                        Tygh.fileuploader.check_required_field('d3385f69ba092704fbb9bb3dd5345402', '');" class="file" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_d3385f69ba092704fbb9bb3dd5345402">URL</a></div></div>

                                                                            </div>fileuploader                                                                       </div>
                                                                    </div>                                                                    <div class="upload-box clearfix">
                                                                        <div class="pull-left image-wrap" style="margin-left: 150px;">
                                                                            <div class="image">
                                                                                <div class="no-image"><i class="glyph-image" title="No image"></i></div>
                                                                            </div>

                                                                            <div class="image-alt">
                                                                                <div class="input-prepend">

                                                                                    <span class="add-on cm-tooltip cm-hide-with-inputs"><i class="icon-comment"></i></span>
                                                                                    <input class="form-control required has-error" style="border-radius: 6px;" type="text" id="alt_det_product_main_0" name="banner" value="">
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

                                                                                    <input type="hidden" name="banner" value="product_main" id="file_608714aa73b5ced0b2509ebc3c42edd0"><input type="hidden" name="banner" value="local" id="type_608714aa73b5ced0b2509ebc3c42edd0"><div class="btn-group " id="link_container_608714aa73b5ced0b2509ebc3c42edd0"><div class="upload-file-local"><a class="btn"><span data-ca-multi="Y" class="hidden">Upload another file</span><span data-ca-multi="N">Local</span></a><div class="image-selector"><label for=""><input type="file" name="banner" id="local_608714aa73b5ced0b2509ebc3c42edd0" onchange="Tygh.fileuploader.show_loader(this.id);
                                                                        Tygh.fileuploader.check_required_field('608714aa73b5ced0b2509ebc3c42edd0', '');" class="file" data-ca-empty-file="" onclick="Tygh.$(this).removeAttr('data-ca-empty-file');"></label></div></div><a class="btn" onclick="Tygh.fileuploader.show_loader(this.id);" id="url_608714aa73b5ced0b2509ebc3c42edd0">URL</a></div></div>

                                                                            </div>fileuploader
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="border-top:none;">
                                                            <label class="col-md-3 control-label">Subcatimg<span class="required">*</span></label>
                                                            <div class="controls" style="float:left;">
                                                                <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="subcatimg" id="elm_product_status_0_a" checked="checked" value="A">Yes</label>

                                                                <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="subcatimg" id="elm_product_status_0_h" value="H">No</label>


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
                                                        <label class="radio inline" for="elm_product_status_0_d"><input type="checkbox" name="usergroup" id="elm_product_status_0_d" value="D">Apply to all subcategories</label>
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
                    <!--                <div class="widget-header">
                                        <h4><i class="icon-reorder"></i> Accordion</h4>
                                        <div class="toolbar">
                                            <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                                        </div>
                                    </div>-->

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
                                                <div class="col-md-9">
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
                                                <label for="age_warning_message" class="col-md-3 control-label">Warning message:</label>
                                                <div class="col-md-9">
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
            <div class="tab-pane" id="tab_1_3">

                <div class="widget">
                    <!--                <div class="widget-header">
                                        <h4><i class="icon-reorder"></i> Accordion</h4>
                                        <div class="toolbar">
                                            <div class="btn-group"> <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span> </div>
                                        </div>
                                    </div>-->

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
                                                <label class="col-md-3 control-label" for="elm_category_product_layout">Product details layout&nbsp;<a class="cm-tooltip" title="By default, the template that is defined in the appearance settings of the storefront is used"><i class="icon-question-sign"></i></a>:</label>
                                                <div class="col-md-9">
                                                    <select class="select1" id="elm_category_product_layout" name="productdetail">
                                                        <option value="default">Parent (Default template)</option>
                                                        <option value="default_long_options_template">Default template (long product option names)</option>
                                                        <option value="default_template">Default template</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group has-error" style="border:none;" >

                                            <div class="control-group">
                                                <label for="age_verification" class="col-md-3 control-label">Use custom layout:</label>
                                                <div class="col-md-9">
                                                    <input type="hidden" name="category_data[age_verification]" value="N">
                                                    <span class="checkbox">
                                                        <input type="checkbox" id="age_verification" name="customlayout" value="Y">
                                                    </span>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="form-group has-error" style="border-top:none;">

                                            <div class="control-group">
                                                <label for="age_limit" class=" col-md-3 control-label">Product columns:</label>
                                                <div class="col-md-9">
                                                    <input   class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="productcolumn" size="10" maxlength="2" class="input-micro">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group has-error" style="border:none;" >

                                            <label class="col-md-3 control-label">Available layouts:</label>
                                            <div class="controls" style="float:left;">
                                                <label class="radio inline" for="elm_product_status_0_a"><input type="checkbox" name="availablelayout" id="elm_product_status_0_a" checked="checked" value="A">Grid</label>

                                                <label class="radio inline" for="elm_product_status_0_h"><input type="checkbox" name="availablelayout" id="elm_product_status_0_h" value="H">List without options</label>


                                                <label class="radio inline" for="elm_product_status_0_d"><input type="checkbox"  name="availablelayout" id="elm_product_status_0_d" value="D">Compact list</label>
                                            </div>
                                        </div>

                                        <div class="form-group has-error" style="border:none;" >
                                            <div class="control-group">
                                                <label class="col-md-3 control-label" for="elm_category_default_layout">Default category layout:</label>
                                                <div class="controls">
                                                    <select class="select1" id="elm_category_default_layout" class="cm-combo-select cm-toggle-element" name="defaultcategory">
                                                        <option value="products_multicolumns">Grid</option>
                                                        <option value="products_without_options">List without options</option>
                                                        <option value="short_list">Compact list</option>
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
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

            <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;"> Create</a>-->
            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
            <a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>

        </div>
    </form>
</div>

