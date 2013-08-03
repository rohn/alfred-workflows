<?php

require('workflows.php');
$w = new Workflows();

exec( 'touch settings.plist' );

$in = $argv[1];
$w->set( 'default.route', $in, 'settings.plist' );

echo "Default bus route $in saved";

