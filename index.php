<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
    require_once 'php/KalturaClient.php';
    $partnerId = 2035151;
    $kalturaConfig = new KalturaConfiguration($partnerId);
    // where 123 is your partner ID

    $kalturaConfig->serviceUrl = 'http://www.kaltura.com';
    // if you want to communicate with a Kaltura server which is
    //    other than the default http://www.kaltura.com

    $kalturaClient = new KalturaClient($kalturaConfig);

    $adminSecret = 'b6aa5230c53abe7a5c4303edc31e638c';
    $userId = 'rober_a94@hotmail.com';
    $privileges = 'ALL';
    $expiry = 9999999;

    $ks = $kalturaClient->generateSession($adminSecret, $userId, KalturaSessionType::ADMIN, 2035151, $expiry, $privileges);
    $kalturaClient->setKs($ks);

    try {
        $listaVideos = $GLOBALS['kalturaClient']->media->listAction();
        //echo $mediaEntry->name;
    } catch (Exception $ex) {
        echo "could not get entry from Kaltura . Reason: " . $ex->getMessage();
    }
    print_r($listaVideos) ;
    ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-7">
            <div class=\"embed-responsive embed-responsive-16by9\
            ">
            <iframe class=\"embed-responsive-item\"
                    src=\"http://cdnapi.kaltura.com/p/2035151/sp/203515100/embedIframeJs/uiconf_id/32245281/partner_id/2035151?iframeembed=true&playerId=kaltura_player_1447429484&entry_id="
                    . $entryId .
            "&flashvars[streamerType]=auto\"
            width=\"560\" height=\"315\" allowfullscreen webkitallowfullscreen mozAllowFullScreen
            frameborder=\"0\"></iframe>
        </div>
        <div class="col-lg-4 col-lg-offset-1 col-md-4 col-md-offset-1">
            <ul class="media-list">
                <li class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="..." alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Media heading</h4>
                    </div>
                </li>
            </ul>

        </div>
    </div>
</div>
<?php include("php/php01.php"); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="php/KalturaClientBase.php"></script>
<script src="php/KalturaClient.php"></script>
<script src="php/php01.php"></script>
</body>
</html>
