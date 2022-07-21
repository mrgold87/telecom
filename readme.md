# Установка WordPress-темы telecom
1. Скачиваем тему из репозитория
2. Помещаем тему(telecom) в директорию с темами WordPress: your_site/wp-content/themes
3. Активируем тему в админ-панели WordPress -сайта: http://your_site.loc/wp-admin/themes.php
4. Устанавливаем плагин ContactForm 7 в админ-панели WordPress -сайта: http://your_site.loc/wp-admin/plugins.php
5. Импортируем форму обратной связи на странице импорта: http://your_site.loc/wp-admin/import.php Выбираем пунк  WordPress> запустить импорт. Загружаем файл k-telecom.WordPress.2022-07-17.xml из корня проекта.
6. Устанавливаем плагин advance custom fields 
7. На странице http://your_site.loc/wp-admin/edit.php?post_type=acf-field-group&page=acf-tools импортируем файл acf-export-2022-07-21.json из корня проекта
8. Создаём страницу(http://your_site.loc/wp-admin/edit.php?post_type=page). Выбираем для неё шаблон 'Front Page'. Внизу страницы редактирования появляется select-поле с заголовком Контактная форма, где необходимо выбрать значение 'Контактная форма 1'. Сохраняем страницу.
9. Заполняем слайдер несколькими слайдами на странице: http://your_site.loc/wp-admin/edit.php?post_type=slider
10. Заполняем раздел 'тарифы' несколькими тарифами на странице:http://your_site.loc/wp-admin/edit.php?post_type=tariff