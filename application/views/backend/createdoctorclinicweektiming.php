<div id="page-title">
<a href="<?php echo site_url("site/viewdoctorclinicweektiming"); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>
<h1 class="page-header text-overflow">doctorclinicweektiming Details </h1>
</div>
<div id="page-content">
<div class="row">
<div class="col-lg-12">
<section class="panel">
<div class="panel-heading">
<h3 class="panel-title">
Create doctorclinicweektiming </h3>
</div>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createdoctorclinicweektimingsubmit");?>' enctype= 'multipart/form-data'>
<div class="panel-body">
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Doctor clinic week</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="doctorclinicweek" value='<?php echo set_value('doctorclinicweek');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Timing</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="timing" value='<?php echo set_value('timing');?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href="<?php echo site_url("site/viewdoctorclinicweektiming"); ?>" class="btn btn-secondary">Cancel</a>
</div>
</div>
</form>
</div>
</section>
</div>
</div>
</div>
