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

    // print '<br>Full Addresses: ';
    // print '<pre>';
    // print_r($fullStreetAds);
    // print '</pre>';

    /*
    Email extension Data
    */
    $emailExtFile = fopen('inputData/domains.txt', 'r');

    $emailExts = fgets($emailExtFile);
    $emailExts = str_replace(["\n", "\r"], '', $emailExts);

    fclose($emailExtFile);

    $emailExtsEven = [];
    $emailExtsOdd = [];
    $emailExtsSum = [];
    $emailExtsFinal = [];
    $emailExts = explode('.', $emailExts);
    for ($i = 0; $i < sizeof($emailExts); $i++) {
        if($i % 2 == 0){
            $emailExtsEven[$i] = $emailExts[$i];
        } 
        else {
            $emailExtsOdd[$i] = $emailExts[$i];            
            
        }
    }
    $emailExtsSum = $emailExtsEven + $emailExtsOdd;
    for ($i = 0; $i < sizeof($emailExts); $i++) {
        if ($i % 2 == 0){
            $emailExtsFinal[$i] = $emailExtsEven[$i].".".$emailExtsOdd[$i + 1];
        }
    }
    
    // print '<pre>';
    // print_r($emailExts);
    // print_r($emailExtsEven);
    // print_r($emailExtsOdd);
    // print_r($emailExtsSum);
    // print_r(array_values(array_filter($emailExtsFinal)));
    // print '</pre>';

    /*
        Email Address Data
    */
    $emailAds = [];
    for ($i = 0; $i < 25; $i++) {
    	// $firstInd = rand(0, sizeof($firstNames) - 1);
        // $lastInd = rand(0, sizeof($lastNames) - 1);
        $extInd = rand(0, (sizeof($emailExts) / 2) - 1) * 2;
    	$emailAd = $firstNames[$i] . '.' . $lastNames[$i] . '@' . $emailExtsFinal[$extInd];
    	// print "<p>$emailAd</p>";

    	while (in_array($emailAd, $emailAds)) {
    		// print '<p>Duplicate email found, creating a new name</p>';
    		// $firstInd = rand(0, sizeof($firstNames) - 1);
    		// $lastInd = rand(0, sizeof($lastNames) - 1);
    		$emailAd = $firstNames[$firstInd] . ' ' . $lastNames[$lastInd];
    	}
    	$emailAds[] = $emailAd;
    }
    // print '<br>Email Address Data: ';
    // print '<pre>';
    // print_r($emailAds);
    // print '</pre>';


    print("<table border = '3' >");

    $dataHeaders = ['First Name', 'Last Name', 'Address', 'Email'];
    for($x = 0; $x < 4; $x++) {
        print("<th>$dataHeaders[$x]</th>");
    }
    
    

//rows x columns
    for ($x = 0; $x < 25; $x++) {
        $customerInfo[$x][0] = $firstNames[$x];
        $customerInfo[$x][1] = $lastNames[$x];
        $customerInfo[$x][2] = $fullStreetAds[$x];
        $customerInfo[$x][3] = $emailAds[$x];
        
    }

    for($x = 0; $x < 25; $x++) {
        print("<tr>");
        for($y = 0; $y < 4; $y++) {
            print("<td align='center'>" . $customerInfo[$x][$y] . "</td>");
        }
        print("</tr>");
    }

    print("</table><br>");
    ?>

</html>
