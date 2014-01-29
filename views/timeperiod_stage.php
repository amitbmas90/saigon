<?php
//
// Copyright (c) 2013, Zynga Inc.
// https://github.com/zynga/saigon
// Author: Matt West (https://github.com/mhwest13)
// License: BSD 2-Clause
//

require HTML_HEADER;
$deployment = $viewData->deployment;
?>
<link type="text/css" rel="stylesheet" href="static/css/tables.css" />
<script type="text/javascript" src="static/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="static/js/mastermeta_tables.js"></script>
<body>
<div id="avail-timeperiods" style="border-width:2px;width:97%;left:5;top:5;position:absolute" class="admin_box_blue divCacGroup admin_border_black">
<h2>Available Timeperiods</h2>
<table style="padding:5px;" id="table_timeperiodResults" class="noderesults">
    <thead>
        <tr>
            <th>Name</th>
            <th>Alias</th>
            <th>Deployment</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
<?php
if ((isset($viewData->timeperiods)) && (!empty($viewData->timeperiods))) {
    foreach ($viewData->timeperiods as $timeperiodPtr => $timeperiodArray) {
?>
        <tr>
            <td><?php echo $timeperiodArray['timeperiod_name']?></td>
            <td><?php echo $timeperiodArray['alias']?></td>
            <td><?php echo $timeperiodArray['deployment']?></td>
            <td>
<?php
        if ($viewData->deployment != 'common') {
            if ($timeperiodArray['deployment'] != $viewData->deployment) {
?>
                <a class="deployBtn" title="Copy" href="action.php?controller=timeperiod&action=copy_common_stage&deployment=<?php echo $deployment?>&timeperiod=<?php echo $timeperiodArray['timeperiod_name']?>">Copy</a>
<?php
            } else {
?>
                <a class="deployBtn" title="Modify" href="action.php?controller=timeperiod&action=modify_stage&deployment=<?php echo $deployment?>&timeperiod=<?php echo $timeperiodArray['timeperiod_name']?>">Modify</a>
                <a class="deployBtn" title="Copy" href="action.php?controller=timeperiod&action=copy_stage&deployment=<?php echo $deployment?>&timeperiod=<?php echo $timeperiodArray['timeperiod_name']?>">Copy</a>
                <a class="deployBtn" title="Delete" href="action.php?controller=timeperiod&action=del_stage&deployment=<?php echo $deployment?>&timeperiod=<?php echo $timeperiodArray['timeperiod_name']?>">Delete</a>
<?php
            }
        } else {
?>
                <a class="deployBtn" title="Modify" href="action.php?controller=timeperiod&action=modify_stage&deployment=<?php echo $deployment?>&timeperiod=<?php echo $timeperiodArray['timeperiod_name']?>">Modify</a>
                <a class="deployBtn" title="Copy" href="action.php?controller=timeperiod&action=copy_stage&deployment=<?php echo $deployment?>&timeperiod=<?php echo $timeperiodArray['timeperiod_name']?>">Copy</a>
                <a class="deployBtn" title="Delete" href="action.php?controller=timeperiod&action=del_stage&deployment=<?php echo $deployment?>&timeperiod=<?php echo $timeperiodArray['timeperiod_name']?>">Delete</a>
<?php
        }
?>
            </td>
        </tr>
<?php
    }
}
?>
    </tbody>
</table>
<div class="divCacGroup"><!-- 5 Pixel Spacer--></div>
<a href="action.php?controller=timeperiod&action=add_stage&deployment=<?php echo $deployment?>" class="menuItem">Add Timeperiod</a>
</div>
<div>

<?php

require HTML_FOOTER;
