<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">labfacility Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editlabfacilitysubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforelabfacility->id);?>" style="display:none;">
            <div class=" form-group"  style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">lab</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="lab" value='<?php echo set_value(' lab ',$beforelabfacility->lab);?>'>
                                </div>
                            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Facility</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="facility" value='<?php echo set_value(' facility ',$beforelabfacility->facility);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Order</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ',$beforelabfacility->order);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewlabfacility"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
