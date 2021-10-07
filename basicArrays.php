<?php
    /* 
    // Script      : basicArrays.php - Basic Arrays in PHP 
    // Mode        : Console (run using php -f basicArrays.php)
    // Create Date : Thu 7 Oct 2021
    /*

    /* Force strict types */
    declare( strict_types = 1 );

    // Constants ///////////////////////////////////////////////////////////////

    /* Constant arrays - Single dimension */
    const ANIMALS_ARRAY = array( 'dog', 'cat', 'mouse' );

    /* Constant arrays - Single dimension with key */
    const SIGNIFICANT_YEARS = array(
        1770 => 'Captain Cook east coast exploration',
        1788 => 'Penal colony Sydney cove',
        1808 => 'Rum rebellion',
        1851 => 'Gold rush NSW',
        1854 => 'Batle of the Eureka Stockade',
        1901 => 'Federation'
    );

    const COUNTRY     = 0;
    const CAPITAL     = 1;
    const POPULATION  = 2;

    /* Constant arrays - Two dimension */
    const COUNTRY_CAPITAL_ARRAY = array(
        array( 'Australia', 'Canberra',   400000 ),
        array( 'France',    'Paris',     2100000 ),
        array( 'Austria',   'Vienna',    1900000 )
    );

    // Main ////////////////////////////////////////////////////////////////////

    /* Print single dimension const array */
    echo( 'There are ' . count( ANIMALS_ARRAY ) . ' animals' . PHP_EOL );
    $Ctr = 0;
    foreach( ANIMALS_ARRAY as $Element ) {
        $Ctr++;  
        echo( $Ctr . ' - ' . $Element . PHP_EOL );
    }

    /* Print two dimensional const array */
    foreach( COUNTRY_CAPITAL_ARRAY as $Row ) {
        foreach( $Row as $Element ) {
            echo( $Element . PHP_EOL );
        }
    }

    /* Second method - two dimensional const array */
    for ( $RowCtr = 0; $RowCtr < count( COUNTRY_CAPITAL_ARRAY ); $RowCtr++ ) {
        for ( $ColCtr = 0; $ColCtr < count( COUNTRY_CAPITAL_ARRAY[ $RowCtr ] ); $ColCtr++ ) {
            echo( 'Row: ' . $RowCtr . ' Col: ' . $ColCtr . ' ' . COUNTRY_CAPITAL_ARRAY[ $RowCtr ][ $ColCtr ] . PHP_EOL );
        }     
    }

    /* Third method - address columns using constants - two dimension const array */
    foreach( COUNTRY_CAPITAL_ARRAY as $Row ) {
        echo( $Row[ COUNTRY ] . ' ' . $Row[ CAPITAL ] . ' ' .
            $Row[ POPULATION ] . PHP_EOL );
    }

    /* Array creation */
    $Array1 = array( array() );

    /* Set all elements to zero at the same time dimensioning array */
    $Array1 = array_fill( 0, 10, array_fill( 0, 10, 0 ) );

    /* Print all elements */
    print_r( $Array1 );

    /* Load elements with random values */
    for ( $RowCtr = 0; $RowCtr < count( $Array1 ); $RowCtr++ ) {
        for ( $ColCtr = 0; $ColCtr < count( $Array1[ $RowCtr ] ); $ColCtr++ ) {
            $Array1[ $RowCtr ][ $ColCtr ] = rand( 1, 100 );
        }     
    }

    /* Print all elements */
    print_r( $Array1 );

    

  



