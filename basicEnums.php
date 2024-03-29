<?php

    /* 
    ** Script      : basicEnums.php - Basic Enumerations in PHP 
    ** Mode        : Console (run using php -f basicEnums.php)
    ** Create Date : Sat 9 Oct 2021
    /*

    /* Force strict types */
    declare( strict_types = 1 );

    /* Non-backed enum - no implicit value - cannot use with ->value keyword */
    enum TCitiesEnum {
        case Paris;
        case Toulouse;
        case Lyon;
    }

    /* Associated array to retrieve label as string */
    const CITIES_ARRAY = array(
        1 => 'London',
        2 => 'Bristol',
        3 => 'Birmingham'
    );    

    /* Backed Enum - has a value associated with it */
    enum TCitiesBackedEnum : int {

        case London     = 1;
        case Bristol    = 2;
        case Birmingham = 3;

        /* Returns associated array string value - this method is useful if the
           returned value is an array itself - hence better to keep separate */
        public function label() : string {
            $Num = $this->value;
            return( CITIES_ARRAY[ $Num ] );
        }

        /* We can also return match */
        public function label2() : string {
            return match ( $this ) {
                self::London     => 'London',
                self::Bristol    => 'Bristol',
                self::Birmingham => 'Birmingham',
            };
        }

    }    

    const PE_COMMON_NAME   = 0;
    const PE_ATOMIC_NUMBER = 1;
    const PE_ATOMIC_WEIGHT = 2;

    /* Enums with methods - returns array */
    enum TPeriodicEnum {

        case Scandium;
        case Titanium;
        case Vanadium;

        public function symbol() : array {
            return match( $this ) {
                self::Scandium => array( 'Sc', 21, 44.956 ),
                self::Titanium => array( 'Ti', 22, 47.867 ),
                self::Vanadium => array( 'V',  39, 88.906 ),
            };
        }

    }

    // Main ////////////////////////////////////////////////////////////////////    

    /* Assigning to variables */
    $City1 = TCitiesEnum::Paris;
    $City2 = TCitiesEnum::Lyon;

    $City3 = TCitiesBackedEnum::London;
    $City4 = TCitiesBackedEnum::Bristol;

    /* Enum comparisons */
    if ( $City1 == $City2 ) {
        echo( "French cities are the same\n" );
    } else {
        echo( "French cities are different\n" );        
    }

    /* Enum comparisons */
    if ( $City3 == $City4 ) {
        echo( "English cities are the same\n" );
    } else {
        echo( "English cities are different\n" );        
    }

    /* Get value from enum with methods */
    $Element = TPeriodicEnum::Titanium;
    echo( $Element->symbol()[ PE_COMMON_NAME   ] . ' ' .
          $Element->symbol()[ PE_ATOMIC_NUMBER ] . ' ' .
          $Element->symbol()[ PE_ATOMIC_WEIGHT ] . PHP_EOL );

    /* Geting enum value - only possible for backed enums */
    echo( 'London  ' . TCitiesBackedEnum::London->value . PHP_EOL );
    echo( 'London  ' . $City3->value . PHP_EOL );
    echo( 'Bristol ' . $City4->value . PHP_EOL );

    /* Serializing enums - we can set enum both from enum label or value contained (for backed enums ) */
    //$FrenchCity = TCitiesEnum::from( 0 ); <-- Does not work as enum is not backed

    /* Assigning value using number */
    $BritishCity = TCitiesBackedEnum::from( 2 );
    if ( $BritishCity == TCitiesBackedEnum::Bristol ) {
        echo( 'City is Bristol' . PHP_EOL );
    }

    /* It's not currently possible to get string form of enum label such as 
       Pascal's GetEnumName function - the solution is to use an associative 
       constant array or methods in the enum } */
    echo( CITIES_ARRAY[ $BritishCity->value ] . PHP_EOL );

    /* For the reverse operation where a string is passed we search the associative
       array for the key which becomes the value to assign enum */
    $SearchString = 'Bristol';
    /* Perform array search - true indicates strict matching */
    $Key          = array_search( $SearchString, CITIES_ARRAY, true );
    $BritishCity2 = TCitiesBackedEnum::from( $Key );
    if ( $BritishCity2 == TCitiesBackedEnum::Bristol ) {
        echo( 'Bristol was found' . PHP_EOL );
    } else {
        echo( 'Bristol was not found' . PHP_EOL );
    }

    /* We added a method in the enum called label to get label in string format */
    $City3 = TCitiesBackedEnum::Birmingham;
    echo( 'I like living in ' . $City3->label() . PHP_EOL );
    echo( 'I like living in ' . $City3->label2() . PHP_EOL );

    
