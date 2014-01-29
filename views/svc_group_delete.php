<?php
//
// Copyright (c) 2013, Zynga Inc.
// https://github.com/zynga/saigon
// Author: Matt West (https://github.com/mhwest13)
// License: BSD 2-Clause
//

require HTML_HEADER;

?>
<body>
<div class="divCacGroup admin_box_bg admin_box_blue admin_border_black">
Successfully removed Service Group Information for <?php echo $viewData->svc?> in Deployment <?php echo $viewData->deployment?> from datastore...
<div class="divCacGroup"></div>
<a href="action.php?controller=svcgrp&action=stage&deployment=<?php echo $viewData->deployment?>" class="deployBtn">Service Groups</a>
</div>
<?php

require HTML_FOOTER;
