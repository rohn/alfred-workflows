<?php

require_once('workflows.php');
$w = new Workflows();

$savedRoute         = $w->get( 'default.route',         'settings.plist' );
$savedDirection     = $w->get( 'default.direction',     'settings.plist' );
$savedDirectionName = $w->get( 'default.directionName', 'settings.plist' );
$savedStop          = $w->get( 'default.stop',          'settings.plist' );
$saveStopName       = $w->get( 'default.stopName',      'settings.plist' );

if ( !$savedStop ):
    $w->result( 'nexttrip', 'na', 'No default bus stop found', 'You must define a default bus stop to see arrival times', 'bus.png', 'no' );
else:

    $url = "http://metrotransitapi.appspot.com/nextrip?route=$savedRoute&direction=$savedDirection&stop=$savedStop";
    $suggestions = $w->request( $url );
    $suggestions = json_decode( $suggestions );

    foreach( $suggestions as $suggest ):
       $w->result( $suggest->time, $suggest->time, $suggest->time, 'Route: '. $suggest->number . ' ' . $savedDirectionName . ' at ' . $saveStopName .' ('. $suggest->name .')', 'bus.png' );
    endforeach;

    if ( count( $w->results() ) == 0 ):
        $w->result( 'routes', 'na', 'No arrival times found', 'No bus arrival times were located that match your preferred settings', 'bus.png', 'no' );
    endif;

endif;

echo $w->toxml();

