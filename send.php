 <?php
extract($_REQUEST);
 $post = [
        'user' => "league",
        'password' => '123456',
        'msisdn' => $msisdn,
        'sid'   => 'KHELLO',
        'msg'   => $msg,
        'fl'   => 0,
        'gwid'   => 2,
    ];
           
           $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://13.126.6.18/vendorsms/pushsms.aspx');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
            $response  = curl_exec($ch);
            
            print_r($response);
             //echo 'http://13.126.6.18/vendorsms/pushsms.aspx?user=league&password=123456&msisdn='.$msisdn.'&sid=KHELLO&msg='. $msg .'&fl=0&gwid=2';
            ?>