require_once ‘KalturaClient.php’;
 
$kalturaConfig = new KalturaConfiguration(123);
// where 123 is your partner ID
 
$kalturaConfig->serviceUrl = ‘http://KalturaServerDomain’;
// if you want to communicate with a Kaltura server which is 
//    other than the default http://www.kaltura.com
 
$kalturaClient = new KalturaClient($kalturaConfig);
 
$ks = $kalturaClient->generateSession($adminSecret, $userId, KalturaSessionType::ADMIN, $partnerId, $expiry,$privileges);
$kalturaClient->setKs($ks);
 
$entryId = ‘XXXYYYZZZA’;
// a known ID of media entry that you have
 
try
{
$mediaEntry = $client->media->get($entryId);
echo $mediaEntry->name;
}
catch(Exception $ex)
{
    echo “could not get entry from Kaltura. Reason: “ . $ex->getMessage();
}
