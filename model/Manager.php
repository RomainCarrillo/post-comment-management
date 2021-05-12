<?php

namespace RomainCarrillo\Blog\Model;

class Manager {

    protected function dbConnect() {
        $db = new \PDO('mysql:host=localhost;dbname=blog;chartset=utf8', 'root', 'root');
        return $db;
    }
}

?>