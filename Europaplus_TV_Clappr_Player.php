<?php

/*
JUST FOR FUNNY DUDE
BAB DUDA ME KALLASHNIKOV ESHTE KETU
*/

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
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>
<link rel="shortcut icon" href="https://kodi.al/panel.ico"/>
<link rel="icon" href="https://kodi.al/panel.ico"/>
<script type="text/javascript" src="clappr.min.js"></script>
<script type="text/javascript" src="rtmp.js"></script>
</head>
<body style="background:#000;">
<div id="player"></div>
      <script>
        var player = new Clappr.Player({
            source: '<?php echo $stream; ?>',
			width: '100%',
	        height: '100%',
			poster: 'https://png.kodi.al/tv/albdroid/black.png',
	        watermark: 'https://png.kodi.al/tv/albdroid/logo.png',
	        position: 'top-right',
	        //watermarkLink: '',
            parentId: "#player",
            autoPlay: true,
            rtmpConfig: {
                swfPath: 'RTMP.swf',
                scaling:'stretch',
                playbackType: 'vod',
                bufferTime: 1,
                startLevel: 0
            },
            plugins: {
                playback: [RTMP],
            },
        });
      </script>
</body>
</html>
<?php
}
?>
