<section class="panel">
<header class="panel-heading">
<h3 class="panel-title">Timing Details </h3>
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/edittimingsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Time1</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="time1" value='<?php echo set_value('time1',$before->time1);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Time2</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="time2" value='<?php echo set_value('time2',$before->time2);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/viewtiming"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
