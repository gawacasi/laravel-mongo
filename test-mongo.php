<?php
try {
    $manager = new MongoDB\Driver\Manager('mongodb://root:root@mongo-db:27017/?authSource=admin');
    echo 'Conexão com o MongoDB estabelecida com sucesso.';
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo 'Falha ao conectar ao MongoDB: ' . $e->getMessage();
}
?>
