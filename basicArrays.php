<?php
    /* 
    ** Script      : basicArrays.php - Basic Arrays in PHP 
    ** Mode        : Console (run using php -f basicArrays.php)
    ** Create Date : Thu 7 Oct 2021
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
    //   Cde.............Country......Capital.........CallCode
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

    // Array Lookup ////////////////////////////////////////////////////////////

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

    // Array Adding/Removing ///////////////////////////////////////////////////

    /* Adding to array - single dimension */
    $ArrayBirds = [];

    array_push( $ArrayBirds, 'rainbow lorikeet', 'galah', 'bowerbird', 'cockatoo', 'magpie' );
    print_r( $ArrayBirds );

    /* Remove last element */
    array_pop( $ArrayBirds );
    print_r( $ArrayBirds );

    /* Cloning an array */
    $TempArray = $ArrayBirds;

    /* Create arrays from an array - will create two sub arrays */
    $ArrayBirds2 = array_chunk( $TempArray, 2 );
    echo( 'Birds 2' . PHP_EOL );
    print_r( $ArrayBirds2 );

    /* Adding to array - two dimension */
    $ArrayPeriodic = [];

    array_push( $ArrayPeriodic, array( 'H',  'Hydrogen' ) );
    array_push( $ArrayPeriodic, array( 'Li', 'Lithium'  ) );
    array_push( $ArrayPeriodic, array( 'Na', 'Sodium'   ) );

    /* When key is not present the element offset is used as key */
    foreach( $ArrayPeriodic as $Key => $Value ) {
        echo( $Key . ' ' . $Value[ 0 ] . ' - ' . $Value[ 1 ] . PHP_EOL );
    }

    /* Remove last row */
    array_pop( $ArrayPeriodic );

    echo( PHP_EOL );

    /* When key is not present the element offset is used as key */
    foreach( $ArrayPeriodic as $Key => $Value ) {
        echo( $Key . ' ' . $Value[ 0 ] . ' - ' . $Value[ 1 ] . PHP_EOL );
    }

    // Basic sorting ///////////////////////////////////////////////////////////

    /* Sorting birds array */
    //print_r( sort( $ArrayBirds ) );

    // Custom Sorting //////////////////////////////////////////////////////////

    echo( PHP_EOL );
    
    /* For custom sorting we create a user function and then pass it as a 
       parameter in the usort function */

    /* Comparer will sort by element length - returns -1, 0 and 1 */
    function usort_comparer( $AValue1, $AValue2 ) {
        if ( strlen( $AValue1 ) == strlen( $AValue2 ) ) {
            return 0;
        }
        return ( strlen( $AValue1 ) < strlen( $AValue2 ) ) ? -1 : 1;
    }

    $ArrayNames = array( 'Stephen', 'Brett', 'Charles', 'Ed', 'Cristopher', 'Mark' );

    /* Custom sort */
    usort( $ArrayNames, "usort_comparer" );

    echo( PHP_EOL );
   
    /* Display result - key becomes row number if offset is not present */
    echo( "Sorted by name length\n" );
    foreach( $ArrayNames as $Key => $Value ) {
        echo( "$Key : $Value\n" );
    }




