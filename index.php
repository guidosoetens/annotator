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
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>" type="text/css" charset="utf-8" />
    <script type="module" src="main.js?v=<?php echo filemtime('main.js'); ?>"></script>
</head>

<body id="divBody" style="width: 100vw; height: 100vh; overflow: hidden; padding:0; background: black; margin: 0 !important; padding: 0 !important; background-size: contain; background-size: contain; background-repeat: no-repeat;">
    <div id="divGlobal" style="visibility: collapse; width: 1920px; height:1080px; overflow: hidden; background-image: url('./resources/background.png'); background-position: top center; background-size: cover;">
        <div id="divAnnotationsContainer" style="width:100%; height:100%; visibility:collapse; position:absolute">
            <div id="divBackground" style="width:100%; height:90%; background-image:url(./resources/profile-icon-square.png);
                background-position:center; background-repeat:no-repeat; background-size:contain"></div>
            <div id="divAnnotations"></div>
            <div style="position:absolute; display:block; margin-top: 100; width:100%">
                <button id="btnPrev" class="page_button" style="display:inline-block;">
                    PREVIOUS
                </button>
                <div style="display:inline-block; font-family: 'Retroica'; font-size:20px; color:white; text-align:center">
                </div>
                <button id="btnNext" class="page_button" style="display:inline-block; float:right">
                    NEXT
                </button>
            </div>
        </div>

        <div id="divLoginOverlay" style="width:100%;  position:absolute">
            <div style="display:block; position:absolute; font-family:Retroica; font-size:30px; text-align:center; width:300px; color:white; text-shadow: 0px 0px 8px #000000; margin-top:60px; margin-left:1400px">
                Participants (0):
            </div>
            <div style="font-family:Retroica; font-size:60px; text-align:center; width:100%; color:white; text-shadow: 0px 0px 8px #000000; margin-top:60px">
                Scan the QR code</br>to join session:
            </div>
            <div style="border-radius:30px; background:white; padding:30px; margin:auto; display:table; float:center;
                    box-shadow: 0px 0px 8px rgba(0,0,0,.5); margin-left:auto; margin-right:auto; margin-top:50px">
                <div id="divLoginCode"></div>
            </div>
            <button id="btnStart" class="page_button" style="display:block; margin-left:auto; margin-right:auto; margin-top:60px">
                START
            </button>
        </div>
    </div>
</body>

</html>
