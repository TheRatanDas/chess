<!DOCTYPE html>
<html>
<head>
<title>MASTER CHESS</title>
<link rel="stylesheet" href="page/chess/css/reset.css" type="text/css">
<link rel="stylesheet" href="page/chess/css/main.css" type="text/css">
<link rel="stylesheet" href="page/chess/css/ios_fullscreen.css" type="text/css">
<link rel="stylesheet" href="page/chess/css/orientation_utils.css" type="text/css">
<link rel='shortcut icon' type='image/x-icon' href='./favicon.ico' />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
<meta name="msapplication-tap-highlight" content="no" />
<script type="text/javascript" src="page/chess/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="page/chess/js/createjs.min.js"></script>
<script type="text/javascript" src="page/chess/js/howler.min.js"></script>
<script type="text/javascript" src="page/chess/js/screenfull.js"></script>
<script type="text/javascript" src="page/chess/js/platform.js"></script>
<script type="text/javascript" src="page/chess/js/ios_fullscreen.js"></script>
<script type="text/javascript" src="page/chess/js/CAreYouSurePanel.js"></script>
<script type="text/javascript" src="page/chess/js/TreeModel.js"></script>
<script type="text/javascript" src="page/chess/js/CTreeDecision.js"></script>
<script type="text/javascript" src="page/chess/js/ctl_utils.js"></script>
<script type="text/javascript" src="page/chess/js/sprite_lib.js"></script>
<script type="text/javascript" src="page/chess/js/settings.js"></script>
<script type="text/javascript" src="page/chess/js/CLang.js"></script>
<script type="text/javascript" src="page/chess/js/CPreloader.js"></script>
<script type="text/javascript" src="page/chess/js/CCreditsPanel.js"></script>
<script type="text/javascript" src="page/chess/js/CMain.js"></script>
<script type="text/javascript" src="page/chess/js/CTextButton.js"></script>
<script type="text/javascript" src="page/chess/js/CToggle.js"></script>
<script type="text/javascript" src="page/chess/js/CGfxButton.js"></script>
<script type="text/javascript" src="page/chess/js/CMessage.js"></script>
<script type="text/javascript" src="page/chess/js/CMenu.js"></script>
<script type="text/javascript" src="page/chess/js/CModeMenu.js"></script>
<script type="text/javascript" src="page/chess/js/CGame.js"></script>
<script type="text/javascript" src="page/chess/js/CInterface.js"></script>
<script type="text/javascript" src="page/chess/js/CInfoTurn.js"></script>
<script type="text/javascript" src="page/chess/js/CThinking.js"></script>
<script type="text/javascript" src="page/chess/js/CEndPanel.js"></script>
<script type="text/javascript" src="page/chess/js/CCell.js"></script>
<script type="text/javascript" src="page/chess/js/CPiece.js"></script>
<script type="text/javascript" src="page/chess/js/CMovesController.js"></script>
<script type="text/javascript" src="page/chess/js/CBoardStateController.js"></script>
<script type="text/javascript" src="page/chess/js/CCopiedCell.js"></script>
<script type="text/javascript" src="page/chess/js/CPromoPanel.js"></script>
<script type="text/javascript" src="page/chess/js/CAI.js"></script>
<script type="text/javascript" src="page/chess/js/CMovesControllerFaster.js"></script>
<script type="text/javascript" src="page/chess/js/CGUIExpandible.js"></script>
<script type="text/javascript" src="page/chess/js/CCTLText.js"></script>
<script type="text/javascript" src="page/chess/js/sprintf.js"></script>
</head>
<body ondragstart="return false;" ondrop="return false;">
<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
<script>
            $(document).ready(function(){
                     var oMain = new CMain({
                         
                                            show_score: true,                   //SET IF YOU WANT PLAY WITH A SCORE
                                            start_score: 5000,                  //START SCORE. MORE TIME YOU USE TO FINISH A MATCH, LESS SCORE YOU GET
                                            score_decrease_per_second: 10,      //SCORE DECREASED PER SECOND
                            
                                            check_orientation: false,            //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT ON MOBILE DEVICES
                                            fullscreen: false,                   //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                                            audio_enable_on_startup:true,      //ENABLE/DISABLE AUDIO WHEN GAME STARTS 
                                           });
                                           
                                           
                     $(oMain).on("start_session", function(evt) {
                            if(getParamValue('ctl-arcade') === "true"){
                                parent.__ctlArcadeStartSession();
                            }
                            //...ADD YOUR CODE HERE EVENTUALLY
                    });
                     
                    $(oMain).on("end_session", function(evt) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeEndSession();
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });
                    
                    $(oMain).on("save_score", function(evt,iWinner, iBlackTime, iWhiteTime, s_iGameType, iWhiteScore) {
							// iWinner: 
							// -1 IS DRAW
							//0 WHITE WINS
							//1 BLACK WINS
							
                            if(getParamValue('ctl-arcade') === "true" && s_iGameType === 1 && iWinner === 0){
                               parent.__ctlArcadeSaveScore({score:iWhiteScore, szMode: s_iGameType+""});
                           }
                     });
                     
                     $(oMain).on("share_event", function(evt, iScore, s_iGameType, iWinner) {
                           if(getParamValue('ctl-arcade') === "true" && s_iGameType === 1 && iWinner === 0){
                               parent.__ctlArcadeShareEvent({   img: TEXT_SHARE_IMAGE,
                                                                title: TEXT_SHARE_TITLE,
                                                                msg: TEXT_SHARE_MSG1 + iScore + TEXT_SHARE_MSG2,
                                                                msg_share: TEXT_SHARE_SHARE1 + iScore + TEXT_SHARE_SHARE1});
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });


                    $(oMain).on("show_interlevel_ad", function(evt) {
                           if(getParamValue('ctl-arcade') === "true"){
                               parent.__ctlArcadeShowInterlevelAD();
                           }
                           //...ADD YOUR CODE HERE EVENTUALLY
                    });
                     
                     if(isIOS()){ 
                        setTimeout(function(){sizeHandler();},200); 
                    }else{
                        sizeHandler(); 
                    }
           });

        </script>
<div class="check-fonts">
<p class="check-font-1">arialrounded</p>
</div>
<canvas id="canvas" class='ani_hack' width="1280" height="1920"> </canvas>
<div data-orientation="portrait" class="orientation-msg-container">
<p class="orientation-msg-text">Please rotate your device</p>
</div>
<div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>
</body>
</html>
