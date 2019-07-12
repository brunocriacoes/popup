<?php

    function existDir()
    {
        $dir = __DIR__ . '/../../uploads/lead-popup/';
        if ( ! file_exists ( $dir ) ) 
            mkdir( $dir, 0777, true);
    }

    function getFile( $dir ) {
        if( file_exists( $dir ) ) 
            return file_get_contents( $dir );
        return '';
    }

    function getInscritos() 
    {
        $pasta   = __DIR__ . "/../../uploads/lead-popup/";
        $estatic = getFile( $pasta . "lista.txt" ) ?? '';
        $arr     = explode( "\n", $estatic );
        $arr     = array_filter( $arr, function( $el ) { return strlen( $el ) > 5; } );
        return $arr;
    }
    
    function drawTr( $arr ) 
    {
        $html = '';
        foreach( $arr as $val ) {
            $html .= "<tr> <td> {$val} </td> </tr>";
        }
        return $html;
    }

