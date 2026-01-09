<!DOCTYPE html>

<html lang="en">

<head>
    <title>Annotator&#8482;</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <link rel="stylesheet" href="../style.css?v=<?php echo filemtime('../style.css'); ?>" type="text/css" charset="utf-8" />
    <script type="module" src="main.js?v=<?php echo filemtime('main.js'); ?>"></script>
</head>

<body id="divBody" style="width: 100vw; height: 100vh; overflow: hidden; padding:0; background: black; margin: 0 !important; padding: 0 !important; background-size: contain; background-size: contain; background-repeat: no-repeat;">
    <div id="divGlobal" style="visibility: collapse; width: 1080px; height:1920px; overflow: hidden; background-image: url('../resources/background.png'); background-position: top center; background-size: cover; font-size:60px">
        <div style="margin:40px">
            <div style="font-family:'Retroica'; color:white; text-shadow: 0px 0px 8px #000000; text-align:center;">
                Christmas Photo
            </div>
            <textarea placeholder="Share your thoughts..." style="font-family:'Retroica'; color:white; font-size:60px; margin:auto; margin-top:50px; height:1200px; width:920px; background:rgba(0,0,0,.5); border-radius:30px; border-width:5px; border-color:white; padding:40px"></textarea>
            <button id="btnStart" class="page_button" style="display:block; margin-left:auto; margin-right:auto; margin-top:60px">
                SHARE
            </button>
        </div>
    </div>
</body>

</html>
