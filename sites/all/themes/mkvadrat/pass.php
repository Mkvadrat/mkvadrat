define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
require_once DRUPAL_ROOT . '/includes/password.inc';
  
// В функцию user_hash_password() передаем значение нового пароля
$newhash = user_hash_password('passwd');

// Обновляем пользователя
$updatepass = db_update('users')
  ->fields(array(
    'pass' => $newhash,
// Для изменения логина у uid=1 или email расскоментируйте следующие строки
//    'name' => 'admin',
//    'mail' => 'yourmail@example.com'
  ))
  ->condition('uid', '1', '=')
  ->execute();
print "Пароль был изменен. Не забудьте удалить файл";
drupal_exit();