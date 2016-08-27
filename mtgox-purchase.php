//this is mostly someone elses work
//Original was here: http://bitklein.com/bot.php

function mtgox_query($path, array $req = array()) { 
   $key='yourkey';      //<----KEY! 
   $secret='yoursecret';   //<-SECRET! 
    
                   $mt = explode(' ', microtime()); 
                   $req['nonce'] = $mt[1].substr($mt[0], 2, 6); 
                   $post_data = http_build_query($req, '', '&'); 
                   $headers = array( 
                          'Rest-Key: '.$key, 
                          'Rest-Sign: '.base64_encode(hash_hmac('sha512', $post_data, base64_decode($secret), true)), 
                  ); 
                  static $ch = null; 
                  if (is_null($ch)) { 
                          $ch = curl_init(); 
                          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                         curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MtGox PHP client; '.php_uname('s').'; PHP/'.phpversion().')'); 
                  } 
                  curl_setopt($ch, CURLOPT_URL, 'https://mtgox.com/api/'.$path); 
                  curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); 
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
                  $res = curl_exec($ch); 
                  if ($res === false) throw new Exception('Could not get reply: '.curl_error($ch)); 
                  $dec = json_decode($res, true); 
                  if (!$dec) throw new Exception('Invalid data received, please ma 
  ke sure connection is working and requested API exists'); 
          return $dec; 
          } 
  $decoded=mtgox_query('0/getOrders.php?since=0'); 
  var_dump($decoded); 
  //print_r($decoded); 
 $seconds_wait = 40; 
  $truth =  TRUE; 
  while($truth){ 
          sleep($seconds_wait); 
          echo "----------------------------------------\n"; 
          $r=mtgox_query('0/getFunds.php'); 
          echo "USD TOTAL: ".$r['usds']."\n"; 
          echo "BTC TOTAL: ".$r['btcs']."\n\n"; 
          $decoded=mtgox_query('0/data/ticker.php'); 
  //      echo date('l jS \of F Y h:i:s A')."\n"; 
          echo "LAST:".$cur_last=$decoded['ticker']['last']."\n"; 
          echo "BUY:".$cur_buy=$decoded['ticker']['buy']."\n"; 
          echo "SELL:".$cur_sell=$decoded['ticker']['sell']."\n"; 
          echo "HIGH:".$cur_high=$decoded['ticker']['high']."\n"; 
          echo "AVERAGE:".$cur_avg=$decoded['ticker']['avg']."\n"; 
          echo "VWAP:".$cur_vwap=$decoded['ticker']['vwap']."\n\n"; 
   
  if(($r['usds'] > 60) && ($cur_buy < 15) ){ 
                  $amount= ($r['usds'] / $cur_buy); 
                  $amount = number_format($amount, 2, '.', ''); 
                  $price=$cur_buy; 
                  echo " PRICE: $price AMOUNT: $amount"; 
                  echo "Buying Bit coins to cancel transaction hit Ctrl C\n"; 
                  sleep(30); 
                  $req=array('amount'=>$amount,'price'=>$price); 
                  $decoded=mtgox_query('0/buyBTC.php',$req); 
                  echo "STATUS: ".$decoded['status']."\n"; 
  }                                
          if($cur_sell > 24 ){ 
                  echo "Selling Bitcoins\n"; 
                  $price = $cur_sell; 
                  $amount = $r['btcs']; 
                  $req=array('amount'=>$amount,'price'=>$price); 
                  $decoded=mtgox_query('0/sellBTC.php',$req); 
                  echo "STATUS: ".$decoded['status']."\n"; 
                  $truth = FALSE; 
          } 
  } 
