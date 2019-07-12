<?php 

defined( 'ABSPATH' ) or die( 'area restrita' );

/*
Plugin Name: POPUP
Plugin URI: https://github.com/brunocriacoes/popup
Description: Gerador de popup para captura de numero de WhatsApp
Author: Bruno Vieira
Version: 1.0
Author URI: http://solucaosites.com.br
*/

function m_menu ()
{
    add_menu_page(
        "POPUP",
        "POPUP",
        "manage_options",
        "popup/index.php",
        "",
        plugins_url( "popup/src/ico/megaphone.svg" ),
        2
    );
}
add_action ( 'admin_menu', 'm_menu');


function printPop() {
    include __DIR__ . "/print.php";
}
add_action( 'wp_footer', 'printPop' );