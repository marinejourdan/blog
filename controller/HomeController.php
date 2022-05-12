<?php
namespace App\Controller;

use App\Manager\PostManager;
use App\Controller\BaseController;

class HomeController extends BaseController{

    private $postManager;

    public function __construct(PostManager $postManager){
       $this->postManager=$postManager;
    }

    public function displayHome(){
        $postManager=$this->postManager;
        $lastPosts=$postManager->lastPosts();

        $this->render(
            "./view/public/displayhome.html.php",
            [
                'lastPosts' => $lastPosts,
            ]
        );

    }


    public function doSendEmail(){

        if (!isset($_POST['name'])){
            die("$ post name absent");
        }
        $name = $_POST['name'];
        if ($name === '') {
            die("merci de remplir le nom");
        }
        if (!isset($_POST['email'])){
            die("$ post email absent");
        }
        $email = $_POST['email'];
        if ($email === '') {
            die("merci de remplir le mail");
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            echo "Email format invalid.";
            die();
        }
        if (!isset($_POST['message'])){
            die("$ post CONTENT absent");
        }
        $content = $_POST['message'];
        if ($content === '') {
            die("merci de remplir le message");
        }
        if (!isset($_POST['subject'])){
            die("$ post subject absent");
        }
        $subject = $_POST['subject'];
        if ($subject === '') {
            die("merci de remplir le sujet");
        }


        try {
            // Create the SMTP Transport
            $transport = New \Swift_SmtpTransport();
            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);
            // Create a message
            $message = new \Swift_Message();
            // Set a "subject"
            $message->setSubject($subject);
            // Set the "From address"
            $message->setFrom([$email => $name]);
            // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
            $message->addTo('marine.misser@gmail.com','Marine Jourdan');
            // Set the plain-text "Body"
            $message->setBody($content);
            // Send the message
            $result = $mailer->send($message);
        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
