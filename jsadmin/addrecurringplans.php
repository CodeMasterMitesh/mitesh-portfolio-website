<?php
if (isset($_POST['submit'])) {
    $sql = "insert into products (`";
    foreach ($_FILES as $a => $b) {
        if (is_array($b['name'])) {
            $pa[] = $a;
            $b['name'] = array_unique(array_values(array_filter($b['name'])));
            $b['tmp_name'] = array_unique(array_values(array_filter($b['tmp_name'])));
            for ($i = 0; $i < count($b['name']); $i++) {
                $b['name'][$i] = time() . '-' . $b['name'][$i];
                move_uploaded_file($b['tmp_name'][$i], 'files/' . $b['name'][$i]);
            }
            $pb[] = implode(',', $b['name']);
        } elseif (is_array($b)) {
            $pa[] = $a;
            $b['name'] = time() . '-' . $b['name'];
            move_uploaded_file($b['tmp_name'], 'files/' . $b['name']);
            $pb[] = $b['name'];
        }
    }
    foreach ($_POST as $a => $b) {
        if ($a != 'submit') {
            if (is_array($b)) {
                $pa[] = $a;
                unset($pb1);
                for ($i = 0; $i < count($b); $i++) {
                    $b[$i] = mysql_escape_string($b[$i]);
                    if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                        $pb1[] = dmy2mysql($b[$i]);
                    else
                        $pb1[] = $b[$i];
                }
                $pb[] = implode(',', $pb1);
            }
            else {
                $pa[] = $a;
                if (strpos($a, "time") || $a == 'time' || strpos($a, "datetime") || $a == 'datetime' || strpos($a, "date") || $a == 'date')
                    $pb[] = dmy2mysql($b);
                else
                    $pb[] = mysql_escape_string($b);
            }
        }
    }

    $sql.=implode('`,`', $pa) . "`) values('" . implode("','", $pb) . "')";
    $q = mysql_query($sql) or die(mysql_error());
    // debug($_POST);
    if ($q)
        echo "<script>alert('New Product Created'); window.location='index.php?p=vieweditproduct';</script>";
}
?>




<div class="page-header" style="margin: 20px;">
    <div class="page-title">
        <h3>New Features</h3>
    </div>
