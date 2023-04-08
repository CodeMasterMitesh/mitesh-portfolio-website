

<?php
//
include_once ('../connection.php');
$sql = "select * from products where id='" . $_GET['id'] . "'";
$q = mysql_query($sql) or die(mysql_error() . $sql);
$r = mysql_fetch_assoc($q);
$image = explode(',', $r['image']);
//debug($_GET);
?>
<link href="css/main.css" rel="stylesheet" type="text/css"/>

<center>

    <div style="width:800px">
        <table border="0" style="width:700px;border:1px solid">
            <tr>
                <td style="border:none;"></td>
                <td>Contact Us:9876543211</td>

            </tr>
            <tr>
                <td><img src="images/logo3.png" style="margin:0px 0px 10px 10px;"></td>
                <td>order@cashondelivery.in</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center; font-size: 26px;padding: 5px;"> 
                    <?php echo $r['name'] ?>
                </td>
            </tr>
            <tr>
                <td><img src="files/<?php echo $r['banner'] ?>" style="width:500px;"></td>
                <td>
                    <table border="1" style="margin:10px;">
                        <tr>
                            <td>
                                <img src="files/<?php echo $image[0] ?>" style="width:100px;">
                            </td>
                            <td><img src="files/<?php echo $image[0] ?>" style="width:100px;"></td>
                        </tr>
                        <tr>
                            <td><img src="files/<?php echo $image[0] ?>" style="width:100px;"></td>
                            <td><img src="files/<?php echo $image[0] ?>" style="width:100px;"></td>
                        </tr>
                        <!--<img src="files/<?php // echo $image[1]  ?>" style="width:100px;">-->
                    </table>
                </td>

            </tr>

            <tr >
                <td colspan="2"> 
                    <label ></label>
                    <div class="detail" style="">
                        <?php echo $r['metadescri'] ?>
                    </div>

                </td>

            </tr>
            <tr>
                <td colspan="2" style="padding-left:20px;"> 
                    <?php
                    $video = $r['video'];
                    $parts = parse_url($video);
                    parse_str($parts['query'], $query);
                    ?>
                    <iframe width="420" height="315" src="http://www.youtube.com/embed/<?php echo $query['v']?>" 
                            frameborder="0" allowfullscreen></iframe>

                </td>


            </tr>
            <tr >
                <td colspan="2"> 
                    <label ></label>
                    <div class="detail" style="">
                        <?php echo $r['metaword'] ?>
                    </div>

                </td>

            </tr>
        </table>




    </div>


</center>
<style>
    *{
        padding: 0px;
        margin: 0px;
        font-family: sans-serif;
        outline: none;
        border-collapse: collapse;
    }
</style>

