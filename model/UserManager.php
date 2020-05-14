<?php
namespace App\Model;

use App\Model\Manager;

include_once 'model/Manager.php';

class UserManager extends Manager 
{
    public $user_id;
    public $username;
    public $status_user;
    public $email_user;
    public $password_user;
    


    /**
     * Get all the users of the database to connect 
     * @param $email_user, $password_user
     * @return $userExist
     */
    public function loginUser($email_user, $password_user) {
        $db =  $this->dbConnect();
        $reqUser = $db->prepare('SELECT * FROM  users WHERE email_user = :email_user AND password_user = :password_user');

        $reqUser->execute(array(":email_user" => $email_user, ":password_user" => $password_user));

        $userExist = $reqUser->rowCount();

        return $userExist;
    }

        public function getProfilUser()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM  users WHERE id = ?');

        $reqUser->execute(array());

        $userInfo = $reqUser->fetch();

        return $userInfo;
    }

    /**
     * Add users to the database users 
     * @param $username, $email_user, $password_user
     * @return $insertUser
     */
    public function addUser($username,$email_user, $password_user) 
    {
        $db = $this->dbConnect();
        $reqUser = $db->prepare('INSERT INTO users(username,email_user, password_user, date_user) VALUES (:username,:email_user, :password_user, NOW())');
        
        $insertUser = $reqUser->execute(array(":username"  => $username,":email_user" => $email_user, ":password_user" => $password_user));

        return $insertUser;
    }

    /**
     * Retrieves all the emails already existing in the database users 
     * @param $email_user
     * @return $mailExist
     */
    public function checkMail($email_user)
    {
        $db = $this->dbConnect();
        $reqMail = $db->prepare('SELECT * FROM users where  email_user = ?');

        $reqMail->execute(array($email_user));

        $mailExist = $reqMail->rowCount();

        return $mailExist;
    }



    /**
     * Changement de status de visiteur à admin
     */
    public function statusChangeInAdmin($status_user) 
    {
        $db = $this->dbConnect();
        $reqUser = $db->prepare('UPDATE users SET status_user = 1');
        $reqUser->execute(array("status_user" => $status_user));
    } 

    /**
     * Changement de status Admin a visiteur
     */
    public function statusChangeAdminToVisitor($status_user)
    {
        $db = $this->dbConnect();
        $reqUser = $db->prepare('UPDATE users SET status_user = 0');
        $reqUser->execute(array("status_user" => $status_user));
    } 


    /**
     * Récupère tous les user non admin 
     */
    public function getAllVisitor()
    {
        $db = $this->dbConnect();
        $reqUser = $db->query('SELECT * FROM users');

        $listVisitor = $reqUser->fetchAll();
        return $listVisitor;
    }

}