<?php
namespace App\Classes;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use App\Classes\TelegramBot;

class InsaleClient
{
    //app config
    private $app_name   = null;
    private $app_secret = null;

    private $client;

    public function __construct($shopUrl=null, $shopPassword=null)
    {
        $this->app_name     = env("INSALES_APP_NAME");
        $this->app_secret   = env("INSALES_APP_SECRET");

        if(!empty ($shopUrl) && !empty($shopPassword)){
            $baseUrl = 'http://'.$this->app_name.':'.$shopPassword.'@'.$shopUrl;
            $this->client  = new Client( ['base_uri' => $baseUrl ] );
        }

    }

    public function generatePass( $token )
    {
        return md5($token.$this->app_secret);
    }

    public function getAppSecret()
    {
        return $this->app_secret;
    }

    public function getAppName()
    {
        return $this->app_name;
    }

    public function getClients(){
        $per_page   = 500;
        $countResponseClients = 500; // count response clients
        $page = 1;
        $clients=[];
        while($per_page==$countResponseClients){
            try{
                $responce   = $this->client->request('GET', '/admin/clients.json?per_page='.$per_page.'&page='.$page);
                $statusCode = $responce->getStatusCode();

                if($statusCode != 200){
                    return false;
                }
                $body  = $responce->getBody()->getContents();
                $client = json_decode($body,true);
                $clients = array_merge($clients,$client); //marge clients in single array
                $countResponseClients =  count(json_decode($body,true));
                $page++;

            } catch (RequestException $e) {
                Log::error('InsaleClient: Can`t give client');
                TelegramBot::send('Insales: Can`t give client | '.$e->getMessage());
                break;
            }

            if(empty($clients)){
                return false;
            }
        }

        return $clients;

    }

    public function installWebHook($hostUrl)
    {
        $url  =  $hostUrl.'/webhook';

        try{
            $responce = $this->client->request('POST', '/admin/webhooks.json', [
                'json'=>
                    [
                        'address'=>$url,
                        'topic'=>'orders/create',
                        'format-type'=>'json'
                    ]
            ]);
            $statusCode = $responce->getStatusCode();
            if ($statusCode != 201){
                return false;
            }

            $body = $responce->getBody()->getContents();
            $data = json_decode($body,true);//get assoc array`s
            return $data['id']; //webHook id
            Log::info('WebHook: install done');
        }
        catch (RequestException $e){
            Log::error('WebHook: Can`t install');
            TelegramBot::send('Insales: Can`t install WebHook | '.$e->getMessage());
            return false;
        }

    }

    public function deleteWebHookById($id)
    {
        try{
            $responce   = $this->client->request('DELETE', '/admin/webhooks/'.$id.'.json');
            $statusCode = $responce->getStatusCode();

            if ($statusCode != 201){
                return false;
            }
            return true;
        }
        catch(RequestException $e){
            Log::error('WebHook: Can`t uninstall');
            TelegramBot::send('Insales: Can`t uninstall WebHook | '.$e->getMessage());
            return false;
        }
        return false;
    }

    public function getWebHookId($hostUrl){
        $url  =  $hostUrl.'/webhook';
        try{
            $responce   = $this->client->request('GET', '/admin/webhooks.json');
            $body       = $responce->getBody()->getContents();

            $arrays= json_decode($body,true);//get assoc array`s
            foreach ($arrays as $array){
                if (array_search($url, $array))
                    return $array["id"];
            }
        }
        catch(RequestException $e){
            Log::error('WebHook: Can`t get id');
            TelegramBot::send('Insales: Can`t get WebHook id | '.$e->getMessage());
            return false;
        }
        return false;
    }

    public static function getSiteId($shopUrl, $websites){
        foreach ($websites as $website)
        {
            if ( $website->url == $shopUrl )
            {
                return  $website->id;
            }
        }
        return false;
    }

    public function addHeadJs($head_js_url, $protocol = "http:")
    {
        $url = $protocol . $head_js_url;

        try {
            $responce = $this->client->request('POST', '/admin/js_tags.json',
                ['json' =>
                    [
                        'type' => "JsTag::FileTag",
                        'content' => $url,
                        'name' => "sp_push"
                    ]
                ]);

            if ($responce->getStatusCode() === 201) {
                $body = json_decode($responce->getBody()->getContents());
                return $body->id;
            }
            return false;
        } catch (RequestException $e) {
            Log::error('Push: Can`t add head js');
            TelegramBot::send('Insales: Can`t add head push js | ' . $e->getMessage());
            return false;
        }
        return false;
    }


    public function uploadFile( $fileName )
    {
        $filePath = url('/').'/resources/'.$fileName;
        try{
            $responce   = $this->client->request('POST', '/admin/files.json',['json'=> ['src'=>$filePath]]);

            if($responce->getStatusCode() === 201)
            {
                $body = json_decode($responce->getBody()->getContents());
                return $body->id;
            }
            return false;
        }
        catch(RequestException $e){
            Log::error('Push: Can`t upload file '.$fileName);
            TelegramBot::send('Insales: Can`t upload '.$fileName.' file from PUSH init | '.$e->getMessage());
            return false;
        }

        return false;
    }

    public function deleteFileById( $fileId )
    {
        try{
            $responce   = $this->client->request('DELETE', '/admin/files/'.$fileId.'.json');
            if($responce->getStatusCode() == 200)
            {
                return true;
            }
            return false;
        }
        catch (RequestException $e) {
            Log::error('Push: Can`t delete file by id '.$fileId);
            TelegramBot::send('Insales: Can`t delete push file by id |'.$fileId.'|' . $e->getMessage());
            return false;
        }

    }

    public function getFiles(){
        try{
            $responce   = $this->client->request('GET', '/admin/files.json');
            $body       = $responce->getBody()->getContents();

            return($body);

        }
        catch (RequestException $e) {
            Log::error('Insale: Can`t give files '.$e);
            return false;
        }
    }

    public function getHEadJsFiles(){
        try{
            $responce   = $this->client->request('GET', '/admin/js_tags.json');
            $body       = $responce->getBody()->getContents();

            return($body);

        }
        catch (RequestException $e) {
            Log::error('Insale: Can`t give head files '.$e);
            return false;
        }
    }
    public function deleteHeadJsById($id){
        try{
            $responce   = $this->client->request('DELETE', '/admin/js_tags/'.$id.'.json');
            $body       = $responce->getBody()->getContents();

            return($body);

        }
        catch (RequestException $e) {
            Log::error('Insale: Can`t give files '.$e);
            return false;
        }
    }
}