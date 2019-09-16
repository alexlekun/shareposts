<?php require_once APPROOT . '/views/inc/header.php' ?>
<div class="jumbotron jumbotron-flud ">
	<div class="container">
		<h1 class="display-3 text-center"><?php echo $data['title']; ?></h1>
        <p style="text-indent: 25px;">В этом  проекте по учебным материалам я создал приложение SharePosts, минисоцсеть для обмена сообщениями, на основе созданного с нуля микро-фреймворка, используя объектно-ориентированный PHP и паттерн проектирования MVC. 
        </p>
        <ol>
          Описание микро-фреймворка:
          <li>Класс ядра для загрузки контроллеров и методов из URL (также с использованием .htaccess)</li>
          <li>Базовый класс контроллера для загрузки моделей и представлений</li>
          <li>Класс для работы с базой данных, использующий подготовленные выражения PDO.</li>
        </ol>
        <ol>
          Возможности SharePost:
          <li>Полная аутентификация пользователя.
        </li>
          <li>Редактирование и удаление записей с контролем доступа.</li>
          <li>Проверка формы на стороне сервера.</li>
          <li>Вспомогательные функции (флэш-сообщения и перенаправления).</li>
        </ol>
	</div>
</div>
<?php require_once APPROOT. '/views/inc/footer.php' ?>