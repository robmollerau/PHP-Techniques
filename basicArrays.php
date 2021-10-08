<?php
    /* 
    // Script      : basicArrays.php - Basic Arrays in PHP 
    // Mode        : Console (run using php -f basicArrays.php)
    // Create Date : Thu 7 Oct 2021
    /*

    /* Force strict types */
    declare( strict_types = 1 );

    // Constant Arrays /////////////////////////////////////////////////////////

    /* Constant array - Single dimension */
    const ANIMALS_ARRAY = array( 'dog', 'cat', 'mouse' );

    /* Constant array - Single dimension with key */
    const SIGNIFICANT_YEARS = array(
        1770 => 'Captain Cook east coast exploration',
        1788 => 'Penal colony Sydney cove',
        1808 => 'Rum rebellion',
        1851 => 'Gold rush NSW',
        1854 => 'Battle of the Eureka Stockade',
        1901 => 'Federation'
    );

    /* Country capital array columns */
    const COUNTRY     = 0;
    const CAPITAL     = 1;
    const POPULATION  = 2;

    /* Constant array - Two dimension */
    const COUNTRY_CAPITAL_ARRAY = array(
        array( 'Australia', 'Canberra',   400000 ),
        array( 'France',    'Paris',     2100000 ),
        array( 'Austria',   'Vienna',    1900000 )
    );

    /* Country code array columns */
    const CC_COUNTRY      = 0;
    const CC_CAPITAL      = 1;
    const CC_CALLING_CODE = 2;

    /* Constant array - Two dimension with key */
    const COUNTRY_CODE_ARRAY = array(
        'ARG' => array( 'Argentina', 'Buenos Aires', '011' ),
        'BRA' => array( 'Brazil',    'Brasilia',     '55'  ),
        'COL' => array( 'Colombia',  'Bogota',       '57'  )
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

    /* Empty two dimension array */
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

    /* Lookup key in two dimension constant array */
    $Key = 'COL';
    if ( array_key_exists( $Key, COUNTRY_CODE_ARRAY ) ) {

        /* Key lookup returns the subarray */
        $LookupArray = COUNTRY_CODE_ARRAY[ $Key ];

        /* Print elements of subarray */
        echo( 'Country code Found' . PHP_EOL );
        
        echo( 'Country Code: ' . $Key . PHP_EOL .
              'Country:      ' . $LookupArray[ CC_COUNTRY      ] . PHP_EOL .
              'Capital:      ' . $LookupArray[ CC_CAPITAL      ] . PHP_EOL .
              'Calling Code: ' . $LookupArray[ CC_CALLING_CODE ] . PHP_EOL );

    } else {
        echo( 'Key ' . $Key . ' not found' . PHP_EOL );
    }    

    /* Get first key */
    echo( 'First key: ' . array_key_first( COUNTRY_CODE_ARRAY ) . PHP_EOL );

    /* Get last key */
    echo( 'Last Key: ' . array_key_last( COUNTRY_CODE_ARRAY ) . PHP_EOL );

    /* Adding to array - single dimension */
    $ArrayBirds = [];

    array_push( $ArrayBirds, 'rainbow lorikeet', 'galah', 'bowerbird', 'cockatoo', 'magpie' );
    print_r( $ArrayBirds );

    /* Remove last element */
    print_r( array_pop( $ArrayBirds ) );

    /* When creating subarrays we clone the original array sa array_chunk will modify original array */
    $TempArray = array_merge( $ArrayBirds );

    /* Create arrays from an array - will create two sub arrays */
    $ArrayBirds2 = array_chunk( $TempArray, 2 );
    echo( 'Birds 2' . PHP_EOL );
    //print_r( $ArrayBirds2 );

    /* Sorting birds array */
    print_r( sort( $ArrayBirds ) );

    




  



