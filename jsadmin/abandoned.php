<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Abandoned/Live Cart</h3> </div> 
<!--         <a href="index.php?p=addlanguage">
            <button class="btn" style="float: right;margin: 25px;" title="Add Language">
                <i class="icol-basket"></i> Add Language</button>
        </a>-->
    </div>  
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead>  
                            <tr> 
                                <th><input type="checkbox"></th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Cart content</th>
                                <th>IP</th>
                                <th>Wish list content</th>
                                
                                <th >Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                                    <td><a href="index.php?p=editlanguage&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                    <td><a href="index.php?p=language&del=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                                </tr> 
                            
                        </tbody>
                    </table>
                </div> 
            </div>
        </div> 
    </div> 
</div>