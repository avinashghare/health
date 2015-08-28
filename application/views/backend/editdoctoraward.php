<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Doctoraward Details </h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editdoctorawardsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$beforedoctoraward->id);?>" style="display:none;">
            <div class=" form-group" style="display:none;">
                <label class="col-sm-2 control-label" for="normal-field">Doctor</label>
                <div class="col-sm-4">
                    
                    <input type="text" id="normal-field" class="form-control" name="doctor" value='<?php echo set_value(' doctor ',$beforedoctoraward->doctor);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Award</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="award" value='<?php echo set_value(' award ',$beforedoctoraward->award);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Order</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="order" value='<?php echo set_value(' order ',$beforedoctoraward->order);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewdoctoraward?id=".$beforedoctoraward->doctor); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
