<?php
namespace App\Model;

use App\Model\Manager;

class UserManager extends Manager 
{
    public $user_id;
    public $username;
    public $is_admin; 
    public $email_user;
    public $password_user;

    public function getUser()
    {
        $db = $this->dbConnect();
        $reqUSer = $db->query('SELECT id, username, email_user, is_admin, date_user
        FROM users');

        $user = $reqUSer->fetchAll();

        return $user;
    }

    public function ifUsernameExist($username)
    {
        $db = $this->dbConnect();
        $reqUsername = $db->prepare('SELECT * FROM users WHERE username = :username');
        $reqUsername->execute([
            'username' => $username
            ]);
        $userExist = $reqUsername->rowCount();

        return $userExist;
    }

    public function ifMailExist($email_user)
    {
        $db = $this->dbConnect();
        $reqMail = $db->prepare('SELECT * FROM users WHERE email_user = :email_user');
        $reqMail->execute([
            'email_user' => $email_user
        ]);
        $mailExist = $reqMail->rowCount();
        
        return $mailExist;
    }

    public function addNewUser($username,$email_user, $password_user)
    {
        $db = $this->dbConnect();
        $reqUSer = $db->prepare('INSERT INTO users(username, email_user, password_user, date_user) 
        VALUES (:username, :email_user, :password_user,NOW())');
        $insertUser = $reqUSer->execute([
            'username'          => $username,
            'email_user'        => $email_user, 
            'password_user'     => $password_user 
        ]);
        return $insertUser;
    }

    public function userByEmail($email_user)
    {
        $db = $this->dbConnect();
        $reqMail = $db->prepare('SELECT id, username, password_user FROM users WHERE email_user = :email_user');
        $reqMail->execute([
            'email_user' => $email_user
        ]);

        $user = $reqMail->fetch();

        return $user;
    }

    public function getUserById($user_id)
    {
        $db = $this->dbConnect();
        $reqUSer = $db->prepare('SELECT id, username, email_user, is_admin, date_user  FROM users WHERE id = ?');
        $reqUSer->execute([$user_id]);

        $userInfo = $reqUSer->fetch();

        return $userInfo;
    }
}