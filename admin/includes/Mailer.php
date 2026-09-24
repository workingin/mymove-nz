<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'brevoMailer.php';

class Mailer {

    private $db;
    private $configs;

    public function __construct($db, $configs) {
        $this->db = $db;
        $this->configs = $configs;
    }

    /* *************************************************************************************************************
     * sendActivation - Sends an activation e-mail to the newly registered user with a link to activate the account.
     * *************************************************************************************************************
     */
    function sendActivation($user, $email, $token) {
        $mail = new PHPMailer;
        $mail->setFrom($this->configs->getConfig('EMAIL_FROM_ADDR'), $this->configs->getConfig('EMAIL_FROM_NAME')); 
        $mail->Subject = $this->configs->getConfig('SITE_NAME') . " - Activate Your Account!";
        $sendto = $user;
        $mail->addAddress($email, $sendto);
        $mail->Body = $user . ",\n\n"
                . "Welcome! You've just registered at " . $this->configs->getConfig('SITE_NAME') . " "
                . "with the following username:\n\n"
                . "Username: " . $user . "\n\n"
                . "Please visit the following link in order to activate your account: "
                . $this->configs->loginPage()."?mode=activate&user=" . urlencode($user) . "&activatecode=" . $token . "#activate \n\n"
                . $this->configs->getConfig('SITE_NAME');
        return $mail->send();
    }

    /* **************************************************************************************************************************
     * adminActivation - Sends an activation e-mail to the newly registered user explaining that admin will activate the account.
     * **************************************************************************************************************************
     */
    function adminActivation($user, $email) {
        $mail = new PHPMailer;
        $mail->setFrom($this->configs->getConfig('EMAIL_FROM_ADDR'), $this->configs->getConfig('EMAIL_FROM_NAME'));
        $mail->Subject = $this->configs->getConfig('SITE_NAME') . " - Welcome!";
        $sendto = $user;
        $mail->addAddress($email, $sendto);
        $mail->Body = $user . ",\n\n"
                . "Welcome! You've just registered at " . $this->configs->getConfig('SITE_NAME') . " "
                . "with the following username:\n\n"
                . "Username: " . $user . "\n\n"
                . "Your account is currently inactive and will need to be approved by an administrator. "
                . "Another e-mail will be sent when this has occured.\n\n"
                . "Thank you for registering.\n\n"
                . $this->configs->getConfig('SITE_NAME');
        return $mail->send();
    }

    /* *******************************************************************************************************
     * activateByAdmin - Sends an activation e-mail to the admin to allow him or her to activate the account. 
     * E-mail will appear to come FROM the user using the e-mail address he or she registered with.
     * *******************************************************************************************************
     */
    function activateByAdmin($user, $email, $token) {
        $mail = new PHPMailer;
        $mail->setFrom($email,$user);
        $mail->Subject = $this->configs->getConfig('SITE_NAME') . " - User Account Activation!";
        $adminemail = $this->configs->getConfig('EMAIL_FROM_ADDR');
        $sendto = $adminemail;
        $mail->addAddress($adminemail, $sendto);
        $mail->Body = "Hello Admin,\n\n"
                . $user . " has just registered at " . $this->configs->getConfig('SITE_NAME')
                . " with the following details:\n\n"
                . "Username: " . $user . "\n"
                . "E-mail: " . $email . "\n\n"
                . "You should check this account and if neccessary, activate it. \n\n"
                . "Use this link to activate the account or visit the Admin Dashboard.\n\n"
                . $this->configs->loginPage()."?mode=activate&user=" . urlencode($user) . "&activatecode=" . $token . "#activate \n\n"
                . "Thanks.\n\n"
                . $this->configs->getConfig('SITE_NAME');
        return $mail->send();
    }

    /* **********************************************************************************
     * adminActivated - Sends an e-mail to the user once admin has activated the account.
     * **********************************************************************************
     */
    function adminActivated($user, $email) {
        $mail = new PHPMailer;
        $mail->setFrom($this->configs->getConfig('EMAIL_FROM_ADDR'), $this->configs->getConfig('EMAIL_FROM_NAME'));
        $mail->Subject = $this->configs->getConfig('SITE_NAME') . " - Account Activated!";
        $sendto = $email;
        $mail->addAddress($email, $sendto);
        $mail->Body = $user . ",\n\n"
                . "Welcome! You've just registered at " . $this->configs->getConfig('SITE_NAME') . " "
                . "with the following username:\n\n"
                . "Username: " . $user . "\n\n"
                . "Your account has now been activated. "
                . "Please click here to login - "
                . $this->configs->loginPage() . "\n\nThank you for registering.\n\n"
                . $this->configs->getConfig('SITE_NAME');
        return $mail->send();
    }

    /* **********************************************************************************************************
     * sendWelcome - Sends an activation e-mail to the newly registered user with a link to activate the account.
     * **********************************************************************************************************
     */
    function sendWelcome($user, $email) {
        $mail = new PHPMailer;
        $mail->setFrom($this->configs->getConfig('EMAIL_FROM_ADDR'), $this->configs->getConfig('EMAIL_FROM_NAME'));     
        $mail->Subject = $this->configs->getConfig('SITE_NAME') . " - Welcome!";
        $sendto = $email;
        $mail->addAddress($email, $sendto);
        $mail->Body = $user . ",\n\n"
                . "Welcome! You've just registered at " . $this->configs->getConfig('SITE_NAME') . " "
                . "with the following information:\n\n"
                . "Username: " . $user . "\n\n"
                . "Please keep this e-mail for your records. Your password is stored safely in "
                . "our database. In the event that it is forgotten, please visit the site and click "
                . "the Forgot Password link. "
                . "Thank you for registering.\n\n"
                . $this->configs->getConfig('SITE_NAME');
        return $mail->send();
    }
    
    /* **********************************************************
     * sendPassLink - Sends temp password link to email address.
     * **********************************************************
     */
    function sendPassLink($user,$userinfo, $email, $templink) {
        $mail = new BrevoMailer;
        // $mail->setFrom($this->configs->getConfig('EMAIL_FROM_ADDR'), $this->configs->getConfig('EMAIL_FROM_NAME'));
        $subject = $this->configs->getConfig('SITE_NAME') . " - Reset Your Password";
        $sendto = $email;
        // $mail->addAddress($email, $sendto);
        $message = "Hi " .$user . ",\n\n"
                . "Someone recently requested a password change for your account at ".$this->configs->getConfig('SITE_NAME').". \n\n"
                . "If this was requested by you, you can reset your password by clicking the button below which expires in 2 hours. \n\n"
                . $this->configs->getConfig('WEB_ROOT')."pwreset.php?key=". $templink ."  \n\n"
                . "Thanks \n\n"
                . $this->configs->getConfig('SITE_NAME')." \n\n";
        return $mail->send($userinfo,$subject,$message);
    }

}
