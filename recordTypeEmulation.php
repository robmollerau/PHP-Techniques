<?php

    /* 
    ** Script      : recordTypeEmulation.php - Record type emulation in PHP
    ** Mode        : Console (run using php -f recordTypeEmulation.php)
    ** Create Date : Sat 9 Oct 2021
    **
    ** Pascal record types and it's close C equivalent struct are useful in
    ** for creating self documenting code. Example below emulates record types
    ** within arrays.
    **
    ** The Pascal standard of T prefix for types and A prefix for parameters
    ** is used here.
    **
    /*

    /* Force strict types */
    declare( strict_types = 1 );

    /* Company sector enum */
    enum TSectorEnum : int {

        case Sales       = 1;
        case Accounting  = 2;
        case Operations  = 3;

        public function label() : string {
            return match ( $this ) {
                self::Sales       => 'Sales',
                self::Accounting  => 'Accounting',
                self::Operations  => 'Operations',
            };
        }

    }

    /* Record type emulated in the form of a class */
    class TEmployeeRec {
        public string      $FirstName;
        public string      $LastName;
        public int         $ID;
        public TSectorEnum $Sector;
    }

    // Main ////////////////////////////////////////////////////////////////////    

    $PersonnelArray = [];

    /* Add employess to personnel array */
    $EmployeeRec = new TEmployeeRec();
    $EmployeeRec->FirstName = 'Edmund';
    $EmployeeRec->LastName  = 'Barton';
    $EmployeeRec->ID        = 267;
    $EmployeeRec->Sector    = TSectorEnum::Sales;
    array_push( $PersonnelArray, $EmployeeRec );
  
    $EmployeeRec = new TEmployeeRec();
    $EmployeeRec->FirstName = 'Alfred';
    $EmployeeRec->LastName  = 'Deacon';
    $EmployeeRec->ID        = 316;
    $EmployeeRec->Sector    = TSectorEnum::Accounting;
    array_push( $PersonnelArray, $EmployeeRec );
  
    $EmployeeRec = new TEmployeeRec();
    $EmployeeRec->FirstName = 'Chris';
    $EmployeeRec->LastName  = 'Watson';
    $EmployeeRec->ID        = 1140;
    $EmployeeRec->Sector    = TSectorEnum::Operations;
    array_push( $PersonnelArray, $EmployeeRec );

    $EmployeeRec = new TEmployeeRec();
    $EmployeeRec->FirstName = 'George';
    $EmployeeRec->LastName  = 'Reid';
    $EmployeeRec->ID        = 322;
    $EmployeeRec->Sector    = TSectorEnum::Sales;
    array_push( $PersonnelArray, $EmployeeRec );

    /* Print format */
    // %         - marker for start of parameter
    // 1$,2$..n$ - placeholder for parameter order - useful in multilingual applications
    // -10s      - pad a string parameter with spaces to the right to reach 10 characters
    // 4d        - pad a decimal to the left to reach 4 characters
    $PrintFormat = 'Key: %1$2d Name: %2$-10s %3$-10s ID: %4$4d   Sector: %5$-10s';

    /* Print values unsorted */
    echo( '* Unsorted * ' . PHP_EOL );
    foreach( $PersonnelArray as $Key => $Item ) {
        $Str = sprintf( $PrintFormat, $Key, $Item->FirstName, $Item->LastName,
          $Item->ID, $Item->Sector->label() );
        echo( $Str . PHP_EOL );

    }

    /* First name comparer */
    function usort_comparer_first_name( $AValue1, $AValue2 ) {
        if ( $AValue1->FirstName == $AValue2->FirstName ) {
            return 0;
        }
        return ( $AValue1->FirstName < $AValue2->FirstName ) ? -1 : 1;
    }

    /* Sector comparer */
    function usort_comparer_sector( $AValue1, $AValue2 ) {
        if ( $AValue1->Sector->value == $AValue2->Sector->value ) {
            return 0;
        }
        return ( $AValue1->Sector->value < $AValue2->Sector->value ) ? -1 : 1;
    }

    /* We can sort sort array by first name */
    usort( $PersonnelArray, "usort_comparer_first_name" );

    /* Print values sorted first name */
    echo( PHP_EOL );
    echo( '* Sorted by First Name *' . PHP_EOL );
    foreach( $PersonnelArray as $Key => $Item ) {
        $Str = sprintf( $PrintFormat, $Key, $Item->FirstName, $Item->LastName,
          $Item->ID, $Item->Sector->label() );
        echo( $Str . PHP_EOL );
    }

    /* We can sort sort array by sector */
    usort( $PersonnelArray, "usort_comparer_sector" );

    /* Print values sorted sector */
    echo( PHP_EOL );
    echo( '* Sorted by Sector *' . PHP_EOL );
    foreach( $PersonnelArray as $Key => $Item ) {
        $Str = sprintf( $PrintFormat, $Key, $Item->FirstName, $Item->LastName,
          $Item->ID, $Item->Sector->label() );
        echo( $Str . PHP_EOL );
    }

    /* Searching for last name */
    $SearchValue = 'reid'; // <== Notice that search is lower case - we will do a case insensitive comparison
    echo( PHP_EOL );
    echo( '* Looking for ' . $SearchValue . ' - last name search *' . PHP_EOL );
    foreach( $PersonnelArray as $Key => $Item ) {
        if ( strcasecmp( $Item->LastName, $SearchValue ) == 0 ) {
            $Str = sprintf( $PrintFormat, $Key, $Item->FirstName, $Item->LastName,
              $Item->ID, $Item->Sector->label() );
            echo( $Str . PHP_EOL );
            break;
        }
    }

    /* Searching for sector */
    echo( PHP_EOL );    
    $SearchValue = TSectorEnum::Accounting;
    $EnumValue   = $SearchValue->value;
    echo( '* Looking for ' . $SearchValue->label() . ' - sector search *' . PHP_EOL );
    foreach( $PersonnelArray as $Key => $Item ) {
        if ( $Item->Sector->value == $EnumValue ) {
            $Str = sprintf( $PrintFormat, $Key, $Item->FirstName, $Item->LastName,
              $Item->ID, $Item->Sector->label() );
            echo( $Str . PHP_EOL );
        }
    }

