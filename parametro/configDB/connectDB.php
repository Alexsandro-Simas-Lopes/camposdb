<?php

class connectDB {

    public static function getInstance() {
        static $instance;
        if (!isset($instance)) {
            $host = 'localhost';
            $dbname = 'scientific_articles'; // Nome correto do banco de dados
            $user = 'root';       // Nome do usuário correto
            $senha = '2025';      // Senha correta
            $porta = '3306';      // Porta do MySQL

            try {
                $instance = new PDO("mysql:host=$host;port=$porta;dbname=$dbname;charset=utf8", $user, $senha);
                $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados: " . $e->getMessage());
            }
        }

        return $instance;
    }
}