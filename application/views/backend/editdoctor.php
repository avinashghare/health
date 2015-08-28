<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">doctor Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editdoctorsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ',$before->name);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Experiance</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="experiance" value='<?php echo set_value(' experiance ',$before->experiance);?>'>
                </div>
            </div>
            <div class=" form-group">
				  <label class="col-sm-2 control-label">Select Type</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('typeofdoctor[]',$typeofdoctor,$selectedtypeofdoctor,'id="select3" class="chzn-select form-control" 	data-placeholder="Choose an typeofdoctor..." multiple');
					?>
				  </div>
				</div>
				
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Description</label>
                <div class="col-sm-8">
                    <textarea name="description" id="" cols="20" rows="10" class="form-control tinymce">
                        <?php echo set_value( 'description',$before->description);?></textarea>
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
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "status",$status,set_value( 'status',$before->status),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewdoctor"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
