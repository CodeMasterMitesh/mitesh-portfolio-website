<div>
    <div class="page-header" >
        <div class="page-title"> <h3>Size </h3> </div> 
        <a href="index.php?p=addsize">
            <button class="btn" style="float: right;margin: 25px;" title="Add Review">
                <i class="icol-basket"></i> Add Size</button>
        </a>
    </div>
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools" id="example">
                        <thead> 
                            <tr> 
                                <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th>
                                <th>Id</th> 
                                <th>Size</th> 
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr> 

                        </thead>

                        <?php
                        $sql = "select * from sizemaster";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>

                                <td><?php echo $r['id']; ?></td> 
                                <td><?php echo $r['size']; ?></td> 
                                <td><a href="index.php?p=editsize&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="sizedelete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
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

