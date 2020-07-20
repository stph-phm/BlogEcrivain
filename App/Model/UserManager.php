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

    /**
     * @return array
     */
    public function getUser()
    {
        $db = $this->dbConnect();
        $reqUSer = $db->query('
            SELECT *
            FROM users
        ');
        return $user = $reqUSer->fetchAll();

    }

    /**
     * @param $username
     * @return int
     */
    public function getIfUsernameExist($username)
    {
        $db = $this->dbConnect();
        $reqUsername = $db->prepare('
            SELECT * 
            FROM users 
            WHERE username = :username');
        $reqUsername->execute([
            'username' => $username
            ]);
        return $ifUserExist = $reqUsername->rowCount();

    }

    /**
     * @param $email_user
     * @return int
     */
    public function getIfMailExist($email_user)
    {
        $db = $this->dbConnect();
        $reqMail = $db->prepare('
        SELECT * 
        FROM users 
        WHERE email_user = :email_user');
        $reqMail->execute([
            'email_user' => $email_user
        ]);

        return  $ifMailExist = $reqMail->rowCount();
    }

    /**
     * @param $username
     * @param $email_user
     * @param $password_user
     * @return bool
     */
    public function addUSer($username,$email_user, $password_user)
    {
        $db = $this->dbConnect();
        $reqUSer = $db->prepare('
        INSERT INTO users(username, email_user, password_user, date_user) 
        VALUES (:username, :email_user, :password_user,NOW())');

        return $addUser = $reqUSer->execute([
            'username'          => $username,
            'email_user'        => $email_user,
            'password_user'     => $password_user
        ]);
    }

    /**
     * @param $email_user
     * @return mixed
     */
    public function getUserByEmail($email_user)
    {
        $db = $this->dbConnect();
        $reqMail = $db->prepare('
            SELECT *
            FROM users 
            WHERE email_user = :email_user
        ');
        $reqMail->execute([
            'email_user' => $email_user
        ]);

        return $userByEmail = $reqMail->fetch();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function getUserById($user_id)
    {
        $db = $this->dbConnect();
        $reqUSer = $db->prepare('
            SELECT *
            FROM users 
            WHERE id = :id 
        ');
        $reqUSer->execute([
            'id'=> $user_id
        ]);
        return $userById = $reqUSer->fetch();
    }
}