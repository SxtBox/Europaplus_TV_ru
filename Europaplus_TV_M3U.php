<?php
error_reporting(0);
// https://europaplustv.com/embed/video?online=1

$stream_url = file_get_contents("https://europaplustv.com/playlist");

preg_match('/setStream.*?."(\/.*?)"/',$stream_url, $stream_matches);
$stream = trim($stream_matches[1]);
$stream = str_replace('//','https://',$stream);
$stream = str_replace('&zoid=web','&hls_proxy_host=dtmf-01&zoid=web',$stream);

preg_match('/title>(.*?)</',$stream_url, $title_matches);
$title = trim($title_matches[1]);
$title = str_replace('Playlist - ','',$title);

//echo $stream;

if (is_null($stream_matches[1]))
{
echo 'Stream is NULL';
}
else
{
header('Content-Type: text/plain');
echo "#EXTM3U #PHP Streaming Tools"."\n";
echo "#EXTVLCOPT--http-reconnect=true"."\n";
echo "#EXTVLCOPT:http-user-agent=Vari Karin"."\n";
echo "#EXTVLCOPT:http-referrer=https://europaplustv.com/online"."\n";
echo "#EXTINF:-1,$title"."\n";
//echo "https://ad-hls-europaplus.cdnvideo.ru/europaplus/smil:eurptv2.smil/playlist.m3u8?md5=q2-YePymxiVs3SB6q9euiw&e=1621001274&zoid=web"."\n";
echo "$stream"."\n";
}
?>