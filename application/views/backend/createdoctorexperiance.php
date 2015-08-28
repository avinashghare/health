<div id="page-title">
<!--    <a href="<?php echo site_url("site/viewdoctorexperiance"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>-->
    <h1 class="page-header text-overflow">Doctorexperiance Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create Doctorexperiance </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createdoctorexperiancesubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class=" form-group"  style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">Doctor</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="doctor" value='<?php echo set_value(' doctor ',$doctor);?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Experiance</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="experiance" value='<?php echo set_value(' experiance ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Order</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
<!--                                    <a href="<?php echo site_url(" site/viewdoctorexperiance "); ?>" class="btn btn-secondary">Cancel</a>-->
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
