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
        <div id="divAnnotationsContainer">
            <div id="divBackground"></div>
            <div id="divAnnotations"><div>
        </div>

        <div id="divLoginOverlay" style="height:1080px">
            Login with the following QR code to join session:
            <div style="border-radius:30px; background:white; padding:30px; position:absolute; margin-left:50%; margin-top:250px; display:block; transform:translateX(-50%)">
                <div id="divLoginCode">
                
                </div>
            </div>
        </div>
    </div>
</body>

</html>
