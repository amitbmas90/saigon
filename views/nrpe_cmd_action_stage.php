<?php
//
// Copyright (c) 2013, Zynga Inc.
// https://github.com/zynga/saigon
// Author: Matt West (https://github.com/mhwest13)
// License: BSD 2-Clause
//

require HTML_HEADER;
$deployment = $viewData->deployment;
$action = $viewData->action;
if ($action == 'modify_write') {
    $modifyFlag = true;
} else if ($action == 'copy_to_write') {
    $copyToFlag = true;
}

$nrpecmdName = isset($viewData->nrpecmdInfo['cmd_name'])?$viewData->nrpecmdInfo['cmd_name']:'';
$cmdDesc = isset($viewData->nrpecmdInfo['cmd_desc'])?$viewData->nrpecmdInfo['cmd_desc']:'';
$cmdLine = isset($viewData->nrpecmdInfo['cmd_line'])?htmlspecialchars(base64_decode($viewData->nrpecmdInfo['cmd_line'])):'';

if ($action == 'copy_to_write') {
?>
<script type="text/javascript">
$(function() {
    $("#todeployment")
        .multiselect({
        selectedList: 1,
        noneSelectedText: "Select Deployment",
        multiple: false,
    }).multiselectfilter();
});
</script>
<?php
}
?>
<link type="text/css" rel="stylesheet" href="static/css/tables.css" />
<body>
<?php
if ((isset($viewData->error)) && (!empty($viewData->error))) {
?>
<div id="error" style="border-width:2px;width:97%;left:5;top:5;position:absolute;text-align:center;background-color:red;" class="admin_box_blue divCacGroup admin_border_black">
<b>
<?php
    print $viewData->error;
?>
</b>
</div>
<div id="nrpecommand" style="border-width:2px;width:97%;left:5;top:45;position:absolute" class="admin_box_blue divCacGroup admin_border_black">
<?php
} else {
?>
<div id="nrpecommand" style="border-width:2px;width:97%;left:5;top:5;position:absolute" class="admin_box_blue divCacGroup admin_border_black">
<?php
}
?>
<form method="post" action="action.php" name="nrpe_command_action_write">
<input type="hidden" value="nrpecmd" id="controller" name="controller" />
<input type="hidden" value="<?php echo $deployment?>" id="deployment" name="deployment" />
<input type="hidden" value="<?php echo $action?>" id="action" name="action" />
<table class="noderesults">
    <thead>
<?php
if ($action == 'add_write') {
?>
        <th colspan="2">Add NRPE Command to <?php echo $deployment?></th>
<?php
} else if ($action == 'modify_write') {
?>
        <th colspan="2">Modify NRPE Command <?php echo $nrpecmdName?> in <?php echo $deployment?></th>
<?php
} else if ($action == 'copy_write') {
?>
        <th colspan="2">Copy NRPE Command <?php echo $nrpecmdName?> to <?php echo $deployment?></th>
<?php
} else if ($action == 'copy_to_write') {
?>
        <th colspan="2">Copy NRPE Command <?php echo $nrpecmdName?> from <?php echo $deployment?> to another deployment</th>
<?php
}
?>
    </thead>
    <tr>
        <th style="width:30%;text-align:right;">Name:<br /><font size="2">Ex: check_disk</font></th>
        <td style="text-align:left;"><input type="text" value="<?php echo $nrpecmdName?>" size="64" maxlength="128" id="nrpecmdname" name="nrpecmdname" <?php echo ((isset($modifyFlag)) || (isset($copyToFlag)))?'readonly':''?> /></td>
    </tr><tr>
        <th style="width:30%;text-align:right;">Description:<br /><font size="2">Ex: Checks Free Disk Space</font></th>
        <td style="text-align:left;"><input type="text" value="<?php echo $cmdDesc?>" size="64" maxlength="512" id="nrpecmddesc" name="nrpecmddesc" <?php echo isset($copyToFlag)?'readonly':''?> /></td>
    </tr><tr>
        <th style="width:30%;text-align:right;">Command:<br /><font size="2">semicolons " ; " are Forbidden</th>
        <td style="text-align:left;"><input type="text" value="<?php echo $cmdLine?>" size="64" maxlength="2048" id="nrpecmdline" name="nrpecmdline" <?php echo isset($copyToFlag)?'readonly':''?> /></td>
    </tr>
<?php
if ($action == 'copy_to_write') {
?>
    <tr>
        <th style="width:30%;text-align:right;">Deployment to Copy Command to:</th>
        <td style="text-align:left;">
            <select id="todeployment" name="todeployment" multiple="multiple">
<?php
    foreach ($viewData->availdeployments as $deploy) {
        if ($deploy == $viewData->deployment) continue;
?>
                <option value="<?php echo $deploy?>"><?php echo $deploy?></option>
<?php
    }
?>
            </select>
        </td>
    </tr>
<?php
}
?>
</table>
<div class="divCacGroup"><!-- 5 Pixel Spacer --></div>
<div class="divCacGroup admin_box_blue" style="width:6%;">
    <input type="submit" value="Submit" style="font-size:14px;padding:5px;" />
</div>
</form>
</div>
<?php

require HTML_FOOTER;
