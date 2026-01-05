<!DOCTYPE html>

<html lang="en">

<head>
    <title>All I Want for Christmas...&#8482;</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <link rel="stylesheet" href="style.css?v=<?php echo filemtime('style.css'); ?>" type="text/css" charset="utf-8" />
    <script type="module" src="main.js?v=<?php echo filemtime('main.js'); ?>"></script>
</head>

<body id="divBody" style="width: 100vw; height: 100vh; overflow: hidden; padding:0; background: black; margin: 0 !important; padding: 0 !important; background-size: contain; background-size: contain; background-repeat: no-repeat;">
    <div id="divGlobal" style="visibility: collapse; width: 640px; height:1080px; overflow: hidden; background-image: url('../resources/bg.jpg'); background-position: top center;">
        
        <div id="divPages">
            <div id="divMainPage" class="page" style="visibility: inherit; width: 100%;">
                <div style="position:absolute; top:350px; width:100%; text-align:center; transform: translateY(-50%)">
                    <div style="font-size: 60px;text-align: center; color: yellow; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.4);">
                        All I want for Christmas is...
                    </div>
                    <div id="divQuestion" style="font-size: 90px;text-align: center; color: yellow; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.4); margin-top: 30px; margin-left: 50px; margin-right: 50px;">
                        a healthy snack!
                    </div>
                </div>
                <div id="divMariah" style="background: url('../resources/mariah.png'); width: 500px; height: 500px; background-size: cover; position: absolute; display: block; top:500px; left:50px; transform-origin: 260px 560px;">

                </div>
            </div>

            <div id="divContentPage" class="page" style="visibility: collapse; width: 100%;">
                <div id="divAskForContent" style="position: absolute; top:0;">
                    <div style="color: yellow; font-size: 80px; margin-top: 300px; text-align: center; margin-left: 60px; margin-right: 60px; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.4);">
                        Press the button below to make your snapshot of the week
                    </div>
                    <div id="btnStartMakeSnapshot" class="page_button" style="width: 200px; margin-top: 100px; margin-left: 200px;"> &#xf030 </div>
                </div>
                <div id="divShowContent" style="position: absolute; top:0; visibility: collapse;">
                    <div id="divUserPicture"></div>
                    <div id="btnDeleteSnapshot" class="page_button" style="width: 150px; margin-top: 750px; margin-left: 235px;"> &#xf1f8</div>
                </div>
            </div>

            <div id="divWallPage" class="page" style="visibility: collapse; width: 100%;">
                <div id="divEmptyWall" style="position: absolute; top:0;">
                    <div style="color: yellow; font-size: 80px; margin-top: 250px; text-align: center; margin-left: 30px; margin-right: 30px; text-shadow: 5px 5px 10px rgba(0, 0, 0, 0.4);">
                        There are no pictures uploaded yet this week...</br></br>Check again soon!
                    </div>
                </div>
                <div id="divWall" style="position: absolute; top:0; visibility: collapse; width: 100%;">
                    <div id="divPlrdWall">                  
                    </div>
                    <div id="divStar" style="background-image: url('../resources/star.png'); width: 200px; height: 200px; background-size: cover; position: absolute; top: 325px; left: 225px; transform-origin: center; transform: rotate(10deg);">
                    </div>
                    <div style="font-size:20px; margin-top:850px; color:white; position:absolute; width:100%; text-align:center; font-family:'FontAwesomeRegular';">
                        <div id="divNavBar" style="padding:5px 10px 5px 10px; text-align:center; background:rgba(0,0,0,.6); margin:auto; display:inline-block; border-radius:20px; max-width:600px">
                        <div class='nav_elem'>&#xf111</div>
                        <div class='nav_elem'>&#xe131</div>
                        </div>
                    </div>   
                    <div  style="margin-top: 750px; margin-left: 50px;">
                        <div id="btnLeft" class="page_button"> &#xf060</div>
                        <div id="btnStar" class="page_button" style="margin-left: 50px; font-family: 'FontAwesomeRegular'; width: 200px"> &#xf005 </div>
                        <div id="btnRight" class="page_button" style="margin-left: 50px;"> &#xf061</div>
                    </div>
                </div>
            </div>

            <div id="divButtons" style="position: absolute; width: 100%; height: 12%; top: 88%; background: white;">
                <div id="divBanner" style="width: 120%; height: 140%; transform: rotate(-2deg); transform-origin: top left; margin-left: -10px; box-shadow: 0px -5px 10px rgba(0,0,0,.3); background-image: url('../resources/banner.jpg');">
                    <div style="background-color: yellow; height: 10px; width: 100%;"></div>
                </div>
                <div id="divPageButtons"  style="position: absolute; top:0; margin-left: 50px; margin-top: 20px;">
                    <div id="btnHome" class="page_button" style="border-width: 6px; margin-left: 50px;"> &#xf7db </div>
                    <div id="btnUpload" class="page_button" style="margin-left: 50px;"> &#xf8c4 </div>
                    <div id="btnStars" class="page_button" style="margin-left: 50px;"> &#xe561</div>
                    <!--  &#xf030 &#xf8c4 -->
                </div>
            </div>
        </div>

        <div id="divSnapshot" class="overlay" style="visibility: collapse;">
            <div style="border:5px solid white; position: absolute; padding: 5px; background: black;
                border-radius: 20px; margin-left: 55px; margin-top:120px; display: block; width: 500px; height:500px;overflow: hidden;">
                <video id="divSnapshotVideo" style="width:300px; height:300px;display: block;overflow: hidden;"></video>    
            </div>
            <div style="margin-top: 850px; margin-left:0px; position:absolute; margin-left: 55px;">
                <div id="divSwapCameraButton" class="page_button" style="width:500px; margin-bottom: 20px; margin-left: 0px;">
                    &#xe0d8
                </div>
                </br>
                <div id="divButtonsSnapCancel" class="page_button" style="width: 225px; margin-left: 0px;">
                    &#xf00d
                </div>
                <div id="divButtonsSnap" class="page_button" style="width: 225px; margin-left: 20px;">
                    &#xf030
                </div>
            </div>
        </div>

        <div id="divSnapshotAwesome" class="overlay" style="position: absolute; visibility: collapse;">
            <div id="divSnapshotPreview1"></div>
            <div style="position: absolute; margin-top: 750px; color:white; margin-left: 20px;
                font-size: 75px; width: 600px; text-align: center;">
                That looks awesome!
            </div>
            <div id="divFlashOverlay" style="background:white; width:100%; height:100%; position:absolute; top:0; opacity:.3"></div>
        </div>

        <div id="divSnapshotApprove" class="overlay" style="position: absolute; visibility: collapse;">
            <div id="divSnapshotPreview2"></div>
            <div style="position: absolute; margin-top: 600px; color:white; margin-left: 20px;
                font-size: 80px; width: 600px; text-align: center;">
                <div style="font-size: 55px; margin-top:50px">
                    Would you like to share this picture with your colleagues?
                </div>
            </div>

            <div style="margin-top: 850px; margin-left:0px; position:absolute; margin-left: 55px;">
                <div id="divSignCapture" class="page_button" style="width:500px; margin-bottom: 20px; margin-left: 0px;">
                    &#xf044
                </div>
                </br>
                <div id="divButtonRetrySnapshot" class="page_button" style="width: 225px; margin-left: 0px;">
                    &#xf0e2
                </div>
                <div id="divButtonSendSnapshot" class="page_button" style="width: 225px; margin-left: 20px;">
                    &#xf1d9
                </div>
            </div>
        </div>

        <div id="divNameTagPaper" style="width:300px; height:300px; position:absolute; left:380px; top:-50px; transform-origin:60px 75px">
            <div style="background-image:url('../resources/tag.png'); width:100%; height:100%; background-size:contain;"> 
            </div>
            <div id="divNameTag" style="font-size:40px; position:absolute; width:100%; text-align:center; left:10px; top:120px; transform-origin:center; transform:rotate(20deg)"> 
                X
            </div>
        </div>
    </div>
</body>

</html>
