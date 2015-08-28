<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">doctorclinic Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editdoctorclinicsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforedoctorclinic->id);?>" style="display:none;">
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Doctor</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "doctor",$doctor,set_value( 'doctor',$beforedoctorclinic->doctor),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">clinic</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="clinic" value='<?php echo set_value(' clinic ',$clinic);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Price</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="price" value='<?php echo set_value(' price ',$beforedoctorclinic->price);?>'>
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
                                    foreach($selectedweektime as $key=>$value)
                                    {
                                        $id=$value->id;
                                        $name=$value->name;
                                        $week=$value->week;
                                        $fromtime=$value->fromtime;
                                        $totime=$value->totime;
                                        
                                        if($week=="")
                                        {
                                            ?>
                                            <tr class="weekrow">
                                        <td><input type='checkbox' class='weekdays' name='week' value="<?php echo $id;?>"></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo form_dropdown( "from",$timing,set_value( 'from'), "class='chzn-select form-control fromtime'");?></td>
                                        <td><?php echo form_dropdown( "to",$timing,set_value( 'to'), "class='chzn-select form-control totime'");?></td></td>
                                    </tr>
                                            <?php
                                            
                                        }
                                        else
                                        {
                                            ?>
                                        <tr class="weekrow">
                                        <td><input type='checkbox' class='weekdays' name='week' value="<?php echo $id;?>" checked></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo form_dropdown( "from",$timing,set_value( 'from',$fromtime), "class='chzn-select form-control fromtime'");?></td>
                                        <td><?php echo form_dropdown( "to",$timing,set_value( 'to',$totime), "class='chzn-select form-control totime'");?></td></td>
                                    </tr>
                                       <?php
                                        }
                                    
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
                    <!--                    <a href='<?php echo site_url("site/viewdoctorclinic"); ?>' class='btn btn-secondary'>Cancel</a>-->
                </div>
            </div>
        </form>
    </div>
</section>

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

