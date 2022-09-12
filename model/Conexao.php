<?php
class Conexao{
    private static $instancia;

    public static function getConexao(){
        if(!isset(self::$instancia)){// Estou testando quando o atributo não existir
            self::$instancia = new PDO("mysql:host=localhost;dbname=projeto_login","root","");

        }
        return self::$instancia;
    }
}