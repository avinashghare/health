<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Lab Timings </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editlabtimingsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$lab);?>" style="display:none;">
            
            
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

