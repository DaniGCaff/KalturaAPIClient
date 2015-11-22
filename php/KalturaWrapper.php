<?php
require_once 'KalturaClient.php';

final class KalturaWrapper {
	static private $adminSecret = 'b6aa5230c53abe7a5c4303edc31e638c';
	static private $partnerId = 2035151; //ID del usuario, en este caso, el id de rober.
	static private $userId = 'rober_a94@hotmail.com';
	static private $privileges = 'ALL';
	static private $expiry = 9999999;
	static private $kalturaURL = "http://www.kaltura.com";
	
	private $kalturaClient;
	private $uiConf;
	
	public static function Instance() {
		static $inst = null;
		if($inst === null) {
			$inst = new KalturaWrapper();
		}
		return $inst;
	}
	
	private function __construct()
	{	
		try {
			$kalturaConfig = new KalturaConfiguration(self::$partnerId);
			$kalturaConfig->serviceUrl = self::$kalturaURL;
			$this->kalturaClient = new KalturaClient($kalturaConfig);
			$ks = $this->kalturaClient->generateSession(self::$adminSecret, self::$userId, KalturaSessionType::ADMIN, self::$partnerId, self::$expiry, self::$privileges);
			$this->kalturaClient->setKs($ks);
		} catch (Exception $ex) {
			echo "ERROR: No se puede inicializar KALTURA . Razón: " . $ex->getMessage();
		}
	}
	
	public function printVideo($entryId)
	{
        echo "<iframe class=\"embed-responsive-item\" src=\"" . self::$kalturaURL . "/p/" . self::$partnerId . "/sp/" . self::$partnerId . "00/embedIframeJs/uiconf_id/" . $this->uiConf . "/partner_id/" . self::$partnerId . "?iframeembed=true&playerId=" . $this->uiConf . "&entry_id=" . $entryId . "\" width=\"400\" height=\"330\" allowfullscreen webkitallowfullscreen mozAllowFullScreen frameborder=\"0\"></iframe>";
	}

	public function printThumb($entryId)
	{
		echo self::$kalturaURL."/p/". self::$partnerId ."/thumbnail/entry_id/". $entryId;
	}

	public function getList($category)
	{
		try {
			$filter = new KalturaMediaEntryFilter();
			$filter->categoriesMatchAnd = $category;
			$result = array();
			$listado = $this->kalturaClient->media->listAction($filter, null);
            $cont = 0;
			foreach($listado->objects as $obj) {
                $result[$cont]["entryId"] = $obj->id;
                $result[$cont]["duration"] = $obj->duration;
                $result[$cont]["name"] = $obj->name;
                $cont = $cont + 1;
			}
			return json_encode($result);
		} catch (Exception $ex) {
			echo "could not get list from Kaltura . Reason: " . $ex->getMessage();
		}
	}
	
	public function getCategoryList($category)
	{
		try {
			$filter = new KalturaCategoryFilter();
			$filter->fullNameStartsWithIn = $category;
			$result = array();
			$listado = $this->kalturaClient->category->listAction($filter, null);
			foreach($listado->objects as $obj) {
				$result[] = $obj->name;
			}
			$result[0] = "Todas las categorías";
			return json_encode($result);
		} catch (Exception $ex) {
			echo "could not get list from Kaltura . Reason: " . $ex->getMessage();
		}
	}

	public function setUIConf($uiconf) {
		$this->uiConf = $uiconf;
	}

}
?>
