<div>
    <div class="page-header">
        <div class="page-title"> <h3>Live Chat</h3> </div> 
    </div>  
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead> 
                            <tr> 
                                <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th>
                                <th>Name</th> 
                                <th>Email</th> 
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Chat</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $sql = "select * from chat group by sessionid";
                            $q = mysql_query($sql);
                            while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                                ?>
                                <tr> 
                                    <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                                    <td><?php echo $r['name']; ?></td>
                                    <td><?php echo $r['email']; ?></td>
                                    <td><?php echo $r['mobile']; ?></td>
                                    <td><?php echo $r['status']; ?></td>
                                    <td><a href="index.php?p=editchat&id=<?php echo $r['sessionid'] ?>"><img src="images/chaticon.png"></a></td>
                                    <td><a href="livechat.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                                </tr> 
                            <?php } ?>
                        </tbody>

                    </table> 
                </div> 
            </div> 
        </div> 
    </div>
</div>
<script>
//    function getadminchat(){
//        $.ajax({
//            url:"ajax/getchattoadmin.php",
//            type:"post",
//            data:{name:}
//            
//        })
//    }
</script>