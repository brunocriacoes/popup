<?php

    $pasta = __DIR__ . "/../../uploads/lead-popup/";

    

    if( !empty( $_REQUEST['email'] ) ) 
    {
        if( !file_exists($pasta . "lista.txt") ) {
            
            file_put_contents( $pasta . "lista.txt", '' );
        } 
        file_put_contents( $pasta . "lista.txt", "\n" . $_REQUEST['email'], FILE_APPEND );
        die;
    }

    if( !empty( $_REQUEST['file'] ) ) 
    {    
        $file  = $_REQUEST['file'] ?? '';
        $name  = "foto.jpg";  
        $file  = base64_decode( $file  ); 
        $file  = explode(',', $file  ); 
        $file  = $file[1] ?? '';
        $file  = base64_decode( $file );
        file_put_contents ( "{$pasta}{$name}", $file );
        die;
    }