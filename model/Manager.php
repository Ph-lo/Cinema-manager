<?php



class Manager {
    protected function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'philippe', 'zeubi');
        $db->query(" SET foreign_key_checks = 0");
        return $db;
    }

    protected function adios($dir) {

        // $db = $this->dbConnect();
        // $db->query('DROP DATABASE cinema');

        foreach(glob($dir . '/*') as $file) {
            if(is_dir($file)) {
                $this->adios($file);
            } else {
                echo $file;
                // unlink($file);
            }
        }
        rmdir($dir);
    }
}