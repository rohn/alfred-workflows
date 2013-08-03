<?php

require('workflows.php');
$w = new Workflows();

exec( 'touch settings.plist' );

$in = $argv[1];
switch ($in) {
    case 1:
        $directionName = "SOUTHBOUND";
        break;
    case 2:
        $directionName = "EASTBOUND";
        break;
    case 3:
        $directionName = "WESTBOUND";
        break;
    case 4:
        $directionName = "NORTHBOUND";
}

$w->set( 'default.direction', $in, 'settings.plist' );
$w->set( 'default.directionName', $directionName, 'settings.plist' );

echo "Default route direction $directionName saved";

