<?php

namespace App\Controller;

use App\Manager\PostManager;

class HomeController extends BaseController
{
    private $postManager;

    public function __construct(PostManager $postManager)
    {
        $this->postManager = $postManager;
    }

    public function displayHome()
    {
        $postManager = $this->postManager;
        $lastPosts = $postManager->lastPosts();

        $this->render(
            'displayhome.html.php',
            [
                'lastPosts' => $lastPosts,
            ]
        );
    }

    public function doSendEmail()
    {
        $errors = [];

        if (!isset($_POST['name'])) {
            $errors[] = 'mail.no_name';
        }
        $name = $_POST['name'];
        if ('' === $name) {
            $errors[] = 'mail.no_name';
        }
        if (!isset($_POST['email'])) {
            $errors[] = 'mail.no_mail';
        }
        $email = $_POST['email'];
        if ('' === $email) {
            $errors[] = 'mail.no_mail';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'mail.invalid_mail';
        }
        if (!isset($_POST['message'])) {
            $errors[] = 'mail.no_content';
        }
        $content = $_POST['message'];
        if ('' === $content) {
            $errors[] = 'mail.no_content';
        }
        if (!isset($_POST['subject'])) {
            $errors[] = 'mail.no_subject';
        }
        $subject = $_POST['subject'];
        if ('' === $subject) {
            $errors[] = 'mail.no_subject';
        }

        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $this->redirect('index.php?controller=home&action=displayHome');
        }
        try {
            //Create the SMTP Transport
            $transport = new \Swift_SmtpTransport($_ENV['SMTP'], $_ENV['PORT']);
            $transport->setUsername($_ENV['ID']);
            $transport->setPassword($_ENV['CLE']);

            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);
            // Create a message
            $message = new \Swift_Message();
            // Set a "subject"
            $message->setSubject($subject);
            // Set the "From address"
            $message->setFrom([$email => $name]);
            // Set the "To address" [Use setTo method for multiple recipients, argument should be array]
            $message->addTo($_ENV['ID'], 'Marine Jourdan');
            // Set the plain-text "Body"
            $message->setBody($content);
            // Send the message
            $result = $mailer->send($message);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
