<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>Add Newsletter</h3>
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
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 


                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">

                                                <div class="form-group has-error" >
                                                    <label class="col-md-2 control-label">Subject <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;">
                                                    <label class="col-md-2 control-label">Random subjects (one per line) <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                        <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label> 
                                                    </div>
                                                </div>


                                                <div class="form-group has-error" style="border:none;">

                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Html Body:</label>
                                                        <div class="col-md-10">
                                                            <textarea name="description"></textarea>
                                                            <script src="tinymce/tinymce.min.js"></script>  
                                                            <script>
                                                                tinymce.init({selector: 'textarea',
                                                                    theme: "modern",
                                                                    width: '95%',
                                                                    height: 300,
                                                                    plugins: [
                                                                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                                                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                                                        "save table contextmenu directionality emoticons template paste textcolor"
                                                                    ],
                                                                    content_css: "css/content.css",
                                                                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                                                                    style_formats: [
                                                                        {title: 'Bold text', inline: 'b'},
                                                                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                                                                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                                                                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                                                                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                                                                        {title: 'Table styles'},
                                                                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                                                                    ]
                                                                });
                                                            </script>  
                                                            <!--                                                            class for this = "wysiwyg"-->
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group has-error" style="border:none;" >

                                                        <div class="controls">
                                                            <div class="control-group cm-no-hide-input">
                                                                <label class="col-md-2 control-label" for="discussion_type">Template:</label>
                                                                <div class="controls">
                                                                    <select class="select1" name="reviews" id="discussion_type">
                                                                        <option value="B">No Template</option>
                                                                        <option value="C">Sample Layout</option>
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                    <div class="form-group has-error" style="border:none;" >

                                                        <div class="controls">
                                                            <div class="control-group cm-no-hide-input">
                                                                <label class="col-md-2 control-label" for="discussion_type">Campaign:</label>
                                                                <div class="controls">
                                                                    <select class="select1" name="reviews" id="discussion_type">
                                                                        <option value="B">none</option>
                                                                        
                                                                    </select>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                    
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="Active">Active</label>
                                                            <label class="radio inline" for="elm_product_status_0_d"><input type="radio" name="status" id="elm_product_status_0_d" value="Disable">Disabled</label>
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="Active">Sent    </label>
                                                        </div>
                                                    </div>
                                                    <div style="clear:both;"></div>




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
            <div class="tab-pane" id="tab_1_6">
                <div class="widget">
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
                                                <label class="col-md-2 control-label" for="elm_category_page_title">Page title&nbsp;<a class="cm-tooltip"><i class="icon-question-sign"></i></a>:</label>
                                                <div class="col-md-9"> <input type="text" name="metatitle" class="form-control required has-error" style="border-radius: 6px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-error" style="border-top:none;">

                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_category_meta_description">Meta description:</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control required has-error" style="border-radius: 6px;" name="metadescri" id="elm_category_meta_description" cols="55" rows="4" class="input-large"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group has-error" style="border-top:none;">

                                            <div class="control-group">
                                                <label class="col-md-2 control-label" for="elm_category_meta_description">Meta keywords:</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control required has-error" style="border-radius: 6px;" name="metaword" id="elm_category_meta_description" cols="55" rows="4" class="input-large"></textarea>
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
                                                <label for="age_verification" class="col-md-2 control-label">Age verification:</label>
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
                                                <label for="age_limit" class=" col-md-2 control-label">Age limit:</label>
                                                <div class="col-md-9">
                                                    <input   class="form-control required has-error" style="border-radius: 6px;width:200px;" type="text" id="age_limit" name="agelimit" size="10" maxlength="2" value="0" class="input-micro">
                                                    <span class="year"> &nbsp; years</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group has-error" style="border-top:none;">

                                            <div class="control-group">
                                                <label style="margin-top: 15px;" for="age_warning_message" class="col-md-2 control-label">Warning message:</label>
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
                                                    <label class="col-md-2 control-label" for="discussion_type">Reviews:</label>
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

            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
            <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->

        </div>


    </form> 
</div>