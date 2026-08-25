<?php $start = microtime(true); $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=website_sekolah_rekomendasi', 'root', ''); echo '127.0.0.1 took ' . (microtime(true) - $start) . 's\n'; 
