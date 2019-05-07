<?php
/**
 * Created by PhpStorm.
 * User: hokoory
 * Date: 2018/7/19
 * Time: 18:22
 */

namespace app\api\controller\v1;


use GuzzleHttp\Client;
use Redis;
use think\Exception;

class Test {
    function array_iconv($data, $output = 'utf-8') {
        $encode_arr = array('UTF-8', 'ASCII', 'GBK', 'GB2312', 'BIG5', 'JIS', 'eucjp-win', 'sjis-win', 'EUC-JP');
        $encoded = mb_detect_encoding($data, $encode_arr);
        return mb_convert_encoding($data, $output, $encoded);
    }

    public function test($build = '德园8舍', $roomcode = '528') {

        $round = mt_rand(1, 5);
        sleep($round);
        return $round;

        if ($build == "德园1舍") {
            $buildid = 1;
        } elseif ($build == "德园2舍") {
            $buildid = 2;
        } elseif ($build == "德园3舍") {
            $buildid = 3;
        } elseif ($build == "德园4舍") {
            $buildid = 4;
        } elseif ($build == "德园5舍") {
            $buildid = 5;
        } elseif ($build == "德园6舍") {
            $buildid = 6;
        } elseif ($build == "德园7舍") {
            $buildid = 7;
        } elseif ($build == "德园8舍") {
            $buildid = 8;
        } elseif ($build == "德园9舍") {
            $buildid = 9;
        } elseif ($build == "德园10舍") {
            $buildid = 1;
        } elseif ($build == "德园11舍") {
            $buildid = 11;
        } elseif ($build == "德园12舍") {
            $buildid = 12;
        } elseif ($build == "德园13舍") {
            $buildid = 13;
        } elseif ($build == "德园14舍") {
            $buildid = 14;
        } elseif ($build == "德园15舍") {
            $buildid = 15;
        } elseif ($build == "菁园1栋") {
            $buildid = 16;
        } elseif ($build == "菁园2栋") {
            $buildid = 17;
        } elseif ($build == "菁园3栋") {
            $buildid = 18;
        } elseif ($build == "菁园4栋") {
            $buildid = 19;
        } elseif ($build == "菁园5栋1单元") {
            $buildid = 20;
        } elseif ($build == "菁园5栋2单元") {
            $buildid = 21;
        } elseif ($build == "菁园6栋1单元") {
            $buildid = 22;
        } elseif ($build == "菁园6栋2单元") {
            $buildid = 23;
        } elseif ($build == "菁园6栋3单元") {
            $buildid = 24;
        } elseif ($build == "菁园7栋1单元") {
            $buildid = 25;
        } elseif ($build == "菁园7栋2单元") {
            $buildid = 26;
        } elseif ($build == "菁园7栋3单元") {
            $buildid = 27;
        } elseif ($build == "雅园A栋") {
            $buildid = 28;
        } elseif ($build == "雅园B栋") {
            $buildid = 29;
        } elseif ($build == "雅园C栋") {
            $buildid = 30;
        } elseif ($build == "雅园D栋") {
            $buildid = 31;
        } elseif ($build == "雅园E栋") {
            $buildid = 32;
        } elseif ($build == "慧园A栋") {
            $buildid = 33;
        } elseif ($build == "慧园B栋") {
            $buildid = 34;
        } elseif ($build == "南岸聘用员工1栋") {
            $buildid = 35;
        } elseif ($build == "南岸聘用员工2栋") {
            $buildid = 36;
        } elseif ($build == "南岸聘用员工3栋") {
            $buildid = 37;
        } elseif ($build == "南岸门面1栋") {
            $buildid = 38;
        } elseif ($build == "南岸门面2栋") {
            $buildid = 39;
        } elseif ($build == "南岸门面3栋") {
            $buildid = 40;
        } elseif ($build == "活动中心") {
            $buildid = 41;
        } elseif ($build == "外语及计算机教学楼") {
            $buildid = 42;
        } elseif ($build == "第一教学楼") {
            $buildid = 43;
        } elseif ($build == "学生南食堂") {
            $buildid = 44;
        } elseif ($build == "游泳池") {
            $buildid = 45;
        } elseif ($build == "南岸门面4栋") {
            $buildid = 46;
        } elseif ($build == "菁园9栋") {
            $buildid = 47;
        }


        $cookie_jar = ROOT_PATH . '/Cookie';
        if (!file_exists($cookie_jar)) {
            mkdir($cookie_jar, 0777, true);
        }
        $cookie_jar = $cookie_jar . '/1.txt';
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
            CURLOPT_COOKIEJAR => $cookie_jar,
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
            $left = 'type="hidden" value="';
            $right = '">';
            preg_match_all("|$left(.*)$right|isU", $response, $myArr);
            if (isset($myArr[1][0])) {
                $token = $myArr[1][0];
            } else {
                return json([
                    'code' => -1,
                    'msg' => $response
                ]);
            }
            $cookie_jar2 = ROOT_PATH . '/Cookie';
            if (!file_exists($cookie_jar2)) {
                mkdir($cookie_jar2, 0777, true);
            }
            $cookie_jar2 = $cookie_jar2 . '/2.txt';
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://weixin.cqjtu.edu.cn/wechat/utility",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "_token=$token&buildid=$buildid&roomcode=$roomcode",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/x-www-form-urlencoded",
                    "Referer: https://weixin.cqjtu.edu.cn/wechat/utility?tdsourcetag=s_pctim_aiomsg",
                ),
                CURLOPT_COOKIEFILE => $cookie_jar,
                CURLOPT_COOKIEJAR => $cookie_jar2
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
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://weixin.cqjtu.edu.cn/wechat/utility/basicmessage",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 10,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => "",
                    CURLOPT_HTTPHEADER => array(),
                    CURLOPT_COOKIEFILE => $cookie_jar2
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
                    $left = '<div class=\"weui_cell_ft\">';
                    $right = '</div>';
                    preg_match_all("|$left(.*)$right|isU", $response, $myArr);
                    if (!isset($myArr[1][6])) {
                        return json([
                            'code' => -1,
                            'msg' => $response
                        ]);
                    }
                    $money = substr($myArr[1][6], 0, strlen($myArr[1][6]) - 9);
                    $money = self::array_iconv($money);
                    $buzu = substr($myArr[1][4], 0, strlen($myArr[1][4]) - 9);
                    $buzu = self::array_iconv($buzu);
                    $dushu = round((float)$money / 0.54, 2) + (float)$buzu;
                    $time = str_replace("-", "/", $myArr[1][7]) . ' 00:00:00';
                    return json([
                        'code' => 0,
                        'dushu' => $dushu,
                        'money' => $money,
                        'time' => $time
                    ]);

                }
            }
        }


        ignore_user_abort(true);
        set_time_limit(0);
        $a = "87.228.71.67:44551
