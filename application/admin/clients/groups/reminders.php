<h4 class="customer-profile-group-heading"><?php echo _l('client_reminders_tab'); ?></h4>
<div class="p-4">
    <?php if (isset($client)) { ?>
        <a href="#" data-toggle="modal" data-target=".reminder-modal-customer-<?php echo $client->userid; ?>"
           class="btn btn-info mb-1"><i class="fa fa-bell-o s-4"></i> <?php echo _l('set_reminder'); ?></a>
        <div class="clearfix"></div>

        <?php render_datatable(array(_l('reminder_description'), _l('reminder_date'), _l('reminder_staff'), _l('reminder_is_notified')), 'reminders');
        $this->load->view('admin/includes_fuse/modals/reminder', array('id' => $client->userid, 'name' => 'customer', 'members' => $members, 'reminder_title' => _l('set_reminder')));
    } ?>
</div>