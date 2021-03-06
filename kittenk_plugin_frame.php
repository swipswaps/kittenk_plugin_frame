<?php
/*
* @package kittenk_plugin_frame
*/
/**
 * Plugin Name:       KittenK WordPress Plugin Frame 
 * Plugin URI:        
 * Description:       Customizeable WordPress Plugin Frame to kickstart development.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Amy Kamala
 * Author URI:        https://kittenkamala.com
 * License:           GPL v3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       kittenkpf
 **/



defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class kittenKPF {

    function __construct() {
        add_action( 'init', array($this, 'register_style'));
        add_action( 'init', array($this, 'enqueue_style'));
    } 
    
    //add menu options
    function kkpf_menu() {
        add_submenu_page( 'tools.php', 'KittenK Plugin Frame', 'KittenK PF Options', 'manage_options', 'KittenKPF', array($this,'kkpf_page') );
    }

    function kkpf_page() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        echo '<div class="wrap">';
        echo '<p> <h1 align="center">=^_^= <br> KittenK Plugin Frame</h1><br></p>';
        echo '</div>';
    }

  //register stylesheet on plugin initialization
  function register_style(){
      wp_register_style( 'test_style', plugins_url('/css/test_style.css', __FILE__), false, '1.0.0', 'all'); 
    }
  //enqueue stylesheet on initialization 
  function enqueue_style(){
      wp_enqueue_style( 'test_style' ); #todo, make this for plugin admin and posts only 
    }


  //activation
  function activate() {
      
      //include plugin stylesheet
      //Ensure the $wp_rewrite global is loaded
      global $wp_rewrite;
      //Call flush_rules() as a method of the $wp_rewrite object
      $wp_rewrite->flush_rules( false );
  }

  //deactivation
  function deactivate() {
      //Ensure the $wp_rewrite global is loaded
      global $wp_rewrite;
      //Call flush_rules() as a method of the $wp_rewrite object
      $wp_rewrite->flush_rules( false );
  }


   public static function pf_function( $attributes ){
    //your code here
    }
}

if ( class_exists( 'kittenKPF' )) {
  $kittenKPF = new kittenKPF();
}

register_activation_hook( __FILE__, array( $kittenKPF, 'activate'));
register_deactivation_hook( __FILE__, array( $kittenKPF, 'deactivate'));
add_action( 'admin_menu', array($kittenKPF, 'kkpf_menu'));