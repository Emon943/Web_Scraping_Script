<?php 
//error_reporting(0);
	$path = 'https://www.airbnb.com/rooms/1019530';
	if(empty($path)){
	    echo "No data found or Missing url!";
	}
	
	$opts = array(
	  'http'=>array(
	    'user_agent' => 'My company name',
	    'method'=>"GET",
	    'header'=> implode("\r\n", array(
	    'Content-type: text/plain;'
	    ))
	  )
	);
	
	$context = stream_context_create($opts);
	
	function retVal($val){
		if($val == "<strong")
		{
			return 1;
		}else{
			return 0;
		}
	}
	
	$html = file_get_contents($path,false, $context);
	$html = file_get_contents($path,false, $context);
	echo $html;
	//echo $html;
	/* Get Title */
	function getTitle($html){
		$t = explode(';listingName&quot;:&quot;', $html);
		$t = explode('&quot;,&quot;photos',$t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	}
	//$title = getTitle($html);
	var_dump($title);
	/* Get Number of Guest */
	function getGuest($html){
		$t = explode('&quot;class&quot;:&quot;group', $html);
		$t = explode('Guests&quot;},{', $t[1]);
		$t = explode(';label&quot;:&quot;', $t[0]);
		if(isset($t[1])){
			return $t[1];
		}
		return '';
	}
	$guest = getGuest($html);
	//var_dump($guest);
	/* Get Price */
	function getPrice($html){
		$t = explode('__price-amount',$html);
		$t = explode('<span', $t[1]);
		$t = explode('">', $t[1]);
		$t = explode('</span>', $t[1]);
		$t = explode(';',$t[0]);
		return $t[1];
	}
	$price = getPrice($html);
	var_dump($price);
	/*-- Area/Location */
	function getArea($html){
		$t = explode('class="link-reset"', $html);
		$t = explode('>', $t[1]);
		$t = explode('</a', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$area = getArea($html);
	var_dump($area);
	/*-- Available for Nights/Days --*/
	function getAvailability($html){
		$t = explode('"><strong>', $html);
		$t = explode('</div>', $t[1]);
		$t = explode('</strong>', $t[0]);
		$fastVal=$t[0];
		$secVal=$t[1];
		$join=$fastVal.$secVal;
		return $join;
	}
	$availability = getAvailability($html);
	/*-- Super Host --*/
	function getSupHost($html){
		$t = explode('summary-component"', $html);
		$t = explode('___iso-state___p3summarybundlejs', $t[1]);
		$t = explode('shared.user_profile_image', $t[0]);
		$t = explode('img', $t[1]);
		$t = explode('class="', $t[1]);
		$t = explode('" alt="" data-reactid=', $t[1]);
		if(isset($t[0]) && $t[0] == "superhost-photo-badge superhost-photo-badge"){
			return 1;
		}
		return 0;
	}
	$suphost = getSupHost($html);
	/*-- Room Type --*/
	function getRoomType($html){
		$t = explode('Room type=2.2">', $html);
		$t = explode('</strong>', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$room_type = getRoomType($html);
	/*-- Booking --*/
	var_dump($room_type);
	function getBooking($html){
		$t = explode('&quot;can_instant_book&quot;:',$html);
		$t = explode(',&quot;cancellation_policy_label', $t[1]);
		if($t[0]){
			return 1;
		}
		else{
			return 0;
		}
	}
	$booking = getBooking($html);
	var_dump($booking);
	/*-- About Listing --*/
	function getAboutListing($html){
		$t = explode('<p data-reactid="', $html);
		$t = explode('">', $t[1]);
		$t = explode('</span>', $t[2]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$about_listing = getAboutListing($html);
	var_dump($about_listing);
	
	/*-- Capacity --*/
	function getCapacity($html){
		$t = explode('$Accommodates=2.2">', $html);
		$t = explode('</strong>', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$capacity = getCapacity($html);
	var_dump($capacity);
	/*-- Capacity / Accomodations --*/
	function getBathroom($html){
		$t = explode('$Bathrooms=2.2">', $html);
		$t = explode('</strong>', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$bathroom = getBathroom($html);
	var_dump($bathroom);
	/*-- Bedroom Number--*/
	function getBedroom($html){
		$t = explode('$Bedrooms=2.2">', $html);
		$t = explode('</strong>', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$bedroom = getBedroom($html);
	var_dump($bedroom);
	/*-- No. of Beds --*/
	function getBeds($html){
		$t = explode('$Beds=2.2">', $html);
		$t = explode('</strong>', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$beds = getBeds($html);
	var_dump($beds);
	/*-- Check In Time --*/
	function getCheckin($html){
		$t = explode('$Check In=2.2">', $html);
		$t = explode('</strong>', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$checkin = getCheckin($html);
	var_dump($checkin);
	
	/*-- Check Out Time --*/
	function getCheckout($html){
		$t = explode('$Check Out=2.2">', $html);
		$t = explode('</strong>', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$checkOut = getCheckout($html);
	var_dump($checkOut);
	/* Property Type of Building */
	function getProperty($html){
		$t = explode('$Property type', $html);
		$x = count($t);
		$t = explode('">', $t[$x-1]);
		$t = explode('</strong>',$t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$property = getProperty($html);
	var_dump($property);
	
	/*-- Reviews of Host --*/
	function getGestReviews($html){
		$t = explode('row space-2 space-top-8 row-table', $html);
		$t = explode('<span', $t[1]);
		$t = explode('">', $t[1]);
		$t = explode('Reviews', $t[1]);
		if(isset($t[0])){
			return $t[0];
		}
		return '';
	
	}
	$gest_review = getGestReviews($html);
	var_dump($gest_review);
	
	/*-- Amenities --*/
	function amenities($param,$html){
		$t = explode($param, $html);
		$t = explode(',&quot;is_safety_feature',$t[1]);
		$t = explode('is_present&quot;:',$t[0]);
		return $t[1];
	}
	
	$kitchen = amenities('icon-meal&',$html);
	$internet = amenities('icon-internet&', $html);
	$tv = amenities('icon-tv',$html);
	$essentials = amenities('icon-essentials', $html);
	$heating = amenities('icon-heating', $html);
	$ac = amenities('icon-air-conditioning', $html);
	$washer = amenities('icon-washer', $html);
	$dryer = amenities('icon-dryer', $html);
	$parking = amenities('icon-parking', $html);
	$winternet = amenities('icon-wifi',$html);
	$cableTV = amenities('icon-desktop',$html);
	$bfast = amenities('icon-cup',$html);
	$pets = amenities('icon-paw',$html);
	$family = amenities('icon-family',$html);
	$events = amenities('icon-balloons',$html);
	$smoking = amenities('icon-smoking',$html);
	$wheelchair = amenities('icon-accessible',$html);
	$elevator = amenities('icon-elevator',$html);
	$inPlace = amenities('icon-fireplace',$html);
	$wBuzzer = amenities('icon-intercom',$html);
	$doorman = amenities('icon-doorman',$html);
	$pool = amenities('icon-pool',$html);
	$hotTub = amenities('icon-hot-tub',$html);
	$gym = amenities('icon-gym',$html);
	$checkin24 = amenities('icon-time',$html);
	$hanger = amenities('icon-hanger',$html);
	$iron = amenities('icon-iron',$html);
	$hairDryer = amenities('icon-hair-dryer',$html);
	$workplace = amenities('icon-laptop',$html);
	
	/*-- Price --*/
	function getPrices($param,$html){
		$t = explode($param,$html);
		$t = explode('&quot;,&quot;value_url',$t[1]);
		$t = explode('value&quot;:&quot;',$t[0]);
		return $t[1];
	}
	$extra = getPrices('Extra people:&quot;',$html);
	$cleaning = getPrices('Cleaning Fee:&quot',$html);
	$weekly = getPrices('Weekly discount:&quot;',$html);
	$monthly = getPrices('Monthly discount:&quot;',$html);
	$cancel = getPrices('Cancellation:&quot;',$html);
	/*-- House Rules --*/
	function getRules($html){
		$t = explode('row react-house-rules',$html);
		$t = explode('react-expandable-trigger-more',$t[1]);
		$t = explode('House Rules',$t[0]);
		return $t[1];
	}
	$rules = strip_tags($rules = getRules($html));
	/*-- Description --*/
	function getSpaces($html){
		$t = explode('row description',$html);
		$t = explode('react-expandable-trigger-more',$t[1]);
		$t = explode('Description',$t[0]);
		return $t[1];
	}
	$desc = strip_tags($desc = getSpaces($html));
	/* -- Safety -- */	
	function getSafety($param,$html){
		$t = explode($param,$html);
		$t = explode(',&quot;is_safety_feature&',$t[1]);
		$t = explode('is_present&quot;:',$t[0]);
		return $t[1];
	}
	$detector = getSafety('id&quot;:35',$html);
	$carbon = getSafety('id&quot;:36',$html);
	$fkit = getSafety('id&quot;:37',$html);
	$sCard = getSafety('id&quot;:38',$html);
	$fextinguisher = getSafety('id&quot;:39',$html);
	$safetyEquip = $detector."-";
	
	/*-- Summary (Stars) --*/
	function getSummary($param,$html){
		$t = explode($param,$html);
		$t = explode('&quot;value&quot;:',$t[1]);
		$t = explode('},{',$t[1]);
		return $t[0];
	}
	$accuracy = getSummary('label&quot;:&quot;Accuracy',$html) / 2;
	$commi = getSummary('label&quot;:&quot;Communication',$html) / 2;
	$clean = getSummary('label&quot;:&quot;Cleanliness',$html) / 2;
	$location = getSummary('label&quot;:&quot;Location',$html) / 2;
	$checkinSum = getSummary('label&quot;:&quot;Check In',$html) / 2;
	$value = getSummary('label&quot;:&quot;Value',$html) / 2;
	/*-- get Review --*/
	function getReview($html){
		$t = explode('displayReviewSummary',$html);
		$t = explode(',&quot;superhost',$t[1]);
		$t = explode('visibleReviewCount&quot;:',$t[0]);
		return $t[1];
	}
	$review = getReview($html);
	var_dump($review);
	/*-- Profile Name --*/
	function getProfile($html){
		$t = explode('">About the Host, ',$html);
		$t = explode("</span>",$t[1]);
		return $t[0];	
	}
	$profName = getProfile($html);
	var_dump($profName);
	/*-- Host Location --*/
	function getProfLocation($html){
		$t = explode('&quot;scrubbed_location',$html);
		$t = explode(',&quot;user',$t[1]);
		$t = explode('&quot;:',$t[0]);
		return $t[1];
	}
	$profLocation = getProfLocation($html);
	var_dump($profLocation);
	/*-- Host Membership --*/
	function getProfMember($html){
		$t = explode('&quot;member_since',$html);
		$t = explode(';,&quot;scrubbed_location',$t[1]);
		$t = explode('&quot;:',$t[0]);
		return $t[1];
	}
	$member = getProfMember($html);
	var_dump($member);
	/*-- Star Rating Review --*/
	function getStar($html){
		$t = explode('<i class="icon-star icon icon-beach icon-star-big"', $html);
		$element=count($t);
		$star=($element-1);
		if(isset($t)){
			return $star;
		}
		return ' ';
	}
	$star = getStar($html);
	var_dump($star);
	/*-- Listing Location on Map --*/
	function getListingLocation($html){
		$t = explode('},&quot;map_url',$html);
		$t = explode(';,&quot;link&quot;',$t[1]);
		$t = explode('search_text&quot;:&quot;',$t[0]);
		return $t[1];
	}
	$LLocation = getListingLocation($html);
	var_dump($LLocation);
	
	
	function insertDB($html){
		
		$dbh2 = new PDO('mysql:host=localhost;dbname=db_bnb', 'root','');
		if(getSafety('id&quot;:35',$html) == "true"){
			$db_detector = "Detector";
		}else{
			$db_detector = "No Detector";
		}
		if(getSafety('id&quot;:36',$html) == "true"){
			$db_carbon = "Carbon";
		}else{
			$db_carbon = "No Carbon Safety";
		}
		if(getSafety('id&quot;:37',$html) == "true"){
			$db_fkit = "First Aid Kit";
		}else{
			$db_fkit = "No First Aid Kit";
		}
		if(getSafety('id&quot;:38',$html) == "true"){ 
			$db_sCard = "Card"; 
		}else{
			$db_sCard = "No Card";
		}
		if( getSafety('id&quot;:39',$html) == "true"){
			$db_ex = "Fire Extinguisher";
		}else{
			$db_ex = "No Fire Extinguisher";
		}
		$data1=array(date("Y-m-d"),
        date('H:m:s'),
        getTitle($html),
        getGuest($html),
        getPrice($html),
        'ServiceCharge',
        'Total',
        getAvailability($html),
        getSupHost($html),
        getBooking($html),
        'Username',
        'URL',
        'UserReview',
        getAboutListing($html),
        'ID Auth',
        getRoomType($html),
        getCapacity($html),
        getBeds($html),
        getAboutListing($html),
        getCapacity($html),
        getBathroom($html),
        getBedroom($html),
        getBeds($html),
        getCheckin($html),
        getCheckout($html),
        getProperty($html),
        getRoomType($html),
        amenities('icon-meal&',$html),
        amenities('icon-internet&', $html),
        amenities('icon-tv',$html),
        amenities('icon-essentials', $html),
        amenities('icon-heating', $html),
        amenities('icon-air-conditioning', $html),
        amenities('icon-washer', $html),
        amenities('icon-dryer', $html),
        amenities('icon-parking', $html),
        amenities('icon-wifi',$html),
        amenities('icon-desktop',$html),
        amenities('icon-cup',$html),
        amenities('icon-paw',$html),
        amenities('icon-family',$html),
        amenities('icon-balloons',$html),
        amenities('icon-smoking',$html),
        amenities('icon-accessible',$html),
        amenities('icon-elevator',$html),
        amenities('icon-fireplace',$html),
        amenities('icon-intercom',$html),
        amenities('icon-doorman',$html),
        amenities('icon-pool',$html),
        amenities('icon-hot-tub',$html),
        amenities('icon-gym',$html),
        amenities('icon-time',$html),
        amenities('icon-hanger',$html),
        amenities('icon-iron',$html),
        amenities('icon-hair-dryer',$html),
        amenities('icon-laptop',$html),
        amenities('icon-family',$html),
        getPrices('Extra people:&quot',$html),
        getPrices('Cleaning Fee:&quot',$html),
        getPrices('Weekly discount:&quot;,',$html),
        getPrices('Monthly discount:&quot;,',$html),
        getPrices('Cancellation:&quot;,',$html),
        strip_tags($desc = getSpaces($html)),
        strip_tags($rules = getRules($html)),
        $db_detector."-".$db_carbon."-".$db_fkit."-".$db_sCard."-".$db_ex,
		getAvailability($html),
		getReview($html),
		getStar($html),
		getSummary('&quot;label&quot;:&quot;Accuracy',$html) / 2,
		getSummary('label&quot;:&quot;Communication',$html) / 2,
		getSummary('label&quot;:&quot;Cleanliness',$html) / 2,
		getSummary('label&quot;:&quot;Location',$html) / 2,
		getSummary('label&quot;:&quot;Check In',$html) / 2,
		getProfile($html),
		getProfLocation($html),
		getProfMember($html),
		getArea($html),
		getArea($html),
		getListingLocation($html));
		for($x = 0; $x < count($data1) ; $x ++){
			echo $data1[$x];
		}
	}	
	insertDB($html);
	
/*


function getTitle($html){
	$t = explode('id="listing_name"', $html);
	$t = explode('">',$t[1]);
	$t = explode('</h1>',$t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$title = getTitle($html);




function getPrice($html){
	$t = explode('__price-amount',$html);
	$t = explode('<span', $t[1]);
	$t = explode('">', $t[1]);
	$t = explode('</span>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return 'false';

}
$price = getPrice($html);

function getArea($html){
	$t = explode('class="link-reset"', $html);
	$t = explode('>', $t[1]);
	$t = explode('</a', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$area = getArea($html);

function getArea_($html){
	$t = explode('space-2"', $html);
	$t = explode('">', $t[4]);
	$t = explode('</div>', $t[3]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$area_ = getArea_($html);

function getUserName($html){
	$t = explode('#host-profile', $html);
	$t = explode('">', $t[3]);
	$t = explode('</', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$user = getUserName($html);



function getRoomType($html){
	$t = explode('Room type=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$room_type = getRoomType($html);

function getAboutListing($html){
	$t = explode('<p data-reactid="', $html);
	$t = explode('">', $t[1]);
	$t = explode('</span>', $t[2]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$about_listing = getAboutListing($html);

function getBathrooms($html){
	$t = explode('$Bathrooms=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$bathrooms = getBathrooms($html);

function getBedrooms($html){
	$t = explode('$Bedrooms=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$bedrooms = getBedrooms($html);

function getBeds($html){
	$t = explode('$Beds=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$beds = getBeds($html);

function getPropartyType($html){
	$t = explode('$Property type=2.0.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$proparty_type = getPropartyType($html);


/*
function getGuest($html){
	$t = explode('$1">', $html);
	$t = explode('</div>', $t[3]);
	$t = explode('Guests', $t[0]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$guest = getGuest($html);
*/
/*
function getCheckIn($html){
	$t = explode('$Check In=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$check_in = getCheckIn($html);

function getCheckOut($html){
	$t = explode('$Check Out=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$check_out = getCheckOut($html);

function getAvailability($html){
	$t = explode('"><strong>', $html);
	$t = explode('</div>', $t[1]);
	$t = explode('</strong>', $t[0]);
	$fastVal=$t[0];
	$secVal=$t[1];
	$join=$fastVal.$secVal;
	return $join;
}
$availability = getAvailability($html);


function getWeeklydiscount($html){
	$t = explode('discount=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	$t = explode('%', $t[0]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';


}
$weekly_discount = getWeeklydiscount($html);

function getMonthlydiscount($html){
	$t = explode('$Monthly discount=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	$t = explode('%', $t[0]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$monthly_discount = getMonthlydiscount($html);

function getCleaningFee($html){
	$t = explode('$Cleaning Fee=2.2">', $html);
	$t = explode('</strong>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$cleaning = getCleaningFee($html);

function getKitchen($html){
	$t = explode('&quot;icon-meal&', $html);
	$t = explode(',&quot;is_safety_feature',$t[1]);
	$t = explode('is_present&quot;:',$t[0]);
	echo $t[1];
}
$kitchen = getKitchen($html);


function getShampoo($html){
	$t = explode('<div class="space-1"', $html);
	$t = explode('">', $t[3]);
	$t = explode('</span>', $t[5]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$shampoo = getShampoo($html);
/*
function getHeating($html){
	$t = explode('<div class="space-1"', $html);
	$t = explode('">', $t[4]);
	$t = explode('</strong>', $t[8]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$heating = getHeating($html);
*/

/*
function getHeating($html){
	$t = explode('<div class="space-1"', $html);
	$t = explode('">', $t[4]);
	$t = explode('</strong>', $t[8]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$heating = getHeating($html);

function getAirConditioning($html){
	$t = explode('icon-air-conditioning', $html);
	$t = explode(',&quot;is_safety_feature', $t[1]);
	$t = explode('</span>', $t[0]);
		if(isset($t[0])){
		return $t[0];	
	}
	return '';

}
$ac = getAirConditioning($html);
$ac = retVal($ac);
function getWasher($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[19]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$washer = getWasher($html);

function getDryer($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[22]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$dryer = getDryer($html);

function getInternet($html){
	$t = explode('&quot;icon-internet&', $html);
	$t = explode(',&quot;is_safety_feature',$t[1]);
	$t = explode('is_present&quot;:',$t[0]);
	echo $t[1];
	
}
 $internet = getInternet($html);

function getTV($html){
	$t = explode('&quot;icon-tv&', $html);
	$t = explode(',&quot;is_safety_feature',$t[1]);
	$t = explode('is_present&quot;:',$t[0]);
	echo $t[1];
}
$tv = getTV($html);

function getFreeParkingPremises($html){
	$t = explode('row amenities', $html);
	$t = explode('$9-long.0.1.0">', $t[1]);
	$t = explode('</span>', $t[0]);
		if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$parking_premises = getFreeParkingPremises($html);

function getWirelessInternet($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[26]);
		if(isset($t[2])){
	     return $t[2];	
	}
	return '';
}
$werless_internet = getWirelessInternet($html);

function getCableTV($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[31]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$cable_tv = getCableTV($html);

function getBreakfast($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[34]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$breakfast = getBreakfast($html);

function getPetsAllowed($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[37]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$post_allowed = getPetsAllowed($html);

function getFamilyKidFriendly($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[40]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$family_kids_frnds = getFamilyKidFriendly($html);

function getSmokingAllowed($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[46]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$smoking_allowed = getSmokingAllowed($html);

function getWheelchair($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[49]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$wheelchair = getWheelchair($html);


function getElevatorBuilding($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[51]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$elevortor = getElevatorBuilding($html);

function getIndoorFireplace($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[54]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$indor_fireplace = getIndoorFireplace($html);

function getWirelessIntercom($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[57]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$wireless_intercom = getWirelessIntercom($html);

function getDoorman($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[60]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$doorman = getDoorman($html);

function getPool($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[63]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$pool = getPool($html);

function getHotTub($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[65]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$hot_tub = getHotTub($html);

function getGym($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[68]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$gym = getGym($html);

function getHourCheckIn($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[70]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';

}
$hCheckIn = getHourCheckIn($html);

function getHangers($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[72]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';

}
$hungers = getHangers($html);

function getIron($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[74]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';

}
$iron = getIron($html);

function getHairDryer($html){
	$t = explode('$1-long.0.1.0">', $html);
	$t = explode('</span>', $t[76]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$hair_dryer = getHairDryer($html);

function getWorkspace($html){
	$t = explode('false,&quot;', $html);
	$t = explode('&quot;', $t[78]);
		if(isset($t[2])){
		return $t[2];	
	}
	return '';
}
$workspace = getWorkspace($html);

function getHouseRules($html){
	$t = explode('class="expandable-content"', $html);
	$t = explode('">', $t[1]);
	$t = explode('</span>', $t[4]);
	$fast=$t[0];
	$out=str_replace("don&#x27;t","do not",$fast);
	return $out;	
}
$house_rules=getHouseRules($html);
$rules_house=str_replace("#","",$house_rules);


function getHouseRule($html){
	$t = explode('class="expandable-content"', $html);
	$t = explode('">', $t[1]);
	$t = explode('</span>', $t[6]);
	if(isset($t[0])){
		return $t[0];	
	}
	return '';
}
$house_rule = getHouseRule($html);
$houses="$txt".","."$house_rule";

function getSuperhost($html){
	$t = explode('$Superhost">', $html);
	$t = explode('<img src="', $t[1]);
	$t = explode('"', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return ' ';
}
$super_host_img = getSuperhost($html);

function getVerifiedID($html){
	$t = explode('$Verified ID">', $html);
	$t = explode('<img src="', $t[1]);
	$t = explode('"', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return ' ';
}
$verifiedid_img = getVerifiedID($html);

function getReviews($html){
	$t = explode('$Reviews.0.0.1.0">', $html);
	$t = explode('</span>', $t[1]);
	if(isset($t[0])){
		return $t[0];	
	}
	return ' ';
}
$reviews = getReviews($html);
//insert getArea_ value


function getHosMemberInfo($html){
	$t = explode('space-2"', $html);
	$t = explode('<div', $t[4]);
	$t = explode('">', $t[3]);
	$t = explode('</span>', $t[2]);
	if(isset($t[0])){
		return $t[0];	
	}
	return ' ';

}
$host_member_info = getHosMemberInfo($html);


function getSafetyEqp($html){
	$t = explode('<div class="space-1"', $html);
	$t = explode('">', $t[5]);
	$t = explode('</span>', $t[2]);
		if(isset($t[0])){
		return $t[0];	
	}
	return ' ';
}
$safetyEqp = getSafetyEqp($html);


function getAccuracy($html){
	$t = explode('$Accuracy.0.0.0.0.0">', $html);
	$t = explode('<i class="', $t[1]);
	if(isset($t[1])){
		$i=0;
		foreach($t as $value){
			if(strstr($value,'$Accuracy.0.0.0.0.0.0:')){		
				$count=$i++;	
			}		
		}
		return $count;
	}
	return ' ';
}
$accuracy = getAccuracy($html);

function getCommunication($html){
	$t = explode('$Communication.0.0.0.0.0">', $html);
	$t = explode('<i class="', $t[1]);
	if(isset($t[1])){
		$i=0;
		foreach($t as $value){
			if(strstr($value,'$Communication.0.0.0.0.0.0:')){		
				$count=$i++;	
			}		
		}
		return $count;
	}
	return ' ';
}
$communication = getCommunication($html);

function getCleanliness($html){
	$t = explode('$Cleanliness.0.0.0.0.0">', $html);
	$t = explode('<i class="', $t[1]);
	if(isset($t[1])){
		$i=0;
		foreach($t as $value){
			if(strstr($value,'$Cleanliness.0.0.0.0.0.0:')){		
				$count=$i++;	
			}		
		}
		return $count;
	}
	return ' ';

}
$cleanliness = getCleanliness($html);

function getLocation($html){
	$t = explode('$Location.0.0.0.0.0">', $html);
	$t = explode('<i class="', $t[1]);
	if(isset($t[1])){
		$i=0;
		foreach($t as $value){
			if(strstr($value,'$Location.0.0.0.0.0.0:')){		
				$count=$i++;	
			}		
		}
		return $count;
	}
	return ' ';

}
$location = getLocation($html);

function getCheckInStr($html){
	$t = explode('$Check In.0.0.0.0.0">', $html);
	$t = explode('<i class="', $t[1]);
	if(isset($t[1])){
		$i=0;
		foreach($t as $value){
			if(strstr($value,'$Check In.0.0.0.0.0.0:')){		
				$count=$i++;	
			}		
		}
		return $count;
	}
	return ' ';
}
$check_in_str = getCheckInStr($html);
*/

/*
echo 	"!Amenities<br>
		Kitchen:".$kitchen."<br>
		Internet:<br>
		TV: <br>
		Essentials:<br>
		Shampoo:<br>
		Heating:<br>
		Air Conditioning:".$ac."<br>
		Waster:<br>
		Dryer:<br>
		Parking:".$parking_premises."<br>
		Wireless Internet:<br>
		Cable TV:<br>
		Breakfast:<br>
		Pets Allowed:<br>
		Family/Kids:<br>
		Events:<br>
		Smoking:<br>
		Wheelchair:<br>
		Indoor Fireplace:<br>
		Buzz/Wireless Intercom:<br>
		Doorman:<br>
		Pool:<br>
		Hot Tub:<br>
		Gym:<br>
		24-Hour Check-In:<br>
		Iron:<br>
		Hair Dryer:<br>
		Laptop Workspace:<br>";
echo 	"Title:".$title."1<br>".
		"Price:".$price."2<br>".
		"Area:".$area."3<br>".
		//$area_."4<br>".
		"User:".$user."5<br>".
		"Guest Reviews".$gest_review."6<br>".
		"Room Type".$room_type."7<br>".
		"About Listing:".$about_listing."8<br>".
		$bathrooms."9<br>".
		$bedrooms."10<br>".
		$beds."11<br>".
		$proparty_type."12<br>".
		$guest."13<br>".
		$check_in."14<br>".
		$check_out."15<br>".
		$availability."16<br>".
		$weekly_discount ."17<br>".
		$monthly_discount."18<br>".
		$cleaning."19<br>".
		$ketchen."20<br>".
		//$shampoo."21<br>".
		//$heating ."22<br>".
		$ac."23<br>".
		$washer."24<br>".
		$dryer."25<br>".
		$internet."26<br>".
		$tv."27<br>".
		$parking_premises."28<br>".
		$werless_internet."29<br>".
		$cable_tv."30<br>".
		$breakfast."31<br>".
		$post_allowed ."32<br>".
		$family_kids_frnds ."33<br>".
		$smoking_allowed."34<br>".
		$wheelchair."35<br>".
		$elevortor ."36<br>".
		$indor_fireplace ."37<br>".
		$wireless_intercom."38<br>".
		$doorman ."39<br>".
		$pool."40<br>".
		$hot_tub ."41<br>".
		$gym ."42<br>".
		$hCheckIn ."43<br>".
		$hungers."44<br>".
		$iron ."45<br>".
		$hair_dryer."46<br>".
		$workspace."47<br>".
		$rules_house."48<br>".
		//$houses."49<br>".
		//$super_host_img."50<br>".
		//$verifiedid_img."51<br>".
		$reviews."52<br>".
		//$host_member_info."53<br>".
		$star."54<br>".
		$safetyEqp."55<br>".
		$accuracy."56<br>".
		$communication."57<br>".
		$cleanliness ."58<br>".
		$location ."59<br>".
		$check_in_str ."60<br>";*/

?>