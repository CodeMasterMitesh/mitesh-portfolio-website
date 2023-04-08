<?php
if (isset($_POST['save'])) {
    foreach ($_POST as $a => $b) {
        if ($a != 'save') {
            $sql = "replace into settings (`name`,`value`) values('" . $a . "','" . $b . "')";
            $q = mysql_query($sql) or die(mysql_error() . $sql);
        }
    }
    if ($q)
        echo "<script>alert('Setting saved');window.location='index.php?p=thumbnailsetting';</script>";
}

function getdata($name) {
    $sql1 = "select * from settings where name like '" . $name . "'";
    $q1 = mysql_query($sql1) or die(mysql_error() . $sql1);
    $r = mysql_fetch_assoc($q1);
    return $r['value'];
}

//    $sql1="select * from settings where name like 'ship_%'";
//    $q1= mysql_query($sql1) or die(mysql_error().$sql1);    
//    while($r=  mysql_fetch_assoc($q1)){
//        debug($r);
//    }
?>



<form class="form-horizontal row-border"  method="post"  action="" novalidate="novalidate">
    <div>
        <div class="page-header" > 
            <div class="page-title"> <h3> Settings: Thumbnails</h3> </div> 
            <a href="index.php?p=shippingsetting">

            </a>
        </div>
    </div>




    <div class="panel panel-default" style="vertical-align: top; margin-top: 10px;">
        <div class="panel-heading " style="vertical-align: top;">
            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="">Thumbnail settings  </a> </h3>
        </div>
        <!--                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">-->
        <div class="panel-body" style="vertical-align: top;"> 


            <div class="" style="border:none; vertical-align: top;">
                <!--                                    <div class="widget-content">-->

                <style>
                     .email_table td:nth-child(1){
                       width:300px;
                    }
                    .email_table td:nth-child(3){
                        padding-left: 10px;
                    }
                </style>
                <table style="width: 100%;line-height: 50px;" class="email_table">

                    <tr>

                        <td>
                           Thumbnail background color:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Thumbnail format:
                        </td>
                        <td>

                            <select name="" class="form-control required has-error" style="border-radius: 6px;width:150px;">
                                            <option value="original" selected="selected">same as source</option>
                                            <option value="gif">GIF</option>
                                            <option value="jpg">JPEG</option>
                                            <option value="png">PNG</option>
                                    </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            JPEG format quality (0-100):
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                         Products list (category, search, etc) thumbnail width:
                        </td>
                        <td> 
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                    </tr>
                    <tr>

                        <td>
                           Products list (category, search, etc) thumbnail height:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                            Product details page thumbnail width:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>
                     <tr>

                        <td>
                           Product details page thumbnail height:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                           Product quick view thumbnail width:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>
                     <tr>

                        <td>
                           Detailed product image height:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                          Product cart page thumbnail width:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>
                     <tr>

                        <td>
                          Product cart page thumbnail height:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                           Categories list thumbnail width:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>
                     <tr>

                        <td>
                          Categories list thumbnail height:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                          Category details page thumbnail width:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>
                     <tr>

                        <td>
                          Category details page thumbnail height:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        <td>
                          Detailed category image width:
                        </td>
                        <td>

                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>
                    </tr>
                     <tr>

                        <td>
                          Detailed category image height:
                        </td>
                        <td>
                            <input type="text" name="" class="form-control required has-error" style="border-radius: 6px;">
                        </td>

                        
                    </tr>

                    
                </table>


            </div>
        </div>
    </div>
    



    <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

        <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="save" value="Save"/>

    </div>
</form>


