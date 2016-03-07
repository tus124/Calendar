<?php date_default_timezone_set("America/New_York");

PrintMonth(0, true);
PrintMonth(1, false);
PrintMonth(2, false);
PrintMonth(3, false);
PrintMonth(4, false);
PrintMonth(5, false);
PrintMonth(6, flase);

function PrintMonth($iteration, $isToday) {
    $day_start = 1;     // 0 = Monday; 1 = Sunday
    
    if ($isToday == true) {    
        $today = date("j");
    }
    
    $getMonthNumber = date("m", strtotime("+" . $iteration . "months"));
    $getYearNumber = date("Y", strtotime("+" . $iteration . "months"));    

    $first_day = date("w", mktime(0, 0, 0, $getMonthNumber, 1, $getYearNumber)) + $day_start;
    $j = $first_day;

    $getYear = date("Y", mktime(0, 0, 0, $getMonthNumber, 1, $getYearNumber));
    $getMonth = date("F", mktime(0, 0, 0, $getMonthNumber, 1, $getYear));
    $total = date("t", mktime(0, 0, 0, $getMonthNumber, 1, $getYearNumber));

    PrintMonthHeader($getMonth, $getYear);
    PrintWeeklyHeader();
    PrintWhiteSpaces($j);
    PrintDaysOfMonth($isToday, $total, $today, $j, $getMonth, $getYear);
    printf("\n\n");
}

function PrintMonthHeader($paramMonth, $paramYear) {
    printf(" %s :: %s\n", $paramMonth, $paramYear);
}

function PrintWeeklyHeader() {
    printf("  S  M  T  W  R  F  S");
    printf("\n");
}

function PrintWhiteSpaces($startPosition) {
    for ($x = 1 ; $x < $startPosition; $x++) { 
		printf("   ");
	}    
}

function PrintDaysOfMonth($isThisMonth, $total, $today, $firstDay, $month, $year) {
    for ($i = 1 ; $i <= $total ; $i++) {

        if($i == $today) {
            if ($isThisMonth) {
				if (CheckHoliday($month .  ' ' . $i . ', ' . $year)) {
					// 32m is Green: IsToday && Holiday
					$color_day = ($i < 10) ? '  ' .$i :  ' ' . $i;
		       		echo chr(27), '[', '32m', $color_day, chr(27), '[', '0m'; 
				}
				else {
					// 33m is Yellow: IsToday only
		            $color_day = ($today < 10) ? '  '.$i : ' '.$i;
		            echo chr(27),'[', '33m', $color_day, chr(27), '[', '0m';
				}
            }        
        }
	else if (CheckHoliday($month .  ' ' . $i . ', ' . $year)) {
		// 35m is Pink: Holiday only
       		$color_day = ($i < 10) ? '  ' .$i :  ' ' . $i;
       		echo chr(27), '[', '35m', $color_day, chr(27), '[', '0m'; 
	}
	else {
		printf("%3d", $i);
	}
	
	if($i != $total) {
		//end of the week
        	if ($firstDay == 7) {    
            	$firstDay = 0;
            	printf("\n");
        	}
        	$firstDay++;
	}
    }
}

function GetThanksGivingDate($date) {
	//This makes the current year a variable 
	$year = date("Y", strtotime($date));

	//Here we generate the first day of November
	$first_day = mktime(0, 0, 0, 11, 1, $year);

	//We determine what day of the week the first falls on
	$day_of_week = date("D", $first_day);

	//Based upon this, we add the appropriate number of days 
	//to get to the forth Thursday of the month
	switch($day_of_week) { 
 		case "Sun": $add = 25; break;
 		case "Mon": $add = 24; break; 
 		case "Tue": $add = 23; break; 
 		case "Wed": $add = 22; break; 
 		case "Thu": $add = 21; break; 
 		case "Fri": $add = 27; break; 
 		case "Sat": $add = 26; break; 
 	}

 	$Thanks = 1 + $add;
	
	return $Thanks;
}

function GetMartinLutherKingDate($date) {
	$year = date("Y", strtotime($date));
	$first_day = mktime(0, 0, 0, 1, 1, $year);	
	$day_of_week = date("D", $first_day);

	switch($day_of_week) { 
 		case "Sun": $martin = 16; break;
 		case "Mon": $martin = 15; break; 
 		case "Tue": $martin = 21; break; 
 		case "Wed": $martin = 13; break; 
 		case "Thu": $martin = 19; break; 
 		case "Fri": $martin = 18; break; 
 		case "Sat": $martin = 17; break; 
 	}

	return $martin;
}

function GetPresidentDayDate($date) {
	$year = date("Y", strtotime($date));
	$first_day = mktime(0, 0, 0, 2, 1, $year);	
	$day_of_week = date("D", $first_day);

	switch($day_of_week) { 
 		case "Sun": $president = 16; break;
 		case "Mon": $president = 15; break; 
 		case "Tue": $president = 14; break; 
 		case "Wed": $president = 20; break; 
 		case "Thu": $president = 19; break; 
 		case "Fri": $president = 18; break; 
 		case "Sat": $president = 17; break; 
 	}

	return $president;
}

