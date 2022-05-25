<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
    <!-- column -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Summary</h4>
                <div class="d-flex align-items-center flex-row m-t-30">
                    <div class="display-5 text-info"><i class="mdi mdi-account-plus"></i>
                        <span class="counter"><?php echo $this->ModelCommon->get_count_user_submitted($this->session->userdata('user_id')); ?></span></div>
                    <div class="m-l-10">
                        <h3 class="m-b-0">Total Accounts Submitted</h3>
                    </div>
                </div>
                <ul class="row list-style-none text-center m-t-30">
                    <li class="col-3">
                        <h4 class="text-info"><i class="mdi mdi-checkbox-marked-circle-outline"></i></h4>
                        <h3 class="m-t-5 counter"><?php echo $this->ModelCommon->get_count_user_cond($this->session->userdata('user_id'), "checked"); ?></h3>
                        <span class="d-block text-muted">Checked</span>
                    </li>
                    <li class="col-3">
                        <h4 class="text-info"><i class="mdi mdi-minus-circle-outline"></i></h4>
                        <h3 class="m-t-5 counter"><?php echo $this->ModelCommon->get_count_user_cond($this->session->userdata('user_id'), "used"); ?></h3>
                        <span class="d-block text-muted">Used</span>
                    </li>
                    <li class="col-3">
                        <h4 class="text-info"><i class="mdi mdi-close-circle-outline"></i></h4>
                        <h3 class="m-t-5 counter"><?php echo $this->ModelCommon->get_count_user_cond($this->session->userdata('user_id'), "rejected"); ?></h3>
                        <span class="d-block text-muted">Rejected</span>
                    </li>
                    <li class="col-3">
                        <h4 class="text-info"><i class="mdi mdi-arrow-down-bold-circle-outline"></i></h4>
                        <h3 class="m-t-5 counter"><?php echo $this->ModelCommon->get_count_user_cond($this->session->userdata('user_id'), "download"); ?></h3>
                        <span class="d-block text-muted">Downloaded</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Recent comment and chats -->
<!-- ============================================================== -->