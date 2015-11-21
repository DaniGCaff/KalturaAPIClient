<?php


//require_once 'KalturaClientBase.php';
require_once 'KalturaClient.php';
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

//    $entryId = '1_ujbhpyy2';
// a known ID of media entry that you have
function printVideo($entryId)
{
    echo "<div class=\"row\">
        <div class=\"col-lg-8 col-lg-offset-2\">
            <div class=\"embed-responsive embed-responsive-16by9\">
                <iframe class=\"embed-responsive-item\" src=\"http://cdnapi.kaltura.com/p/2035151/sp/203515100/embedIframeJs/uiconf_id/32245281/partner_id/2035151?iframeembed=true&playerId=kaltura_player_1447429484&entry_id=" . $entryId . "&flashvars[streamerType]=auto\"
                        width=\"560\" height=\"315\" allowfullscreen webkitallowfullscreen mozAllowFullScreen
                        frameborder=\"0\"></iframe>
            </div>
        </div>
    </div>";
}

function printThumb($entryId)
{
    echo "<div class=\"row\">
  <div class=\"col-lg-4 col-lg-offset-4\">
      <img class=\"img-thumbnail\" src=\"http://www.kaltura.com/p/". $GLOBALS['partnerId'] ."/thumbnail/entry_id/". $entryId ."\" alt=\"miniatura\">
  </div>
</div>";
}

function getList()
{
    try {
        return $GLOBALS['kalturaClient']->media->listAction();
        //echo $mediaEntry->name;
    } catch (Exception $ex) {
        echo "could not get entry from Kaltura . Reason: " . $ex->getMessage();
    }
}

function getThumb($entryId)
{
    $thumbParamId = null;
    try {
        return $GLOBALS['kalturaClient']->thumbAsset->servebyentryid($entryId, $thumbParamId);
    } catch (Exception $ex) {
        echo "could not get entry from Kaltura . Reason: " . $ex->getMessage();
    }
}


$listaTocha = getList();
foreach ($listaTocha as $clave => $valor) {
    foreach ($valor as $miniclave => $minivalor) {
        $entryId = ($minivalor->id);
        printVideo($entryId);
        printThumb($entryId);
    }
}


?>