</div>
<div class="tabbable tabbable-custom" style="margin: 20px;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1_1" data-toggle="tab">General</a></li>
        <li class=""><a href="#tab_1_2" data-toggle="tab">Product</a></li>     

    </ul>
    <form class="form-horizontal row-border" id="validate-1" method="post"  action="" novalidate="novalidate">
        <div class="tab-content">


            <div class="tab-pane active" id="tab_1_1">

                <div class="widget">
                    <div class="widget-content">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default" style="margin-left: -5px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Information </a> </h3>
                                </div>
                                <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body"> 


                                        <div class="widget box" style="border:none;">
                                            <div class="widget-content">
                                                
                                                <div class="form-group has-error" >

                                                    <div class="control-group">
                                                        <label for="elm_filter_name_0" class="col-md-2 control-label">Name<span class="required">*</span></label>
                                                        <div class="col-md-10">
                                                            <input type="text" id="elm_filter_name_0" name="Name" class="addimage form-control required has-error" style="border-radius: 6px;" value="">
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="form-group has-error" style="border:none;">

                                                    <div class="control-group">
                                                        <label for="elm_recurring_plan_period" class="col-md-2 control-label">Recurring period</label>
                                                        <div class="col-md-10">
                                                            <select class="select1" id="elm_recurring_plan_period" name="recurring_plan[period]" onchange="fn_change_recurring_period(this);">
                                                                <option value="A">Annually</option>
                                                                <option value="Q">Quarterly</option>
                                                                <option value="M">Monthly</option>
                                                                <option value="W">Weekly</option>
                                                                <option value="P">By period</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="form-group has-error" style="border:none;">

                                                    <div class="control-group" id="pay_day_holder">
                                                        <label for="elm_recurring_plan_pay_day" class="col-md-2 control-label">Pay day:</label>
                                                        <div class="col-md-10">
                                                            <!--<input type="text" name="recurring_plan[pay_day]" value="" size="10" class="addimage form-control required has-error">-->
                                                            <select  class="select1 input-small hidden" name="recurring_plan[pay_day]" disabled="disabled">
                                                                <option value="0" selected="selected">Sun</option>
                                                                <option value="1">Mon</option>
                                                                <option value="2">Tue</option>
                                                                <option value="3">Wed</option>
                                                                <option value="4">Thu</option>
                                                                <option value="5">Fri</option>
                                                                <option value="6">Sat</option>
                                                            </select>

                                                            <select class="select1 input-small " name="recurring_plan[pay_day]" id="elm_recurring_plan_pay_day" class="addimage form-control required has-error">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                                <option value="29">29</option>
                                                                <option value="30">30</option>
                                                                <option value="31">31</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="form-group has-error" style="border:none;">
                                                    <div class="control-group">
                                                        <label for="elm_recurring_plan_price" class="col-md-2 control-label">Recurring price:</label>
                                                        <div class="col-md-10">
                                                            <select class="select1"name="recurring_plan[price_type]" onchange="fn_toggle_recurring_price(this, 'elm_recurring_plan_price');">
                                                                <option value="original">original</option>
                                                                <option value="to_percentage">to percentage of the original price</option>
                                                                <option value="by_percentage">by percentage of the original price</option>
                                                                <option value="to_fixed">to fixed amount</option>
                                                                <option value="by_fixed">by fixed amount</option>
                                                            </select>&nbsp;
                                                            <!--<input type="text" name="recurring_plan[price_value]" id="elm_recurring_plan_price" value="0" size="10" class="input-micro hidden-input">-->
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group has-error" style="border-top:none;">
                                                    <div class="control-group">
                                                        <label for="elm_recurring_plan_duration" class="col-md-2 control-label">Recurring duration (months):</label>
                                                        <div class="col-md-10">
                                                            <input class="addimage form-control required has-error" style="width:180px;border-radius: 6px;"type="text" name="recurring_plan[duration]" id="elm_recurring_plan_duration" value="" size="10">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_recurring_plan_start_price">Recurring start price:</label>
                                                        <div class="col-md-10">
                                                            <select class="select1" name="recurring_plan[start_price_type]" onchange="fn_toggle_recurring_price(this, 'elm_recurring_plan_start_price');">
                                                                <option value="original">original</option>
                                                                <option value="to_percentage">to percentage of the original price</option>
                                                                <option value="by_percentage">by percentage of the original price</option>
                                                                <option value="to_fixed">to fixed amount</option>
                                                                <option value="by_fixed">by fixed amount</option>
                                                            </select>&nbsp;
                                                            <!--<input type="text" name="recurring_plan[start_price_value]" id="elm_recurring_plan_start_price" value="" size="10" class="input-micro  hidden-input">-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_recurring_plan_start_duration">Recurring start duration&nbsp;<a class="cm-tooltip" title="Duration of the initial period."><i class="icon-question-sign"></i></a>:</label>
                                                        <div class="col-md-10">
                                                            <input class="addimage form-control required has-error" style="width:150px;border-radius: 6px;"type="text" name="recurring_plan[start_duration]" id="elm_recurring_plan_start_duration" value="" size="10" class="input-micro">
                                                            <select class="select1" name="recurring_plan[start_duration_type]">
                                                                <option value="D">days</option>
                                                                <option value="M">month(s)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_recurring_plan_note">Recurring note:</label>
                                                        <div class="col-md-10">
                                                            <textarea class="addimage form-control required has-error" name="recurring_plan[description]" id="elm_recurring_plan_note" cols="50" rows="4" class="cm-wysiwyg input-large"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_recurring_plan_allow_setup_duration">Allow customers to set up duration:</label>
                                                        <div class="col-md-10">
                                                            <input type="hidden" name="recurring_plan[allow_change_duration]" value="N">
                                                            <input type="checkbox" name="recurring_plan[allow_change_duration]" id="elm_recurring_plan_allow_setup_duration" value="Y">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_recurring_plan_allow_unsubscribe">Allow customers to unsubscribe:</label>
                                                        <div class="col-md-10">
                                                            <input type="hidden" name="recurring_plan[allow_unsubscribe]" value="N">
                                                            <input type="checkbox" name="recurring_plan[allow_unsubscribe]" id="elm_recurring_plan_allow_unsubscribe" value="Y">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 control-label" for="elm_recurring_plan_allow_free_buy">Allow to buy products without subscription:</label>
                                                        <div class="col-md-10">
                                                            <input class="addimage form-control required has-error" type="hidden" name="recurring_plan[allow_free_buy]" value="N">
                                                            <input type="checkbox" name="recurring_plan[allow_free_buy]" id="elm_recurring_plan_allow_free_buy" value="Y">
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group has-error" style="border:none;" >
                                                    <div class="control-group">
                                                        <label class="col-md-2 col-md-2 control-label">Status</label>
                                                        <div class="col-md-10">
                                                            <label class="radio inline" for="elm_recurring_plan_status_0_a"><input type="radio" name="recurring_plan[status]" id="elm_recurring_plan_status_0_a" checked="checked" value="A">Active</label>



                                                            <label class="radio inline" for="elm_recurring_plan_status_0_d"><input type="radio" name="recurring_plan[status]" id="elm_recurring_plan_status_0_d" value="D">Disabled</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>




                        </div>






                    </div>
                </div>
            </div>




            <div class="tab-pane" id="tab_1_2">
                <div class="widget">
                    <div class="panel panel-default">
                        <div class="panel-heading ">
                            <h3 class="panel-title"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Product    </a> </h3>
                        </div>
                        <div id="collapseOne" class="panel-collapse in" style="height: auto;">
                            <div class="panel-body"> 
                                <div class="widget box" style="border:none;">
                                    <div class="widget-content">

                                        <div class="form-group has-error" style="border:none;">
                                            <label class="col-md-3 control-label">Product <span class="required">*</span></label> 
                                            <div class="col-md-9"> 


                                                <div class="row"> 
                                                    <div class="col-md-12">
                                                        <a data-toggle="modal" href="#myModal1" class="btn btn-default btn-block" style="width: 142px;  border-radius: 6px;">Add Product</a> </div> 
                                                    <div class="modal fade" id="myModal1" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog"> 
                                                            <div class="modal-content"> 
                                                                <div class="modal-header"> 
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                                                                    <h4 class="modal-title">Add Product</h4> 
                                                                </div> 
                                                                <div class="modal-body"> 


                                                                </div> 
                                                                <div class="modal-footer"> 
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button> 
                                                                </div> 
                                                            </div> 
                                                        </div>
                                                    </div> 
                                                </div>


                                                <label for="req1" generated="true" class="has-error help-block" style="color:#fff;">.</label>  </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>








        </div>
        <div class="btn-bar btn-toolbar dropleft pull-right" style="margin-top: 10px;margin-right: 10px;">

            <input type="submit"  class="btn btn-primary cm-submit btn-primary " style="border-radius:6px;" name="submit"/>
            <a data-ca-dispatch="dispatch[categories.update]" data-ca-target-form="category_update_form" class="btn btn-primary cm-submit cm-save-and-close btn-primary " style="border-radius:6px;"> Create and close</a>

        </div>


    </form> 
</div>