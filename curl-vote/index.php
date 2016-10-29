<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use \HtmlParser\ParserDom;

class Vote 
{   
    const VOTE_URL = 'http://www.etimechina.com/index.php?a=tou&m=Show&id=215&aid=7';
    const PROXY_PAGE_URL = 'http://www.site-digger.com/html/articles/20110516/proxieslist.html';

    private $client;
    private $parser;
    private $aes_key;
    
    public function __construct()
    {
        $this->parser = new ParserDom();
        $this->client = new Client(['timeout' => 10.0]);
    }

    public function vote($proxy)
    {
        $result = $this->client->request('GET', self::VOTE_URL, [
            'proxy' => [
                'http'  =>  $proxy
            ]
        ]);

        if ($result->getBody() == '1') {
            return true;
        } else {
            return false;
        }
    }

    public function getProxy()
    {   
        $result = $this->client->get(self::PROXY_PAGE_URL);

        if ($result->getStatusCode() == 200) {

            $dom = new ParserDom($result->getBody());

            $aes_key = $dom->find('script', 2)->getPlainText();
            preg_match('/baidu_union_id = "(.*?)"/', $aes_key, $matches);
            
            $this->aes_key = $matches[1];
            
            $i = 0;

            foreach ($dom->find('#proxies_table->tr') as $tr){
                if ($i == 0) {
                    $i++;
                    continue;
                } else {
                    $string = $tr->find('td', 0)->getPlainText();
                    
                    preg_match('/[\"](.*?)[\"]/', $string, $matches);
                    $string= base64_decode($matches[1]);
                    
                    $proxy = $this->decrypt_string($string);

                    $proxy_array[] = $proxy;
                }
            }

            return $proxy_array;
        } else {
            throw new \Exception("抓取代理失败", 1); 
        }
    }

    private function decrypt_string($encrypted_str)
    {
        $decrypted_str = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->aes_key, $encrypted_str, MCRYPT_MODE_CBC, $this->aes_key);

        if (!$decrypted_str) {
            throw new \Exception("解码代理失败", 1);        
        }

        return trim($decrypted_str);
    }
}


// 获取代理
try {
    $Vote = new Vote();
    $proxy_array = $Vote->getProxy();

    echo '获取代理成功' . PHP_EOL;

} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

// 投票
$count = count($proxy_array) - 1;

for ($i = 1; $i < $count; $i++) { 
    try {
        while (true) {
            $proxy = $proxy_array[$i];
            echo '正在使用' . $proxy . PHP_EOL;

            $status =  $Vote->vote($proxy);

            if ($status) {
                $success++;
                echo 'success' . PHP_EOL;
            } else {
                //投票失败，切换代理
                echo '投票失败，切换代理' . PHP_EOL;
                break;
            }
        } 
    } catch (Exception $e) {
        echo '连接代理服务器失败' . PHP_EOL;
        $error++;
    }
}

echo 'success:' . $success . PHP_EOL . 'error:' .$error . PHP_EOL;
