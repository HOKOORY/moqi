<?php
/**
 * Created by PhpStorm.
 * User: hokoory
 * Date: 2018/12/13
 * Time: 15:40
 */

namespace app\api\controller\v1;

use GuzzleHttp\Client;
use GuzzleHttp\Pool;

class Test2 {
    public function test2() {
        set_time_limit(0);
        ob_end_clean();
        $client = new Client();

        $requests = function ($total) use ($client) {
            $uri = 'http://127.0.0.1/htdocs/moqi/public/index.php/api/v1/test';
            for ($i = 0; $i <= $total; $i++) {
                yield function () use ($client, $uri, $i) {
                    return $client->postAsync($uri, [
                        'form_params' => [
                            'i' => $i
                        ]
                    ]);
                };
            }
        };

        $pool = new Pool($client, $requests(100), [
            'concurrency' => 20,
            'fulfilled' => function ($response, $index) {
                $res = json_decode($response->getBody()->getContents());
                //echo $index.'<br/>';
                echo '第' . $index . '个，为' . $res . '<br/>';
                flush();
            },
            'rejected' => function ($reason, $index) {
                //echo $index.'<br/>';
                echo $reason . '<br/><br/><br/><br/>';
                flush();
            },
        ]);
// Initiate the transfers and create a promise
        $promise = $pool->promise();
// Force the pool of requests to complete.
        $promise->wait();
    }


    function array_iconv($data, $output = 'utf-8') {
        $encode_arr = array('UTF-8', 'ASCII', 'GBK', 'GB2312', 'BIG5', 'JIS', 'eucjp-win', 'sjis-win', 'EUC-JP');
        $encoded = mb_detect_encoding($data, $encode_arr);
        return mb_convert_encoding($data, $output, $encoded);
    }


    public function GetBuild() {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://weixin.cqjtu.edu.cn/wechat/utility",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json([
                'code' => -1,
                'msg' => $err
            ]);
        } else {
            $left = '<option value=';
            $right = '</option>';
            preg_match_all("|$left(.*)$right|isU", $response, $myArr);
            $array = array();
            foreach ($myArr[0] as $a) {
                $first = strip_tags($a);
                $second = str_replace([" ", "\r\n"], "", $first);
                $array[] = $second;
            }
            unset($array[0]);
            return $array;
        }
    }
}