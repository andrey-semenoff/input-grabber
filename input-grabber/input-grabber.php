<?php 
/*
Plugin Name: Input Grabber
Description: Плагин для сбора данных введенных посетителями сайта на странице регистрации.
Version: 1.0
Author: Андрей Семенов
*/


function register_grabber_page() {
	add_menu_page( 
		'Input Grabber', 'Grabber', 8, 'input-grabber/grabber-admin-page.php', '', plugins_url('input-grabber/img/icon-grabber.png'), 26 
		); 
}
wp_register_style( 'grabber-style', plugins_url('input-grabber/style/grabber-style.css') );
wp_enqueue_style('grabber-style');
wp_enqueue_script('custom', plugins_url('input-grabber/js/custom.js'), '', '', true);
add_action( 'admin_menu', 'register_grabber_page' );
?>