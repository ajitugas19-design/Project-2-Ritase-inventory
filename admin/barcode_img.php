<?php
header("Content-Type: image/png");

$text = isset($_GET['text']) ? $_GET['text'] : '12345';
$text = strtoupper($text);
$text = "*".$text."*";

$codes = [
'0'=>"nnnwwnwnn",'1'=>"wnnwnnnnw",'2'=>"nnwwnnnnw",'3'=>"wnwwnnnnn",
'4'=>"nnnwwnnnw",'5'=>"wnnwwnnnn",'6'=>"nnwwwnnnn",'7'=>"nnnwnnwnw",
'8'=>"wnnwnnwnn",'9'=>"nnwwnnwnn",'A'=>"wnnnnwnnw",'B'=>"nnwnnwnnw",
'C'=>"wnwnnwnnn",'D'=>"nnnnwwnnw",'E'=>"wnnnwwnnn",'F'=>"nnwnwwnnn",
'G'=>"nnnnnwwnw",'H'=>"wnnnnwwnn",'I'=>"nnwnnwwnn",'J'=>"nnnnwwwnn",
'K'=>"wnnnnnnww",'L'=>"nnwnnnnww",'M'=>"wnwnnnnwn",'N'=>"nnnnwnnww",
'O'=>"wnnnwnnwn",'P'=>"nnwnwnnwn",'Q'=>"nnnnnnwww",'R'=>"wnnnnnwwn",
'S'=>"nnwnnnwwn",'T'=>"nnnnwnwwn",'U'=>"wwnnnnnnw",'V'=>"nwwnnnnnw",
'W'=>"wwwnnnnnn",'X'=>"nwnnwnnnw",'Y'=>"wwnnwnnnn",'Z'=>"nwwnwnnnn",
'-'=>"nwnnnnwnw",'.'=>"wwnnnnwnn",' '=>"nwwnnnwnn",'$'=>"nwnwnwnnn",
'/'=>"nwnwnnnwn",'+'=>"nwnnnwnwn",'%'=>"nnnwnwnwn",
'*'=>"nwnnwnwnn"
];

$quiet = 60;      // margin kiri kanan BESAR
$barTall = 85;   // tinggi bar

$w = strlen($text) * 20 + ($quiet*2);
$h = 130;

$img = imagecreate($w,$h);
$white = imagecolorallocate($img,255,255,255);
$black = imagecolorallocate($img,0,0,0);

$x = $quiet;

foreach(str_split($text) as $ch){
    $seq = $codes[$ch];
    for($j=0;$j<9;$j++){
        $draw = ($j % 2 == 0);
        $width = ($seq[$j]=='w') ? 6 : 4;   // BAR LEBIH TEBAL
        if($draw){
            imagefilledrectangle($img,$x,20,$x+$width,$barTall,$black);
        }
        $x += $width;
    }
    $x += 6;
}

imagestring($img,5,($w/2)-(strlen($text)*4),95,str_replace('*','',$text),$black);

imagepng($img);
imagedestroy($img);
