<form id="chats" onsubmit="return sendchat();" method="post">
    <div   style="border:1px solid #d5d5d5;border-radius: 5px; width:440px; overflow-y: scroll; height:500px; background: #fff; margin-bottom: 7px; color:#000; padding:3px;">
        <?php
        $sql = "select * from chat where sessionid like '" . $_GET['id'] . "'";
        $q = mysql_query($sql) or die(mysql_error() . $sql);
        while ($r = mysql_fetch_assoc($q)) {
            $name=$r['name'];
            $mobile=$r['mobile'];
            $email=$r['email'];
            
            echo "<div style='text-align:left;'><b>" . $r['from'] . " : </b>" . $r['message'] . "</div>";
        }
        
        ?>
    </div>
    <input type="hidden" name="name" value="<?php echo $name;?>"/>
    <input type="hidden" name="email" value="<?php echo $email;?>"/>
    <input type="hidden" name="mobile" value="<?php echo $mobile;?>"/>
    <textarea  style="width:280px; height:40px;float: left;border-radius: 5px;" name="msg"></textarea>
    <input type="submit" class="button buy" name="sent" value="Send" style="float: left; width: 150px;height:40px; margin-left: 5px;"/>
</form> 
<script>

function sendchat(){
    $.ajax({
        type:"POST",
        url:"ajax/chatinsert.php",
        data:$('#chats').serialize()               
    }).done(function(msg){
        getchats();
    });
    return false;
}
function getchats(){
    $.ajax({
        type:"POST",
        url:"ajax/getchats.php",
        data:$('#chats').serialize()               
    }).done(function(msg){
        $('#chats div').html(msg);
    });
}
setInterval("getchats()", 3000);
</script>