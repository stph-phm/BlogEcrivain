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
    

    public function username($username) {
        $db =  $this->dbConnect();
        $reqUser = $db->prepare('SELECT id, username, password_user,  DATE_FORMAT(date_user, \'%d/%m/%Y à %Hh%imin\' ) AS date_fr FROM  users');

        $reqUser->execute(array("username" => $username));
        $user = $reqUser->fetch();

        return $user;
    }

    /**
     * Ajout des comptes visiteur 
     */
    public function addUser($username,$status_user,$email_user, $password_user) 
    {
        $db = $this->dbConnect();
        $reqUser = $db->prepare('INSERT INTO users(username,status_user email_user, password_user, date_user) VALUES (:username, 0 :email_user, :password_user, NOW())');
        $reqUser->execute(array("username" => $username, "status_user" => $status_user, "email_user"  => $email_user, "password_user" => $password_user ));
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

    }

}