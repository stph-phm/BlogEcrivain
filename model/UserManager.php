<?php
namespace App\Model;

use App\Model\Manager;

include_once 'model/Manager.php';

class UserManager extends Manager 
{
    public $user_id;
    public $username;
    public $is_admin; 
    public $email_user;
    public $password_user;

    public function getUsernameExist($username)
    {
        $db = $this->dbConnect();
        $reqUsername = $db->prepare('SELECT * FROM users WHERE username = :username');
        $reqUsername->execute([
            'username' => $username
            ]);
        $userExist = $reqUsername->rowCount();

        return $userExist;
    }

    public function getMailExist($email_user)
    {
        $db = $this->dbConnect();
        $reqMail = $db->prepare('SELECT * FROM users WHERE email_user = :email_user');
        $reqMail->execute([
            'email_user' => $email_user
        ]);
        $mailExist = $reqMail->rowCount();
        
        return $mailExist;
    }

    public function insertNewUser($username,$email_user, $password_user)
    {
        $db = $this->dbConnect();
        $reqUSer = $db->prepare('INSERT INTO users(username, email_user, password_user, date_user) VALUES (:username, :email_user, :password_user,NOW())');
        $insertUser = $reqUSer->execute([
            'username'          => $username,
            'email_user'        => $email_user, 
            'password_user'     => $password_user 
        ]);

        return $insertUser;
    }

    public function getUserbyMail($email_user)
    {
        $db = $this->dbConnect();
        $reqMail = $db->prepare('SELECT *  FROM users WHERE email_user = :email_user');
        $reqMail->execute([
            'email_user' => $email_user
        ]);

        $user = $reqMail->fetch();

        return $user;
    }

    public function getUser($user_id)
    {
        $db = $this->dbConnect();
        $reqUSer = $db->prepare('SELECT * FROM user WHERE id = :id');
        $reqUSer->execute([
            'id' => $user_id
        ]);

        $userInfo = $reqUSer->fetch();

        return $userInfo;
    }


}