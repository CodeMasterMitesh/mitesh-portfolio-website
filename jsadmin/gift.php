<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Gift</h3>
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
                                                    <label class="col-md-2 control-label">To <span class="required">*</span></label> 
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-2 control-label">From <span class="required">*</span></label> 
                                                    <div class="col-md-9"> 
                                                        <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                    </div>
                                                </div>


                                                <div class="form-group has-error" style="border:none;">

                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Message</label>
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
                                                        <label class="col-md-2 control-label">Amount <span class="required">:</span></label> 
                                                        <div class="col-md-9"> 
                                                            <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label"><span class="required"></span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a"><input type="radio" name="status" id="elm_product_status_0_a" checked="checked" value="A">Send Via Email</label>

                                                            <label class="radio inline" for="elm_product_status_0_h"><input type="radio" name="status" id="elm_product_status_0_h" value="H">Send via postal mail</label>


                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border:none;" >
                                                        <label class="col-md-2 control-label">Email <span class="required">*</span></label> 
                                                        <div class="col-md-9"> 
                                                            <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px;">
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
            
        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
            <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->

        </div>


    </form> 
</div>