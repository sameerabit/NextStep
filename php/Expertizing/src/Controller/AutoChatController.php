<?php

namespace App\Controller;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AutoChatController extends AbstractController
{
    #[Route('/auto/chat', name: 'app_auto_chat')]
    public function index(): Response
    {
        $this->chat();
        return $this->render('auto_chat/index.html.twig', [
            'controller_name' => 'AutoChatController',
        ]);
    }


    private function chat($message = "Hi! Lets have a discussion about sri lankan cricket?", $i = 0, $gender = 'boy')
    {
        if ($i <= 5) {
            $ch = curl_init("https://api.openai.com/v1/chat/completions");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $_ENV['OPEN_AI']
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            if ($i == 0) {
                echo 'ChatGPT boy:  <h3>' . $message . '</h3>';
            } else {
                $message = substr(strstr($message, "."), 1);
            }
            $message = 'Think about this like a ' . $gender . ' and give an answer: ' . $message . ". Use only 50 words for your answer.";
            $json = '{
                "model": "gpt-3.5-turbo",
                "messages": [{"role": "user", "content": "' . $message . '"}],
                "temperature": 0.7
            }';
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            try {
                $result = curl_exec($ch);
                curl_close($ch);
                $response = (json_decode($result, true));
                $rmessage = $response['choices'][0]['message']['content'];
                echo 'ChatGPT ' . $gender . ':  <h4>' . $rmessage . '</h4>';
            } catch (Exception $ex) {
                dd($response);
            }
            if ($i % 2 == 0) {
                $gender = 'girl friend';
            } else {
                $gender = 'boy friend';
            }
            sleep(15);
            $this->chat(str_replace("\n", "", $rmessage), $i + 1, $gender);
        }
        dd();
    }
}
