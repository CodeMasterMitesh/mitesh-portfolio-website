<?php
if (isset($_POST['submit'])) {
    $sql = "insert into banner (`";
    foreach ($_FILES as $a => $b) {
        if (is_array($b['name'])) {
            $pa[] = $a;
            $b['name'] = array_unique(array_values(array_filter($b['name'])));
            $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
            for ($i = 0; $i < count($b['name']); $i++) {
                $b['name'][$i] = time() . '-' . $b['name'][$i];
                move_uploaded_file($b['tmp_name'][$i], '../files/' . $b['name'][$i]);
            }
            $pb[] = implode(',', $b['name']);
        } elseif (is_array($b)) {
            $pa[] = $a;
            $b['name'] = time() . '-' . $b['name'];
            move_uploaded_file($b['tmp_name'], '../files/' . $b['name']);
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
            } else {
                $pa[] = $a;
                if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                    $pb[] = dmy2mysql($b);
                else
                    $pb[] = mysql_escape_string($b);
            }
        }
    }
    $sql .= implode('`,`', $pa) . "`) values('" . implode("','", $pb) . "')";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q)
        echo "<script>alert('New Banner Created'); window.location='index.php?p=banner';</script>";
}
?>

<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Banner</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <!--        <li class=""><a href="#tab_1_4" data-toggle="tab">Reward points</a></li>-->
    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post" enctype="multipart/form-data" action=""
        novalidate="novalidate">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseOne"> Information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                <!-- <div class="form-group has-error" >
                                                    <label class="col-md-2 control-label">Name <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="name" class="form-control required has-error" style="border-radius: 6px; width: 300px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div> -->
                                                <!--                                                <div class="form-group has-error" style="border:none;" >
                                                    <label class="col-md-2 control-label">Pos. <span class="required">*</span></label> 
                                                    <div class="col-md-9"> <input type="text" name="pos" class="form-control required has-error" style="border-radius: 6px;width:250px;"><label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                                </div>-->
                                                <!--                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_category_default_layout">Type</label>
                                                        <div class="controls">
                                                            <select class="select1" id="elm_category_default_layout" class="cm-combo-select cm-toggle-element" name="type">
                                                                <option>Graphic banner</option>
                                                                <option>Text banner</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Image:</label>
                                                        <div class="col-md-10">
                                                            <input type="file" name="image" style="width: 300px;"
                                                                class="form-control required has-error" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Mobile Image:</label>
                                                        <div class="col-md-10">
                                                            <input type="file" name="mobileimage" style="width: 300px;"
                                                                class="form-control required has-error" required>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-4 control-label">Open in new window<span class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline" for="elm_product_status_0_a">
                                                                <input type="checkbox" name="newwindow" id="elm_product_status_0_a"  value="yes"></label>
                                                        </div>
                                                    </div>-->
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Heading:</label>
                                                        <div class="col-md-10">
                                                            <textarea name="heading" id="ebody"></textarea>
                                                            <script src="tinymce/tinymce.min.js"></script>
                                                            <script>
                                                            tinymce.init({
                                                                selector: 'textarea',
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
                                                                style_formats: [{
                                                                        title: 'Bold text',
                                                                        inline: 'b'
                                                                    },
                                                                    {
                                                                        title: 'Red text',
                                                                        inline: 'span',
                                                                        styles: {
                                                                            color: '#ff0000'
                                                                        }
                                                                    },
                                                                    {
                                                                        title: 'Red header',
                                                                        block: 'h1',
                                                                        styles: {
                                                                            color: '#ff0000'
                                                                        }
                                                                    },
                                                                    {
                                                                        title: 'Example 1',
                                                                        inline: 'span',
                                                                        classes: 'example1'
                                                                    },
                                                                    {
                                                                        title: 'Example 2',
                                                                        inline: 'span',
                                                                        classes: 'example2'
                                                                    },
                                                                    {
                                                                        title: 'Table styles'
                                                                    },
                                                                    {
                                                                        title: 'Table row 1',
                                                                        selector: 'tr',
                                                                        classes: 'tablerow1'
                                                                    }
                                                                ]
                                                            });
                                                            </script>
                                                            <!-- class for this = "wysiwyg" -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Sub Description:</label>
                                                        <div class="col-md-10">
                                                            <textarea name="subdec" id="ebody"></textarea>
                                                            <script src="tinymce/tinymce.min.js"></script>
                                                            <script>
                                                            tinymce.init({
                                                                selector: 'textarea',
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
                                                                style_formats: [{
                                                                        title: 'Bold text',
                                                                        inline: 'b'
                                                                    },
                                                                    {
                                                                        title: 'Red text',
                                                                        inline: 'span',
                                                                        styles: {
                                                                            color: '#ff0000'
                                                                        }
                                                                    },
                                                                    {
                                                                        title: 'Red header',
                                                                        block: 'h1',
                                                                        styles: {
                                                                            color: '#ff0000'
                                                                        }
                                                                    },
                                                                    {
                                                                        title: 'Example 1',
                                                                        inline: 'span',
                                                                        classes: 'example1'
                                                                    },
                                                                    {
                                                                        title: 'Example 2',
                                                                        inline: 'span',
                                                                        classes: 'example2'
                                                                    },
                                                                    {
                                                                        title: 'Table styles'
                                                                    },
                                                                    {
                                                                        title: 'Table row 1',
                                                                        selector: 'tr',
                                                                        classes: 'tablerow1'
                                                                    }
                                                                ]
                                                            });
                                                            </script>
                                                            <!-- class for this = "wysiwyg" -->
                                                        </div>
                                                    </div>
                                                    <!-- <div class="form-group" style="border-top:none;">
                                                       <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Link:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" name="link" style="width: 200px;" class="form-control required has-error">               
                                                        </div>
                                                    </div>  -->
                                                    <div class="form-group has-error" style="border:none;">
                                                        <label class="col-md-2 control-label">Creation Date <span
                                                                class="required">*</span></label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="creationdate"
                                                                value="<?php echo date('d/m/Y'); ?>"
                                                                class="form-control required has-error datepicker"
                                                                style="width: 150px;border-radius: 6px;"><label
                                                                for="req1" generated="true" class="has-error help-block"
                                                                style="color:#fff;">.</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <label class="col-md-2 control-label">Status<span
                                                                class="required">*</span></label>
                                                        <div class="controls" style="float:left;">
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_a"><input type="radio"
                                                                    name="status" id="elm_product_status_0_a"
                                                                    checked="checked" value="Active">Active</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_h"><input type="radio"
                                                                    name="status" id="elm_product_status_0_h"
                                                                    value="Hidden">Hidden</label>
                                                            <label class="radio inline"
                                                                for="elm_product_status_0_d"><input type="radio"
                                                                    name="status" id="elm_product_status_0_d"
                                                                    value="Disabled">Disabled</label>
                                                        </div>

                                                    </div>
                                                    <div class="form-group" style="border-top:none;">
                                                        <div class="form-group" style="border-top:none;">
                                                            <label class="col-md-2 control-label">Sort:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" name="sort" style="width: 200px;"
                                                                    class="form-control required has-error">
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
                <input type="submit" class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;"
                    name="submit" />
                <!--<a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>-->
            </div>
    </form>
</div>
<script type="text/javascript">
var data = CKEDITOR.instances['body'].getData();

var editor = CKEDITOR.replace('description', {
    filebrowserBrowseUrl: '../ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '../ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl: '../ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: '../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
CKFinder.setupCKEditor(editor, '../');


CKEDITOR.replace('description');
</script>