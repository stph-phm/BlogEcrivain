<?php
namespace App\Message;
class FlashMessage
{
    public function setErrorMsg($message) {
        $_SESSION['errorMsg'] = $message;
    }

   public function setSuccessMsg($message) {
        return $_SESSION['successMsg'] = $message;
   }

   public function displayMsg() {
       $msgSuccess = $_SESSION['successMsg'];
       $msgError = $_SESSION['errorMsg'];

       if ($this->setSuccessMsg($msgSuccess)) {
           return $msgSuccess;
           unset($msgSuccess);

       } elseif ($this->setErrorMsg($msgError)) {
           return $msgError;
           unset($msgError);
       }
   }
}