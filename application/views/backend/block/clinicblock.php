<section class="panel">

    <div class="panel-body">
        <ul class="nav nav-stacked">
            <li><a href="<?php echo site_url('site/editclinic?id=').$before->id; ?>">Clinic Details</a>
            </li>
            <li><a href="<?php echo site_url('site/viewclinicservice?id=').$before->id; ?>">Services</a>
            </li>
            <li><a href="<?php echo site_url('site/viewclinicimage?id=').$before->id; ?>">Image</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctorclinic?id=').$before->id; ?>">Doctors</a>
            </li>
        </ul>
    </div>
</section>