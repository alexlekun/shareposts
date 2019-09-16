<?php 
	// Flash message helper
	session_start();
	function flash($name = '', $message = '', $class = 'alert alert-success'){
		//Выполняется перед редиректом на необходимую страницу. 
		//Заполняются необходимые сессионные переменные. 
		//Пример flash('success', 'Your registration is complete. Now you can log in.');
		if (!empty($name)) {
			if (!empty($message) && empty($_SESSION[$name])) {

				if (!empty($_SESSION[$name])) {
					unset($_SESSION[$name]);
				}

				if (!empty($_SESSION[$name. '_class'])) {
					unset($_SESSION[$name. '_class']);
				}

				$_SESSION[$name] = $message;
				$_SESSION[$name. '_class'] = $class;
			//Выполняется на странице куда перенаправились. 
			//Выводится нужное сообщение. За счет того что все было в сессии и уничтожается сообщение всплывает единожды. 
			//Пример flash('success');
			} elseif (empty($message) && !empty($_SESSION[$name])) {
				$class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
				echo "<div class = ' " . $class . "' id = 'msg-flash'>" . $_SESSION[$name] . "</div>";
				unset($_SESSION[$name]);
				unset($_SESSION[$name. '_class']);
			}
		}
	}

	function isLoggedIn(){
			if (isset($_SESSION['user_id'])) {
				return true;
			} else {
				return false;
			}
		}