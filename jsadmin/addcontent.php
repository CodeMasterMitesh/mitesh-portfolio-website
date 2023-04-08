<?php
if (isset($_POST['submit'])) {
    $sql = "insert into pages (`";
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
    if ($q)
        echo "<script>alert('New Page Created');window.location='index.php?p=content';</script>";
}
?>
<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Content</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <form class="form-horizontal row-border"  method="post"  action="" novalidate="novalidate">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1_1">
                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> User account information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 
                                        <table id="table">
                                            <tbody>
                                                <tr>
                                                    <td> 
                                                        <label style="width:125px;">Page Name:</label>   
                                                        <input class="select1" type="text" name="name" class="medium" class="form-control required has-error" autocomplete="off"> 
                                                    </td>
                                                    <td> 
                                                        <label style="width:125px;"> Page Link Place:</label>   
                                                        <select class="select1" name="pagelink">
                                                            <option>Main Menu</option>
                                                            <option>Home Page Sidebar</option> 
                                                            <option>Footer Info</option> 
                                                            <option>Customer Service</option>  
                                                        </select> 
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="c"> 
                                                        <label style="width:125px;"> URL:</label>   
                                                        <input class="select1"  type="text" name="url" class="medium" autocomplete="off">
                                                    </td>
                                                    <td>

                                                        <label style="width:125px;"> Sort:</label>   
                                                        <input class="select1"  type="text" name="sort" class=" medium" autocomplete="off">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label style="width:125px;"> Title URL:</label>
                                                        <input class="select1"  type="text" name="titleurl" class="medium" autocomplete="off">
                                                    </td>
                                                    <td>  
                                                        <label style="width:125px;"> Parent:</label>
                                                        <select name="parent" class="select1 ">
                                                            <option>Root</option>
                                                            <option>Services</option>
                                                            <option>Extra</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        
                                                        <label style="width:125px;"> Meta Keywords:</label>   
                                                        <input class="select1"  type="text" name="metakeyword" class="medium" autocomplete="off">
                                                    </td>
                                                    <td>

                                                        <label style="width:125px;"> Meta Description:</label>   
                                                        <input class="select1"  type="text" name="desc" class=" medium" autocomplete="off">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <label style="width:125px;">Page Data</label>


                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <div style="clear:both"></div>
                                                        <textarea name="pagedata" class="pagedata" id="pagedata"></textarea>
                                                    
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">
            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit" value="Submit"/>
        </div>
    </form>
</div>
<script type="text/javascript"> 
    
    
    CKEDITOR.replace('pagedata');
 </script>
 