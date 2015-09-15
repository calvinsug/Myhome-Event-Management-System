<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 048');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data

$pdf->SetHeaderData('MyHome.png', PDF_HEADER_LOGO_WIDTH, 'Myhome Indonesia', 'Rundown Report');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

include("../controller/connect.php");

if(isset($_GET['EventID']))
	$EventID = $_GET['EventID'];

if(isset($_GET['EventTitle']))
    $EventTitle = $_GET['EventTitle'];

$query = "select RundownID,EventTitle, Dayrundown , startTime, endTime, description, c.LocationID,locationName, locationAddress 
                        from rundownevent a join event b on a.eventid = b.eventid
                        join location c on c.locationid = a.locationid 
                        where a.eventID = '$EventID'
                        order by dayrundown,StartTime asc";

$result = mysql_query($query);


$pdf->Write(0,$EventTitle, '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td>No</td>
        <td>Day</td>
        <td>Location</td>
        <td>Start Time</td>
        <td>End Time</td>
        <td>Description</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$i=0;
while($row = mysql_fetch_array($result)){
$i++;

$day = $row['Dayrundown'];
$location = $row['locationName'];
$start = $row['startTime'];
$end = $row['endTime'];
$description = $row['description'];

$tbl2 = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr border="1">
        <td>$i</td>
        <td>$day</td>
        <td>$location</td>
        <td>$start</td>
        <td>$end</td>
        <td>$description</td>
    </tr>

EOD;

	$pdf->writeHTML($tbl2, true, false, false, false, '');
}
//$pdf->writeHTML($tbl3, true, false, false, false, '');


/*while($row2 = mysql_fetch_array($result2)){
	$pdf->writeHTML($tbl3, true, false, false, false, '');
}*/
	


// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+