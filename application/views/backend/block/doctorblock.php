<section class="panel">

    <div class="panel-body">
        <ul class="nav nav-stacked">
            <li><a href="<?php echo site_url('site/editdoctor?id=').$before->id; ?>">User Details</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctorservice?id=').$before->id; ?>">Services</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctorspecialization?id=').$before->id; ?>">Specialization</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctoreducation?id=').$before->id; ?>">Education</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctorexperiance?id=').$before->id; ?>">Experiance</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctoraward?id=').$before->id; ?>">Award</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctormembership?id=').$before->id; ?>">Membership</a>
            </li>
            <li><a href="<?php echo site_url('site/viewdoctorregistration?id=').$before->id; ?>">Registration</a>
            </li>
        </ul>
    </div>
</section>