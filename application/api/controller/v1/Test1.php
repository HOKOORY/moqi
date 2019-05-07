<?php
/**
 * Created by PhpStorm.
 * User: hokoory
 * Date: 2018/12/7
 * Time: 18:03
 */

namespace app\api\controller\v1;

use app\api\Model\Room as RoomModel;

class Test1 {
    public function test1($roomname = '91007') {
        $first = substr($roomname, 0, 1);
        $second = substr($roomname, 1, 1);
        if ($second == '0') {
            $third = substr($roomname, 2, 3);
            $room = $first . '#' . $third;

        } else {
            $third = substr($roomname, 1, 4);
            $room = $first . '#' . $third;

        }

        $roomid = RoomModel::where('roomName', '=', $room)->find();
        if (!$roomid) {
            return json([
                'msg' => '无效房间'
            ]);
        }
        $roomid = $roomid['roomid'];

        $cookie_jar = ROOT_PATH . '/Cookie';
        if (!file_exists($cookie_jar)) {
            mkdir($cookie_jar, 0777, true);
        }
        $cookie_jar = $cookie_jar . '/1.txt';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://10.168.188.15:8000/webSelect/selectLogin.jsp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_COOKIEJAR => $cookie_jar,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://10.168.188.15:8000/image.jsp",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_COOKIEFILE => $cookie_jar
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $filename = ROOT_PATH . '/Cookie';
        $name = '/1.jpg';
        if (!file_exists($filename)) {
            mkdir($filename, 0777, true);
        }
        $file = fopen($filename . $name, "w");//打开文件准备写入
        fwrite($file, $response);//写入
        fclose($file);//关闭
        $url = 'https://aip.baidubce.com/oauth/2.0/token';
        $post_data['grant_type'] = 'client_credentials';
        $post_data['client_id'] = 'ZC0TfGoYI4w4Z6SoFHzbun35';
        $post_data['client_secret'] = 'o7yRiMnWfHN2lrcpfVHz2jRt1BHNwvWQ';
        $o = "";
        foreach ($post_data as $k => $v) {
            $o .= "$k=" . urlencode($v) . "&";
        }
        $post_data = substr($o, 0, -1);

        $res = self::request_post($url, $post_data);
        $res = (array)json_decode($res, 1);
        $access_token = $res['access_token'];

        $url = 'https://aip.baidubce.com/rest/2.0/ocr/v1/general_basic?access_token=' . $access_token;
        $post['image'] = base64_encode(file_get_contents($filename . $name));
        $o = "";
        foreach ($post as $k => $v) {
            $o .= "$k=" . urlencode($v) . "&";
        }
        $post = substr($o, 0, -1);
        $res = self::request_post($url, $post);
        $res = (array)json_decode($res, 1);
        $yanzhenma = $res['words_result'][0]['words'];


        $cookie_jar1 = ROOT_PATH . '/Cookie';
        if (!file_exists($cookie_jar1)) {
            mkdir($cookie_jar1, 0777, true);
        }
        $cookie_jar1 = $cookie_jar1 . '/2.txt';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://10.168.188.15:8000/webSelect/roomFillLogView.do?method=webSelectLogin&buildingId=413&roomName=204&adminRand=$yanzhenma",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_COOKIEFILE => $cookie_jar,
            CURLOPT_COOKIEJAR => $cookie_jar1,
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $curl = curl_init();
        $time = time();
        $edate = date("Y-m-d", $time);
        $sdate = date("Y-m-d", $time - 691200);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://10.168.188.15:8000/webSelect/usedQuantityDelEleView.do?method=findUsedQuantityDelEleView",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"roomId\"\r\n\r\n$roomid\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"beginTime\"\r\n\r\n$sdate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"endTime\"\r\n\r\n$edate\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "Referer: http://10.168.188.15:8000/webSelect/usedQuantityDelEleView.do?method=findUsedQuantityDelEleView",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
            ),
            CURLOPT_COOKIEJAR => $cookie_jar
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $left = "this.className='highlight";
        $right = "</tr>";
        preg_match_all("|$left(.*)$right|isU", $response, $myArr);
        foreach ($myArr[1] as $arr) {
            $left = "<td>";
            $right = "</td>";
            preg_match_all("|$left(.*)$right|isU", $arr, $myArr1);
            $dianfei[] = $myArr1[1][2];
            $zong[] = $myArr1[1][1];
            $riqi[] = $myArr1[1][3];
        }//0.647
        $arr = array();
        for ($i = 0; $i < count($dianfei) - 1; $i++) {
            $dian = $dianfei[$i] - $dianfei[$i + 1];
            $arr[$i]['electricity'] = round($dian, 2);
            $arr[$i]['create_time'] = substr($riqi[$i + 1], 5, 5);
        }
        return json([
            'dushu' => $dianfei[count($dianfei) - 1],
            'money' => $dianfei[count($dianfei) - 1] * 0.647,
            'shengyu' => $dianfei[count($dianfei) - 1] / (($zong[count($zong) - 1] - $zong[1]) / 7),
            'recordin7' => $arr
        ]);
    }


    function request_post($url = '', $param = '') {
        if (empty($url) || empty($param)) {
            return false;
        }
        $postUrl = $url;
        $curlPost = $param;
        $curl = curl_init();//初始化curl
        curl_setopt($curl, CURLOPT_URL, $postUrl);//抓取指定网页
        curl_setopt($curl, CURLOPT_HEADER, 'Content-Type:application/x-www-form-urlencoded');//设置header
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($curl, CURLOPT_POST, 1);//post提交方式
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($curl);//运行curl
        curl_close($curl);

        return $data;
    }
}