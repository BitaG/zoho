<?php
namespace App\Classes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log;

class TelegramBot
{
    static private $token = '893963969:AAGDO5k516P9by5fdZt4fN8FU28LG3Cq29U';
    static private $channel = '@SPILog';
    static function send($message)
    {
        $baseUrl ='https://api.telegram.org/bot'.TelegramBot::$token.'/sendMessage?chat_id='.TelegramBot::$channel.'&text='.$message;
        $client  = new Client( ['base_uri' => $baseUrl ] );
        try{
            $responce   = $client->request('GET');
            $statusCode = $responce->getStatusCode();

            if($statusCode != 200){
                Log::error('TelegramBot: Can`t send message');
            }
        }
        catch (RequestException $e){
            Log::error('TelegramBot: '.$e);
        }
    }

}