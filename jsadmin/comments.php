<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Comments or Reviews</h3> </div> 
<!--        <a href="index.php?p=addcomment">
            <button class="btn" style="float: right;margin: 25px;" title="Add Coupon">
                <i class="icol-basket"></i> Add Comment or Review</button>
        </a>-->
    </div>
    <div class="row"> 
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead> 
                            <tr> 
                                <th class="checkbox-column"> <input type="checkbox" class="uniform"> </th>
                                <th>Product id</th> 
                                <th>Name</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th >Edit</th>
                                <th>Remove</th>

                            </tr> 

                        </thead>

                        <?php
                        $sql = "select * from  productreview";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
                            $p=getproductbyid($r['pid']);
//                    debug($r);
                            ?>
                            <tr> 
                                <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                                <td><?php echo $p['id']; ?> </td> 
                                <td><?php echo $p['name']; ?></td>
                                <td><?php echo $r['review']; ?></td> 
                                <td ><?php echo $r['rating']; ?></td> 
                                <td ><?php if($r['allow']){?><span class="label label-success">Approved</span><?php }else{?><span class="label label-warning">Waiting For Approval</span><?php }?></td>
                                <td><?php echo mysql2dmy($r['date']); ?></td>
                                <td><a href="index.php?p=editcomment&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                <td><a  href="index.php?p=comments&del=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                            </tr> 
                        <?php } ?>


                    </table> 
                </div>
            </div> 
        </div> 
    </div> 
</div>

