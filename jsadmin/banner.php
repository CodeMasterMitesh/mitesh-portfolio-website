<?php
if (isset($_GET['del'])) {
    $sql = "delete from banner where id='" . $_GET['del'] . "'";
    $q = mysql_query($sql) or die(mysql_error());
    if ($q) {
        echo '<script>alert("Banner Record Deleted.");window.location="index.php?p=banner";</script>';
    }
}
?>

<div>
    <div class="page-header">
        <div class="page-title">
            <h3>Banner</h3>
        </div>
        <a href="index.php?p=addbanner">
            <button class="btn" style="float: right;margin: 25px;" title="Add Banner">
                <i class="icol-basket"></i> Add Banner</button>
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-content no-padding">
                    <table class="table table-striped table-bordered table-hover table-checkable table-tabletools"
                        id="example">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <?php
                        $sql = "select * from banner";
                        $q = mysql_query($sql);
                        while ($r = mysql_fetch_array($q)) {
                            //                    debug($r);
                        ?>
                        <tr>
                            <td class="checkbox-column"> <input type="checkbox" class="uniform"> </td>
                            <td><?php echo $r['image']; ?></td>
                            <td><?php echo $r['status']; ?></td>
                            <td><a href="index.php?p=editbanner&id=<?php echo $r['id'] ?>"><img
                                        src="images/file_edit.png"></a></td>
                            <td><a href="index.php?p=banner&del=<?php echo $r['id'] ?>"><img
                                        src="images/delete.png"></a></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.DTTT_button_csv div {
    display: none !important;
}

.DTTT_button_copy div {
    display: none !important;
}

.DTTT_button_xls div {
    display: none !important;
}

.DTTT_button_pdf div {
    display: none !important;
}
</style>

<script>
$(document).ready(function() {
    $(document).ready(function() {
        $('#example').dataTable({
            "iDisplayLength": -1,
            "aLengthMenu": [
                [-1, 10, 25, 50],
                ["All", 10, 25, 50]
            ]
        });
    });
});
</script>