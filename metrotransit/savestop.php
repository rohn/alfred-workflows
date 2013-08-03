<?php

require('workflows.php');
$w = new Workflows();

exec( 'touch settings.plist' );

$in = explode('#', $argv[1]);

$w->set( 'default.stop', $in[0], 'settings.plist' );
$w->set( 'default.stopName', $in[1], 'settings.plist');

$stop =str_replace("\\", "", (string)$in[1]);

echo "Default bus stop " .$stop. " saved";

