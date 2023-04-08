<div>
    <div class="page-header"> 
        <div class="page-title">  <h3>Testimonial</h3> </div> 
        <a href="index.php?p=addtestimonial">
            <button class="btn" style="float: right;margin: 2px;" title="Add Testimonial">
                <i class="icol-basket"></i> Add Testimonial</button>
        </a>
    </div>

    <div class="row"> 
        <div class="col-md-12"> 
            <div class="widget box"> 
                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead>
                            <tr> 
                                <th>Sr. No.</th> 
                                <th>Name</th> 
                                
                                <th>Description</th>
                                <th>Status</th>
                                <th >Edit</th>
                                <th>Remove</th>
                            </tr> 
                        </thead>

                        <?php
                        $i = 1;
                        $sql = "select * from testimonial";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
//                    debug($r);
                            ?>
                            <tr> 
                              
                                <td><?php echo $i++;?></td> 
                                <td><?php echo $r['name']; ?></td> 
                               
                                <td><?php echo $r['description']; ?></td>
                                <td> <span class="label label-success">Approved</span></td> 
                                <td><a href="index.php?p=edittestimonial&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a href="del.php?id=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        <?php } ?>
                    </table> 
                </div> 
            </div> 
        </div> 
    </div> 
</div>
