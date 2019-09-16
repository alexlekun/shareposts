<?php 
	//Redirect to the page
	function redirect($page){
		header('location: ' . URLROOT . '/' . $page);
	}