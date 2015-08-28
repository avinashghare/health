<div id="page-title">
    <a href="<?php echo site_url("site/viewdoctor"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
    <h1 class="page-header text-overflow">Doctor Details </h1>
</div>
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
Create Doctor </h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createdoctorsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Experiance</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="experiance" value='<?php echo set_value(' experiance ');?>'>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Description</label>
                                <div class="col-sm-8">
                                    <textarea name="description" id="" cols="20" rows="10" class="form-control tinymce">
                                        <?php echo set_value( 'description');?>
                                    </textarea>
                                </div>
                            </div>
                            <div class=" form-group">
                              <label class="col-sm-2 control-label">Select Types</label>
                              <div class="col-sm-4">
                                <?php

                                    echo form_dropdown('typeofdoctor[]',$typeofdoctor,set_value('typeofdoctor'),'id="select3" class="chzn-select form-control" 	data-placeholder="Choose an typeofdoctor..." multiple');
                                ?>
                              </div>
                            </div>
				
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Image</label>
                                <div class="col-sm-4">
                                    <input type="file" id="normal-field" class="form-control" name="image" value='<?php echo set_value(' image ');?>'>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "status",$status,set_value( 'status'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url("site/viewdoctor"); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>
