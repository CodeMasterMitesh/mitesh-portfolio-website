<div>
    <div class="page-header" >
        <div class="page-title"> <h3>Feedback</h3> </div> 
        <a href="index.php?p=addfeedback">
            <button class="btn" style="float: right;margin: 25px;" title="Add Feedback">
                <i class="icol-basket"></i> Add Feedback</button>
        </a>
    </div>
    
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools dataTable">
                        <thead> 
                            <tr> 
                                <th class="checkbox-column"> <input type="checkbox" class="uniform"></th>
                                <th>Id</th> 
                                <th>Name</th> 
                                <th class="hidden-xs">E-mail</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr> 

                        </thead>

                        <?php
                        $sql = "select * from feedback1";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
                            ?>
                            <tr> 
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                                <td><?php echo $r['id']; ?></td> 
                                <td><?php echo $r['name']; ?></td> 
                                <td><a href="mailto:<?php echo $r['email']; ?>"><?php echo $r['email']; ?></a></td> 
                                <td style="width: 50px;"><?php echo $r['phone']; ?></td>
                                <td><?php echo $r['message']; ?></td>                               
                                <td><a href="index.php?p=editfeedback&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="feedbackdelete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        <?php } ?>
                    </table>
                </div>
            </div> 
        </div> 
    </div> 
    
</div>

<script>
   $(document).ready(function() {
        $(document).ready( function() {
            $('#example').dataTable( {
		 "iDisplayLength": -1,
		 "aLengthMenu": [[-1, 10, 25, 50], ["All", 10, 25, 50]]
            } );
	} );
   } );
</script>