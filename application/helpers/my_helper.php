<?php

function is_logged_in()
{
	$ths = &get_instance();
	if ($ths->session->userdata('username')) {
		redirect('home');
	}
}

function is_logged_not_in()
{
	$ths = &get_instance();
	if (!$ths->session->userdata('username')) {
		$ths->session->set_flashdata('error', 'Login terlebih dahulu');
		redirect('login');
	}
}
function activeMenu($segment1, $segment2 = [], $value)
{
	$ths = &get_instance();
	if (in_array($ths->uri->segment(1), $segment1) && in_array($ths->uri->segment(2), $segment2)) {
		return $value;
	}
}
