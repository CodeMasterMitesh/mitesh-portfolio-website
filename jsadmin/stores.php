<div>
    <div class="page-header" > 
        <div class="page-title"> <h3>Stores</h3> </div> 
         <a href="index.php?p=addstores">
            <button class="btn" style="float: right;margin: 25px;" title="Add stores">
                <i class="icol-basket"></i> Add Stores</button>
        </a>
    </div>  
    <div class="row"> 
        <div class="col-md-12"> 

            <div class="widget box"> 

                <div class="widget-content no-padding"> 
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools datatable">
                        <thead>  
                            <tr> 
                                <th></th>
                                <th>Name</th>
                                <th>Storefront</th>
                                <th>Registered</th>
                                
                                <th >Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                                    <td><a href="index.php?p=editstores&id=<?php echo $r['id'] ?>"><img src="images/file_edit.png"></a></td>
                                    <td><a href="index.php?p=stores&del=<?php echo $r['id'] ?>"><img src="images/delete.png"></a></td>
                                </tr> 
                            
                        </tbody>
                    </table>
                </div> 
            </div>
        </div> 
    </div> 
</div>