<?php init_single_head(); ?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/proposal.css'); ?>">
<main>
    <div id="wrapper">
        <?php init_aside(); ?>

        <div class="content-wrapper">

            <?php init_header(); ?>
            <div class="content custom-scrollbar">

                <div id="proposal-manage" class="page-layout simple left-sidebar-floating">

                    <div class="page-header bg-primary text-auto row no-gutters align-items-center justify-content-between p-4">

                        <div class="col-md col-sm-12">
                            <span class="logo-text h4"><?php echo _l('proposals'); ?></span>
                        </div>

                        <?php if (has_permission('proposals', '', 'create')) { ?>
                            <div class="col-auto ml-4">
                                <a href="<?php echo admin_url('proposals/proposal'); ?>"
                                   class="btn btn-secondary">
                                    <?php echo _l('new_proposal'); ?>
                                </a>
                            </div>
                        <?php } ?>

                        <div class="col-auto ml-4">
                            <a href="<?php echo admin_url('proposals/pipeline/' . $switch_pipeline); ?>"
                               class="btn btn-default hidden-xs"><?php echo _l('switch_to_pipeline'); ?></a>
                        </div>

                        <div class="col-auto ml-4 display-block">
                            <div class="btn-group">
                            <a href="#" class="btn btn-default btn-with-tooltip toggle-small-view m-t-2 min-height-auto"
                               onclick="toggle_small_view('.table-proposals','#proposal'); return false;"
                               data-toggle="tooltip" data-placement="bottom"
                               title="<?php echo _l('invoices_toggle_table_tooltip'); ?>">
                                <i class="fa fa-angle-double-left text-dark s-4"></i>
                            </a>
                            </div>

                            <div class="btn-group pull-right btn-with-tooltip-group _filter_data ml-4"
                                 data-toggle="tooltip" data-title="<?php echo _l('filter_by'); ?>"
                                 data-placement="bottom">
                                <button type="button" class="btn btn-secondary dropdown-toggle m-t-2 min-height-auto"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    <i class="fa fa-filter s-4" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu width300">
                                    <li>
                                        <a href="#" data-cview="all"
                                           onclick="dt_custom_view('','.table-proposals',''); return false;">
                                            <?php echo _l('proposals_list_all'); ?>
                                        </a>
                                    </li>
                                    <li class="divider"></li>
                                    <?php foreach ($statuses as $status) { ?>
                                        <li class="<?php if ($this->input->get('status') == $status) {
                                            echo 'active';
                                        } ?>">
                                            <a href="#"
                                               data-cview="proposals_<?php echo $status; ?>"
                                               onclick="dt_custom_view('proposals_<?php echo $status; ?>','.table-proposals','proposals_<?php echo $status; ?>'); return false;">
                                                <?php echo format_proposal_status($status, '', false); ?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if (count($years) > 0) { ?>
                                        <li class="divider"></li>
                                        <?php foreach ($years as $year) { ?>
                                            <li class="active">
                                                <a href="#"
                                                   data-cview="year_<?php echo $year['year']; ?>"
                                                   onclick="dt_custom_view(<?php echo $year['year']; ?>,'.table-proposals','year_<?php echo $year['year']; ?>'); return false;"><?php echo $year['year']; ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php if (count($proposals_sale_agents) > 0) { ?>
                                        <div class="clearfix"></div>
                                        <li class="divider"></li>
                                        <li class="dropdown-submenu pull-left">
                                            <a href="#"
                                               tabindex="-1"><?php echo _l('sale_agent_string'); ?></a>
                                            <ul class="dropdown-menu dropdown-menu-left">
                                                <?php foreach ($proposals_sale_agents as $agent) { ?>
                                                    <li>
                                                        <a href="#"
                                                           data-cview="sale_agent_<?php echo $agent['sale_agent']; ?>"
                                                           onclick="dt_custom_view('sale_agent_<?php echo $agent['sale_agent']; ?>','.table-proposals','sale_agent_<?php echo $agent['sale_agent']; ?>'); return false;"><?php echo get_staff_full_name($agent['sale_agent']); ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#" data-cview="expired"
                                           onclick="dt_custom_view('expired','.table-proposals','expired'); return false;">
                                            <?php echo _l('proposal_expired'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-cview="leads_related"
                                           onclick="dt_custom_view('leads_related','.table-proposals','leads_related'); return false;">
                                            <?php echo _l('proposals_leads_related'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-cview="customers_related"
                                           onclick="dt_custom_view('customers_related','.table-proposals','customers_related'); return false;">
                                            <?php echo _l('proposals_customers_related'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- / HEADER -->

                    <div class="page-content p-4 p-sm-6">
                        <div class="row">
                            <div class="_filters _hidden_inputs">
                                <?php
                                foreach ($statuses as $_status) {
                                    $val = '';
                                    if ($_status == $this->input->get('status')) {
                                        $val = $_status;
                                    }
                                    echo form_hidden('proposals_' . $_status, $val);
                                }
                                foreach ($years as $year) {
                                    echo form_hidden('year_' . $year['year'], $year['year']);
                                }
                                foreach ($proposals_sale_agents as $agent) {
                                    echo form_hidden('sale_agent_' . $agent['sale_agent']);
                                }
                                echo form_hidden('leads_related');
                                echo form_hidden('customers_related');
                                echo form_hidden('expired');
                                ?>
                            </div>
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12" id="small-table">
                                        <div class="card">
                                            <div class="panel-body">
                                                <!-- if invoiceid found in url -->
                                                <?php echo form_hidden('proposal_id', $proposal_id); ?>
                                                <?php
                                                $table_data = array(
                                                    _l('proposal') . ' #',
                                                    _l('proposal_subject'),
                                                    _l('proposal_to'),
                                                    _l('proposal_total'),
                                                    _l('proposal_date'),
                                                    _l('proposal_open_till'),
                                                    _l('tags'),
                                                    _l('proposal_date_created'),
                                                    _l('proposal_status'),
                                                );

                                                $custom_fields = get_custom_fields('proposal', array('show_on_table' => 1));
                                                foreach ($custom_fields as $field) {
                                                    array_push($table_data, $field['name']);
                                                }

                                                $table_data = do_action('proposals_table_columns', $table_data);
                                                render_datatable($table_data, 'proposals', [], [
                                                    'data-last-order-identifier' => 'proposals',
                                                    'data-default-order' => get_table_last_order('proposals'),
                                                ]);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 small-table-right-col">
                                        <div class="card">
                                            <div id="proposal" class="hide"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<?php $this->load->view('admin/includes_fuse/modals/sales_attach_file'); ?>
<script>var hidden_columns = [4, 5, 6, 7];</script>
<?php init_tail(); ?>
<div id="convert_helper"></div>
<script>
    var proposal_id;
    $(function () {
        var Proposals_ServerParams = {};
        $.each($('._hidden_inputs._filters input'), function () {
            Proposals_ServerParams[$(this).attr('name')] = '[name="' + $(this).attr('name') + '"]';
        });
        initDataTable('.table-proposals', admin_url + 'proposals/table', ['undefined'], ['undefined'], Proposals_ServerParams, [7, 'desc']);
        init_proposal();
    });
</script>
<?php echo app_script('assets-old/js', 'proposals.js'); ?>
</body>
</html>
