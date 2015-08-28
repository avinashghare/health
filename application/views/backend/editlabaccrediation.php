<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">labaccrediation Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editlabaccrediationsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforelabaccrediation->id);?>" style="display:none;">
            <div class=" form-group"  style="display:none;">
                                <label class="col-sm-2 control-label" for="normal-field">lab</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="lab" value='<?php echo set_value(' lab ',$beforelabaccrediation->lab);?>'>
                                </div>
                            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Accrediation</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="accrediation" value='<?php echo set_value(' accrediation ',$beforelabaccrediation->accrediation);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Order</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ',$beforelabaccrediation->order);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
<!--                    <a href='<?php echo site_url("site/viewlabaccrediation"); ?>' class='btn btn-secondary'>Cancel</a>-->
                </div>
            </div>
        </form>
    </div>
</section>
