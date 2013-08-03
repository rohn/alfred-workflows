<?php

require_once('workflows.php');
$w = new Workflows();

$url = "http://metrotransitapi.appspot.com/routes";
$suggestions = $w->request( $url );
$suggestions = json_decode( $suggestions );

foreach( $suggestions as $suggest ):
    $w->result( $suggest->number, $suggest->number, $suggest->name, 'Route: '. $suggest->number .'. Name: '. $suggest->name, 'bus.png' );
endforeach;

if ( count( $w->results() ) == 0 ):
    $w->result( 'routes', 'na', 'No bus routes found', 'No bus routes found. Suspected problem with API.', 'bus.png', 'no' );
endif;

echo $w->toxml();

