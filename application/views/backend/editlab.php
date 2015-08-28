<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">lab Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editlabsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ',$before->name);?>'>
                </div>
            </div>
            
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Image</label>
                <div class="col-sm-4">
                    <input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image',$before->image);?>">
                    <?php if($before->image == "") { } else { ?>
                    <img src="<?php echo base_url('uploads')."/".$before->image; ?>" width="140px" height="140px">
                    <?php } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Street</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="street" value='<?php echo set_value(' street ',$before->street);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Landmark</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="landmark" value='<?php echo set_value(' landmark ',$before->landmark);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Locality</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="locality" value='<?php echo set_value(' locality ',$before->locality);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Area</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="area" value='<?php echo set_value(' area ',$before->area);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">City</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="city" value='<?php echo set_value(' city ',$before->city);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Pincode</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="pincode" value='<?php echo set_value(' pincode ',$before->pincode);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">State</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="state" value='<?php echo set_value(' state ',$before->state);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Country</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="country" value='<?php echo set_value(' country ',$before->country);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Latitude</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="lat" value='<?php echo set_value(' lat ',$before->lat);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Longitude</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="long" value='<?php echo set_value(' long ',$before->long);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewlab"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
