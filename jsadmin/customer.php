<div>
    <div class="page-header" >
        <div class="page-title"> <h3>Customers</h3> </div> 
        <a href="index.php?p=addcustomer">
            <button class="btn" style="float: right;margin: 25px;" title="Add Customer">
                <i class="icol-basket"></i> Add Customer</button>
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
                                <th>Name</th> 
                                <th class="hidden-xs">E-mail</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr> 

                        </thead>

                        <?php
                        $sql = "select * from clients";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>

                                <td><?php echo $r['id']; ?></td> 
                                <td><?php echo $r['name']; ?></td> 

                                <td><a href="mailto:<?php echo $r['email']; ?>"><?php echo $r['email']; ?></a></td> 
                                <td> <span class="label label-success">Approved</span></td> 
                                <td><a href="index.php?p=editcustomer&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="customerdelete.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
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