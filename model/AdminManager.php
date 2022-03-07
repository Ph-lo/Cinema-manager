<?php

require_once('model/Manager.php');

class AdminManager extends Manager {
    public function adminConnect($login, $pass) {
        $db = $this->dbConnect();
        $queryLogin = $db->prepare('SELECT * FROM admins a WHERE a.login = :loginSent');
        $queryLogin->execute(array('loginSent' => $login));
        $loginMatch = $queryLogin->rowCount();

        if($loginMatch == 1) {
            $infos = $queryLogin->fetch();
            $adminPass = $infos['pass'];
            // $password = password_verify($pass, $adminPass);

            if(password_verify($pass, $adminPass)) {
                $_SESSION['admin'] = $infos['login'];
            } else {
                throw new Exception('Wrong email or password');
            }


        } else {
            throw new Exception('Wrong email or password');
        }
    }

    public function bye() {
        $dir = '../W-PHP-501-STG-1-1-MYCINEMA-PHILIPPE.LOCATELLI';
        $this->adios($dir);
    }
}