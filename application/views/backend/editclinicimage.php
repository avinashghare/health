<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Clinicimage Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editclinicimagesubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforeclinicimage->id);?>" style="display:none;">
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">clinic</label>
                <div class="col-sm-4">
                    
                    <input type="text" id="normal-field" class="form-control" name="clinic" value='<?php echo set_value(' clinic ',$beforeclinicimage->clinic);?>'>
                </div>
            </div>

            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Image</label>
                <div class="col-sm-4">
                    <input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image',$beforeclinicimage->image);?>">
                    <?php if($beforeclinicimage->image == "") { } else { ?>
                    <img src="<?php echo base_url('uploads')."/".$beforeclinicimage->image; ?>" width="140px" height="140px">
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Order</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ',$beforeclinicimage->order);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
<!--                    <a href='<?php echo site_url("site/viewclinicimage"); ?>' class='btn btn-secondary'>Cancel</a>-->
                </div>
            </div>
        </form>
    </div>
</section>
