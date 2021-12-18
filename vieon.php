<?php







$type = $_GET["type"];











switch ($type) {







case "tivi":







$id = $_GET['kenh'];







$url = 'https://api.vieon.vn/backend/cm/v5/slug/livetv/detail';







$ch = curl_init();







curl_setopt($ch, CURLOPT_URL, $url);







curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);







curl_setopt($ch, CURLOPT_POST, 1);







curl_setopt($ch, CURLOPT_POSTFIELDS, "livetv_slug=/truyen-hinh-truc-tuyen/$id/");







$response = curl_exec($ch);







curl_close($ch);







preg_match('/hls_link_play":"(.*?)"/', $response, $match);







$link = $match[1];







header("Location: " .$link, 302);







break; 



case "dvr":







$id = $_GET['kenh'];



$timestamp = $_GET['time'];





$url = 'https://api.vieon.vn/backend/cm/v5/slug/livetv/detail';







$ch = curl_init();







curl_setopt($ch, CURLOPT_URL, $url);







curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);







curl_setopt($ch, CURLOPT_POST, 1);







curl_setopt($ch, CURLOPT_POSTFIELDS, "livetv_slug=/truyen-hinh-truc-tuyen/$id/");







$response = curl_exec($ch);







curl_close($ch);







preg_match('/hls_link_play":"(.*?)"/', $response, $match);







$link = $match[1];

$edit = str_replace("playlist.m3u8", "playlist_dvr_range-$timestamp-3600.m3u8", "$link");







header("Location: " .$edit, 302);







break; 





case "events":







$id = $_GET['id'];







$url = "https://api.vieon.vn/backend/cm/v5/events/$id"; 







$ch = curl_init();







curl_setopt($ch, CURLOPT_URL, $url);







curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);











$response = curl_exec($ch);







curl_close($ch);







preg_match('/hls_link_play":"(.*?)"/', $response, $match);







$link = $match[1];







header("Location: " .$link, 302);







break; 







default: 







$link = "https://yamcode.com/raw/dfgg-46558";







header("Location: " .$link, 302);







}







date_default_timezone_set('Asia/Ho_Chi_Minh');







$dataToLog = array(







date("d-m-Y H:i:s"), 







$_SERVER['REMOTE_ADDR'],







$type,







$id,







$_SERVER['HTTP_USER_AGENT']







); 







$data = implode(" | ", $dataToLog);







$data .= PHP_EOL;







$pathToFile = 'log/log_'.date("j.n.Y").'.log';







file_put_contents($pathToFile, $data, FILE_APPEND);







?>