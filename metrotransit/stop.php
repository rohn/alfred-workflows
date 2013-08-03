<?php

require_once('workflows.php');
$w = new Workflows();

$savedRoute =     $w->get( 'default.route', 'settings.plist' );
$savedDirection = $w->get( 'default.direction', 'settings.plist' );

if ( !$savedDirection ):
    $w->result( 'stop', 'na', 'No default direction found', 'You must define a default direction before choosing a stop', 'bus.png', 'no' );
else:

    $url = "http://metrotransitapi.appspot.com/stops?route=$savedRoute&direction=$savedDirection";
    $suggestions = $w->request( $url );
    $suggestions = json_decode( $suggestions );

    foreach( $suggestions as $suggest ):
        $w->result( $suggest->code, $suggest->code . '#' . $suggest->name, $suggest->name, 'Code: '. $suggest->code .'. Name: '. $suggest->name, 'bus.png' );
    endforeach;

    if ( count( $w->results() ) == 0 ):
        $w->result( 'routes', 'na', 'No bus stops found', 'No bus stops were located that match your preferred settings. Possible API issue.', 'bus.png', 'no' );
    endif;

endif;

echo $w->toxml();

