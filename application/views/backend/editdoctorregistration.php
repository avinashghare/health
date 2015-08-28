<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Doctorregistration Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editdoctorregistrationsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforedoctorregistration->id);?>" style="display:none;">
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">Doctor</label>
                <div class="col-sm-4">
                    
                    <input type="text" id="normal-field" class="form-control" name="doctor" value='<?php echo set_value(' doctor ',$beforedoctorregistration->doctor);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Registration</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="registration" value='<?php echo set_value(' registration ',$beforedoctorregistration->registration);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Order</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ',$beforedoctorregistration->order);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
<!--                    <a href='<?php echo site_url("site/viewdoctorregistration"); ?>' class='btn btn-secondary'>Cancel</a>-->
                </div>
            </div>
        </form>
    </div>
</section>
