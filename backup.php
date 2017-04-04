<?
// Резервное копирование MySQL и файлов хостинга
// Версия 2.1 Яндекс

$dbhost = "localhost"; //Адрес MySQL сервера
$dbuser = "mkvadrat_kvadrat"; //Имя пользователя базы данных
$dbpass = "x*fr_a0VTGs{"; //Пароль пользователя базы данных
$dbname = "mkvadrat_mkvadrat"; //Имя базы данных

/*$sitedir = "/home/username/public_html"; //Абсолютный путь к сайту от корня диска
$excludefile = $sitedir.'/backup/*.gz'; //Файлы которые не должны попасть в архив
*/
$yadisk_email='mkvadrat2016@yandex.ru'; //Имя пользователя Яндекс.Диск
$yadisk_pass='mkvadrat2016557611'; //Пароль пользователя Яндекс.Диск
$yadisc_dir='backup_databases/mkvadrat/'; //Директория на Яндекс.Диск куда будем копировать. Она должна существовать!

// Все что ниже, лучше не трогать

$dbbackup = $dbname .'_'. date("Y-m-d_H-i-s") . '.sql.gz';
$filebackup = 'files_'. date("Y-m-d_H-i-s") .'.tar.gz';

//system("mysqldump -h $dbhost -u $dbuser --password='$dbpass' $dbname | gzip > $dbbackup");
//Для больших баз данных закоментировать строчку выше и раскоментировать ниже.
system("mysqldump --quick -h $dbhost -u $dbuser --password='$dbpass' $dbname | gzip > $dbbackup");

system("curl --user $yadisk_email:$yadisk_pass -T $dbbackup https://webdav.yandex.ru/$yadisc_dir");
unlink($dbbackup);
/*
shell_exec("tar cvfz $filebackup $sitedir --exclude=$filebackup --exclude=$excludefile"); 

system ("curl --user $yadisk_email:$yadisk_pass -T $filebackup https://webdav.yandex.ru/$yadisc_dir");
unlink($filebackup);*/
?>