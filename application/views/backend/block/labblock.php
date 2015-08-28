<section class="panel">

    <div class="panel-body">
        <ul class="nav nav-stacked">
            <li><a href="<?php echo site_url('site/editlab?id=').$before->id; ?>">lab Details</a>
            </li>
            <li><a href="<?php echo site_url('site/viewlabfacility?id=').$before->id; ?>">Facilities</a>
            </li>
            <li><a href="<?php echo site_url('site/viewlabtest?id=').$before->id; ?>">Tests</a>
            </li>
            <li><a href="<?php echo site_url('site/viewlabaccrediation?id=').$before->id; ?>">Accrediation</a>
            </li>
            <li><a href="<?php echo site_url('site/editlabtiming?id=').$before->id; ?>">Timing</a>
            </li>
        </ul>
    </div>
</section>