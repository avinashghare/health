<div id="page-title">
    <a href="<?php echo site_url(" site/viewdoctorclinic "); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">doctorclinic Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create doctorclinic </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createdoctorclinicsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Doctor</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "doctor",$doctor,set_value( 'doctor'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class=" form-group"  style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">clinic</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="clinic" value='<?php echo set_value(' clinic ',$clinic);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Price</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="price" value='<?php echo set_value(' price ');?>'>
                                </div>
                            </div>
                            
                            <input type="hidden" value="" class="weektiminghidden" name="weektiming">
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Week Timings</label>
                                <div class="col-sm-8">
                                   <table class="table table-striped">
                                   <thead><tr>
                                       <td></td>
                                       <td>Day</td>
                                       <td>From Time</td>
                                       <td>To Time</td>
                                   </tr></thead>
                                   <tbody class="weekdaytable">
                                       
                                       <?php
                                    foreach($week as $key=>$value)
                                    {
                                        $id=$value->id;
                                        $name=$value->name;
                                    ?>
                                    <tr class="weekrow">
                                        <td><input type='checkbox' class='weekdays' name='week' value="<?php echo $id;?>"></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo form_dropdown( "from",$timing,set_value( 'from'), "class='chzn-select form-control fromtime'");?></td>
                                        <td><?php echo form_dropdown( "to",$timing,set_value( 'to'), "class='chzn-select form-control totime'");?></td></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                       
                                   </tbody>
                                    
                                    
                                   </table>
                                   
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary beforesubmit">Save</button>
                                    <a href="<?php echo site_url(" site/viewdoctorclinic "); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
    
    
    <script>
        $("document").ready(function() {
            $(".beforesubmit").click(function() {
                var weekobj=[];
                var $weekrows=$(".weekdaytable .weekrow");
                for(var i=0;i<$weekrows.length;i++)
                {
                    var weobj={};
                    if($weekrows.eq(i).find(".weekdays").prop( "checked" ))
                    {
                        weobj.weekdays=$weekrows.eq(i).find(".weekdays").attr("value");
                        weobj.fromtime=$weekrows.eq(i).find(".fromtime").val();
                        weobj.totime=$weekrows.eq(i).find(".totime").val();
                        weekobj.push(weobj);
                    }
                }
                
                $(".weektiminghidden").val(JSON.stringify(weekobj));
                return true;
            });
        });
</script>
