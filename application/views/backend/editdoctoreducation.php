<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">
            Doctoreducation Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editdoctoreducationsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforedoctoreducation->id);?>" style="display:none;">
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">Doctor</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="doctor" value='<?php echo set_value(' doctor ',$beforedoctoreducation->doctor);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Degree</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="degree" value='<?php echo set_value(' degree ',$beforedoctoreducation->degree);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">University</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="university" value='<?php echo set_value(' university ',$beforedoctoreducation->university);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Year</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="year" value='<?php echo set_value(' year ',$beforedoctoreducation->year);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Order</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ',$beforedoctoreducation->order);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
<!--                    <a href='<?php echo site_url("site/viewdoctoreducation"); ?>' class='btn btn-secondary'>Cancel</a>-->
                </div>
            </div>
        </form>
    </div>
</section>