function GetVeteranDayDate($date) {
	$year = date("Y", strtotime($date));
	$first_day = mktime(0, 0, 0, 11, 1, $year);	
	$day_of_week = date("D", $first_day);

	switch($day_of_week) { 
 		case "Sun": $veteran = 16; break;
 		case "Mon": $veteran = 15; break; 
 		case "Tue": $veteran = 14; break; 
 		case "Wed": $veteran = 13; break; 
 		case "Thu": $veteran = 12; break; 
 		case "Fri": $veteran = 11; break; 
 		case "Sat": $veteran = 10; break; 
 	}

	return $veteran;
}

function GetColumbusDayDate($date) {
	$year = date("Y", strtotime($date));
	$first_day = mktime(0, 0, 0, 10, 1, $year);	
	$day_of_week = date("D", $first_day);
	
	switch($day_of_week) { 
 		case "Sun": $columbus = 9; break;
 		case "Mon": $columbus = 8; break; 
 		case "Tue": $columbus = 14; break; 
 		case "Wed": $columbus = 13; break; 
 		case "Thu": $columbus = 12; break; 
 		case "Fri": $columbus = 11; break; 
 		case "Sat": $columbus = 10; break; 
 	}
	
	return $columbus;
}

function GetLaborDayDate($date) {
	$year = date("Y", strtotime($date));
	$first_day = mktime(0, 0, 0, 9, 1, $year);	
	$day_of_week = date("D", $first_day);
	
	switch($day_of_week) { 
 		case "Sun": $labor = 2; break;
 		case "Mon": $labor = 1; break; 
 		case "Tue": $labor = 7; break; 
 		case "Wed": $labor = 6; break; 
 		case "Thu": $labor = 5; break; 
 		case "Fri": $labor = 4; break; 
 		case "Sat": $labor = 3; break; 
 	}
	
	return $labor;
}

function GetMemorialDayDate($date) {
	$year = date("Y", strtotime($date));
	$first_day = mktime(0, 0, 0, 5, 1, $year);	
	$day_of_week = date("D", $first_day);
	
	switch($day_of_week) { 
 		case "Sun": $labor = 30; break;
 		case "Mon": $labor = 29; break; 
 		case "Tue": $labor = 28; break; 
 		case "Wed": $labor = 27; break; 
 		case "Thu": $labor = 26; break; 
 		case "Fri": $labor = 25; break; 
 		case "Sat": $labor = 31; break; 
 	}
	
	return $labor;
}


function CheckHoliday($date) {
	$day = date("d", strtotime($date));
	
	$getMartinLutherDate = GetMartinLutherKingDate($date);
	$getPresidentDayDate = GetPresidentDayDate($date);
	$getMemorialDayDate = getMemorialDayDate($date);
	$getLaborDayDate = GetLaborDayDate($date);
	$getColumbusDayDate = GetColumbusDayDate($date);
	$getVeteranDayDate = GetVeteranDayDate($date);
	$getThanksGivingDate = GetThanksGivingDate($date);


	if ($getMartinLutherDate == $day) {
		$martin = "01 " . $day;
	}
	if($getPresidentDayDate == $day) {
		$president = "02 " . $day;
	}
	if($getMemorialDayDate == $day) {
		$memorial = "05 " . $day;
	}

	if($getLaborDayDate == $day) {
		$labor = "09 " . $day;
	}
	if($getColumbusDayDate == $day) {
		$columbus = "10 " . $day;
	}
	if($getVeteranDayDate == $day) {
		$veteran = "11 " . $day;
	}
	if ($getThanksGivingDate == $day) {
		$thanks = "11 " . $day;
	}

	switch(date("m d",strtotime($date))) {
		// January Holidays
        case "01 01":		// New Years - 01/01
       		return true; 
			break;

		case $martin:		// Martin Luther King Day - 01/20
			return true;
			break;

		// February Holidays
		case $president:	// President's Day - 02/18
			return true;
			break;

		// May Holidays
		case $memorial:		// Memorial Day - 05/28
			return true;
			break;

		// July Holidays
		case "07 04":		// Independence Day - 07/04
       		return true; 
			break;

		// September Holidays
		case $labor:		// Labor Day - 09/03
			return true;
			break;

		// October Holidays
		case $columbus:		// Columbus Day - 10/08
			return true;
			break;

		// November Holidays
		case $thanks:		// ThanksGiving - 11/22
			return true;
			break;

		case $veteran:		// Veteran's Day - 11/12
			return true;
			break;
	
		// December Holidays
 		case "12 25":		// Christmas - 12/25
        	return true; 
			break;

		// DEFAULT
		default:			// Default 
			return false;
			break;
    	}
} 
?>