213.59.155.184:41258
145.249.105.25:8118
145.255.28.218:53281
81.163.57.121:41258
92.126.223.3:8080
93.80.50.75:8080
91.233.44.215:53281
46.39.31.169:8080
94.180.247.1:8080";
        $a = str_replace(PHP_EOL, '+', $a);
        $ips = explode('+', $a);
        $ok = array();
        foreach ($ips as $ip) {
            $start = self::getMillisecond();
            $b = self::ping($ip);
            $end = self::getMillisecond();
            if ($b) {
                $time = $end - $start;
                $ok[] = $ip . "   ping:$time";
            }
        }
        return json([
            'IP' => $ok
        ]);


        //return self::my_dir(ROOT_PATH . "public/QRcode");

        //$a = array();
        //$a['你是什么人'] = array('男人', '女人', '都不是');
//        $a['b'] = 'b1';
//        $a['c'] = 'c1';
        //$b = json_encode($json, JSON_UNESCAPED_UNICODE);
//        var_dump($b);
        //return $_SERVER['REQUEST_TIME_FLOAT'];
    }

    function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

    function ping($ip) {
        $ip_port = explode(':', $ip);
//        var_dump($ip_port);
        if (filter_var($ip_port[0], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {        //IPv6
            $socket = socket_create(AF_INET6, SOCK_STREAM, SOL_TCP);
        } elseif (filter_var($ip_port[0], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {    //IPv4
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        } else {
            return FALSE;
        }

        if (!isset($ip_port[1])) {        //没有写端口则指定为80
            $ip_port[1] = '80';
        }
        try {
            socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 2, "usec" => 0));
            socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => 4, "usec" => 0));
            $ok = socket_connect($socket, $ip_port[0], $ip_port[1]);
        } catch (\Exception $e) {
            return false;
        }

//        var_dump( socket_strerror( socket_last_error($socket) ) );
        socket_close($socket);
//        var_dump($ok);
        return $ok;
    }

    function my_dir($dir) {
        $files = array();
        if (@$handle = opendir($dir)) { //注意这里要加一个@，不然会有warning错误提示：）
            while (($file = readdir($handle)) !== false) {
                if ($file != ".." && $file != ".") { //排除根目录；
                    if (is_dir($dir . "/" . $file)) { //如果是子文件夹，就进行递归
                        $files[$file] = self::my_dir($dir . "/" . $file);
                    } else { //不然就将文件的名字存入数组；
                        $time = filectime($dir . "/$file");
                        if ($time < time()) {//删除文件的代码
                            unlink($dir . "/$file");
                        }
                        $files[] = '删除' . $file . "      $time";
                    }
                }
            }
            closedir($handle);
            return $files;
        }
    }
}