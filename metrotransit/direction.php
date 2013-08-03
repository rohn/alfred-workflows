<?php

require_once('workflows.php');
$w = new Workflows();

$savedRoute = $w->get( 'default.route', 'settings.plist' );

if ( !$savedRoute ):
    $w->result( 'direction', 'na', 'No default route found', 'You must define a default route before choosing a direction', 'bus.png', 'no' );
else:

    $url = "http://metrotransitapi.appspot.com/direction?route=$savedRoute";
    $suggestions = $w->request( $url );
    $suggestions = json_decode( $suggestions );

    foreach( $suggestions as $suggest ):
        $w->result( $suggest->code, $suggest->code, $suggest->name, 'Code: '. $suggest->code .'. Name: '. $suggest->name, 'bus.png' );
    endforeach;

    if ( count( $w->results() ) == 0 ):
        $w->result( 'routes', 'na', 'No bus directions found', 'No bus directions were found, suspected problem with API.', 'bus.png', 'no' );
    endif;

endif;

echo $w->toxml();

