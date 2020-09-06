<html>

    <?php
    /*
        First Name Data
    */

    $firstNamesFile = fopen('inputData/first_names.csv', 'r');

    $firstNames = fgets($firstNamesFile);
    //New line character was present after Leslie, must remove \n
    $firstNames = str_replace(["\n", "\r"], '', $firstNames);

    fclose($firstNamesFile);

    $firstNames = explode(',', $firstNames);

    // print '<br>First Names: ';
    // print '<pre>';
    // print_r($firstNames);
    // print '</pre>';

    /*
        Last Name Data
    */

    $lastNamesFile = fopen('inputData/last_names.txt', 'r');

    while (!feof($lastNamesFile)) {
    	$names = fgets($lastNamesFile);
    	$names = str_replace(["\n", "\r"], '', $names);
    	if (!feof($lastNamesFile)) {
    		$lastNames[] = $names;
    	}
    }
    fclose($lastNamesFile);

    // print '<br>Last Names: ';
    // print '<pre>';
    // print_r($lastNames);
    // print '</pre>';

    /*
        Physical Address Data
    */
    //Get street name
    $streetNamesFile = fopen('inputData/street_names.txt', 'r');
    $streetNames = [];
    while (!feof($streetNamesFile)) {
    	$names = fgets($streetNamesFile);
    	$names = str_replace(["\n", "\r"], '', $names);
    	$names = explode(':', $names);
    	$streetName = $names;
    	if (!feof($streetNamesFile)) {
    		$streetNames[] = $names;
    	}
    	//   while(in_array($streetName, $streetNames)) {
    	//     print("<p>Duplicate address found, creating a new name</p>");
    	//     $streetInd = rand(0, sizeof($lastNames)-1);
    	//     $streetNames[] = $streetName;
    	// }
    }
    fclose($streetNamesFile);

    // print '<br>Street Names: ';
    // print '<pre>';
    // print_r($streetNames);
    // print '</pre>';

    //Get street type
    $streetTypesFile = fopen('inputData/street_types.txt', 'r');

    $streetTypes = fgets($streetTypesFile);
    $streetTypes = str_replace(["\n", "\r"], '', $streetTypes);

    fclose($streetTypesFile);

    $streetTypes = explode('..;', $streetTypes);

    // print '<br>Street Type: ';
    // print '<pre>';
    // print_r($streetTypes);
    // print '</pre>';

    $streetAds = [];
    for ($i = 0; $i < sizeof($streetNames); $i++) {
    	for ($j = 0; $j < sizeof($streetNames[$i]); $j++) {
    		$streetAds[] = $streetNames[$i][$j];
    	}
    }

    // Combine Street Names and Types
    $fullStreetAds = [];
    for ($i = 0; $i < 25; $i++) {
    	$nameInd = rand(0, sizeof($streetAds) - 1);
    	$typeInd = rand(0, sizeof($streetTypes) - 1);
    	$fullStreetAd = rand(100,999) . ' ' .  $streetAds[$nameInd] . ' ' . $streetTypes[$typeInd];

    	while (in_array($fullStreetAd, $fullStreetAds)) {
    		// print '<p>Duplicate street found, creating a new street</p>';
    		$nameInd = rand(0, sizeof($streetAds) - 1);
    		$typeInd = rand(0, sizeof($streetTypes) - 1);
    		$fullStreetAd = $streetAds[$nameInd] . ' ' . $streetTypes[$typeInd];
    	}
    	$fullStreetAds[] = $fullStreetAd;
    }

    print '<br>Full Addresses: ';
    print '<pre>';
    print_r($fullStreetAds);
    print '</pre>';

    /*
    Email extension Data
    */

    /*
        Email Address Data
    */
    $emailAds = [];
    for ($i = 0; $i < 25; $i++) {
    	$firstInd = rand(0, sizeof($firstNames) - 1);
    	$lastInd = rand(0, sizeof($lastNames) - 1);
    	$emailAd = $firstNames[$firstInd] . '.' . $lastNames[$lastInd];
    	// print "<p>$emailAd</p>";

    	while (in_array($emailAd, $emailAds)) {
    		// print '<p>Duplicate email found, creating a new name</p>';
    		$firstInd = rand(0, sizeof($firstNames) - 1);
    		$lastInd = rand(0, sizeof($lastNames) - 1);
    		$emailAd = $firstNames[$firstInd] . ' ' . $lastNames[$lastInd];
    	}
    	$emailAds[] = $emailAd;
    }
    print '<br>Email Address Data: ';
    print '<pre>';
    print_r($emailAds);
    print '</pre>';


    


    ?>

</html>
