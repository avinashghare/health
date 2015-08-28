<section class="panel">
<header class="panel-heading">
<h3 class="panel-title">Doctorclinicweektiming Details </h3>
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editdoctorclinicweektimingsubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Doctor clinic week</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="doctorclinicweek" value='<?php echo set_value('doctorclinicweek',$before->doctorclinicweek);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Timing</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="timing" value='<?php echo set_value('timing',$before->timing);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/viewdoctorclinicweektiming"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
