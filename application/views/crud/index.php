<?php

include APPPATH . 'views/fronted/header.php';

?>
<div class="card mt-3">
    <div class="d-flex">
    <div class="card-body text-center bg-light">
            <h1>welcome to codelgniter</h1>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="btn btn-outline-dark" href="<?php echo base_url('crud_demo/registerForm'); ?>">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-dark" href="<?php echo base_url('crud_demo/login'); ?>">sign In</a>
                </li>
            </ul>
        </div>
    </div>
</div>