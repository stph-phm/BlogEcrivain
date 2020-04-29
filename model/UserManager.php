<?php
namespace App\Blog\Model;

include_once 'model/Manager.php';

class UserManager extends Manager 
{
    public $id_users;
    public $username;
    public $password_user;

    public function username($username) {
        $db =  $this->dbConnect();
        $reqUser = $db->prepare('SELECT id, username, password_user,  DATE_FORMAT(date_user, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM  users');

        $reqUser->execute(array($username));
        $user = $reqUser->fetch();

        return $user;
    }
}