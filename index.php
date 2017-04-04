<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
menu_execute_active_handler();

/*Выполнение крон*/
$cron_time=filemtime("cron_time");    //получаем время последнего изменения файла
if (time()-$cron_time>=86400) {        //сравниваем с текущим временем - 10 минут
    file_put_contents("cron_time","");    //перезаписываем файл cron_time
    include "backup.php";                //выполняем скрипты из файла cron.php
}