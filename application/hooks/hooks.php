<?php

function auth_check()
{
	//die('in');
	//	$ci = &get_instance();
	//
	//	if(!is_admin() && $ci->uri->segment(1) == 'admin') {
	//		if($ci->uri->segment(2) == 'login' || $ci->uri->segment(2) == 'process-login') {
	//
	//		} else {
	//			//show_404();
	//		}
	//	}
	
	$ci = &get_instance();

	// Check if the user is logged in and the route is 'members'
	if (!$ci->session->userdata('logged_in') && $ci->uri->segment(1) == 'members') {
		// Redirect to login page or show an error
		redirect('log-in');
	}
}
