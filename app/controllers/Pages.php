<?php
	/**
	 * 
	 */
	class Pages extends Controller
	{
		function __construct()
		{
			
		}

		public function index(){
			$data = [
				'title' => 'SharePosts',
			];

			$this->view('pages/index', $data);
			
		}

		public function about(){
			$data = [
				'title' => 'About us',
				'description' => 'Приложения для публикации своих сообщений.'
			];
			
			$this->view('pages/about', $data);

		}
	}