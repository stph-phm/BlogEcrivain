<?php 

$db = new PDO ('mysql:host=localhost;dbname=blog;charset=utf8','root','');
$req = $db->query('SELECT id, chapter_order, title, content, DATE_FORMAT(date_article, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM articles ORDER BY chapter_order DESC');

include 'indexView.php';
