<?php
	/**
	 * 
	 */
	
	class Core
	{
		protected $currentController = 'Pages';
		protected $currentMethod = 'index';
		protected $params = [];
		
		function __construct()
		{
			$url = $this->getUrl();
			// Проверяем есть ли контроллер который указан в URL
			if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
				// Устанавливаем контроллер
				$this->currentController = ucwords($url[0]);
				// удалем нулевой индекс массива
				unset($url[0]);
			}

			// Притягиваем файл контроллера
			require_once '../app/controllers/' . $this->currentController . '.php';
			// Вызываем контроллер
			$this->currentController = new $this->currentController;
			// Проверяем существ ли метод в классе. Если да, то забиваем его
			if(isset($url[1])){
				if (method_exists($this->currentController, $url[1])) {
					$this->currentMethod = $url[1];
					unset($url[1]);
				}
			}


			$this->params = $url ? array_values($url) : [];

			call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

		}

		public function getUrl(){
			if (isset($_GET['url'])) {
				$url = rtrim($_GET['url'], '/');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('/', $url);
				return $url;
			}
		}
	}