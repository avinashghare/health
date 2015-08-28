<div id="page-title">
    <a href="<?php echo site_url("site/viewlab"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">lab Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create lab </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createlabsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ');?>'>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Image</label>
                                <div class="col-sm-4">
                                    <input type="file" id="normal-field" class="form-control" name="image" value='<?php echo set_value(' image ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Street</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="street" value='<?php echo set_value(' street ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Landmark</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="landmark" value='<?php echo set_value(' landmark ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Locality</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="locality" value='<?php echo set_value(' locality ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Area</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="area" value='<?php echo set_value(' area ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">City</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="city" value='<?php echo set_value(' city ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Pincode</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="pincode" value='<?php echo set_value(' pincode ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">State</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="state" value='<?php echo set_value(' state ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Country</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="country" value='<?php echo set_value(' country ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Latitude</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="lat" value='<?php echo set_value(' lat ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Longitude</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="long" value='<?php echo set_value(' long ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url(" site/viewlab "); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
