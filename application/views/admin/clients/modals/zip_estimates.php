<!-- Zip Estimates -->
<div class="modal fade" id="client_zip_estimates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open('admin/clients/zip_estimates/' . $client->userid); ?>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo _l('client_zip_estimates'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="estimate_zip_status"><?php echo _l('client_zip_status'); ?></label>
                            <div class="form-check mb-1">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="all" id="all" checked name="estimate_zip_status"/>
                                    <span class="radio-icon"></span>
                                    <span><?php echo _l('client_zip_status_all'); ?></span>
                                </label>
                            </div>
                            <?php foreach ($estimate_statuses as $status) { ?>
                                <div class="form-check mb-1">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="<?php echo $status; ?>"
                                               id="est_<?php echo $status; ?>" name="estimate_zip_status"/>
                                        <span class="radio-icon"></span>
                                        <span for="est_<?php echo $status; ?>"><?php echo format_estimate_status($status, '', false); ?></span>
                                    </label>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        if ($client->company != '') {
                            $file_name = slug_it($client->company);
                        } else {
                            $file_name = slug_it(get_contact_full_name(get_primary_contact_user_id($client->userid)));
                        }
                        ?>
                        <?php include(APPPATH . 'views/admin/clients/modals/modal_zip_date_picker.php'); ?>
                        <?php echo form_hidden('file_name', $file_name); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
                <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
