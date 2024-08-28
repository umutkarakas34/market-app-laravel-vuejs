<?php
try {
    $pdo = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=market_siparis", "postgres", "lPJYja3W1GiT2IPY");
    echo "PostgreSQL bağlantısı başarılı!";
} catch (PDOException $e) {
    echo "Bağlantı başarısız: " . $e->getMessage();
}
?>
