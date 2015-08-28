<section class="panel">
<header class="panel-heading">
<h3 class="panel-title">Doctorclinicweek Details </h3>
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editdoctorclinicweeksubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Doctor Clinic</label>
<div class="col-sm-4">
<?php echo form_dropdown("doctorclinic",$doctorclinic,set_value('doctorclinic',$before->doctorclinic),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Week</label>
<div class="col-sm-4">
<?php echo form_dropdown("week",$week,set_value('week',$before->week),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/viewdoctorclinicweek"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
