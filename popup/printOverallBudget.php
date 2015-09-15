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

$pdf->SetHeaderData('MyHome.png', PDF_HEADER_LOGO_WIDTH, 'Myhome Indonesia', 'Overall Budget Report');

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
$pdf->SetFont('helvetica', 'B', 16);

// add a page
$pdf->AddPage();

include("../controller/connect.php");

if(isset($_GET['m']))
	$month = $_GET['m'];

if(isset($_GET['y']))
    $year = $_GET['y'];

$query = "select EventID,EventTitle,DATE_FORMAT(StartDate,'%d %b %Y')AS StartDate, EndDate
        from event 
        where month(startDate) = $month and year(startDate) = $year
        order by startDate asc";

$result = mysql_query($query);

$GrandTotalExpected = 0;
$GrandTotalActual =0;
while($row = mysql_fetch_array($result)){
$pdf->SetFont('helvetica', 'B', 16);
$EventID = $row['EventID'];
$pdf->Write(0,$row['EventTitle'].' ('.$row['StartDate'].')', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);
// ----------------------------------------------------------------------------
$tbl = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td>No</td>
        <td>Division</td>
        <td>Budget Description</td>
        <td>Budget Expected</td>
        <td>Budget Actual</td>
        
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');


$query2 = "select EventTitle,DivisionName,BudgetID, BudgetDescription,BudgetExpected,BudgetActual
                            from BudgetEvent a join event b on a.eventid = b.eventid 
                            join division c on a.divisionid = c.divisionid
                            where a.eventid = '$EventID'
                            order by DivisionName asc";

$result2 = mysql_query($query2);


$i=0;
$totalExpected =0;
$totalActual = 0;
while($row2 = mysql_fetch_array($result2)){
$i++;
$totalExpected += $row2['BudgetExpected']; 
$totalActual += $row2['BudgetActual'];


$DivisionName = $row2['DivisionName'];
$BudgetDescription = $row2['BudgetDescription'];
$BudgetExpected = $row2['BudgetExpected'];
$BudgetActual = $row2['BudgetActual'];

$description = 'over';

$tbl2 = <<<EOD
<table cellspacing="0" cellpadding="1" border="1">
    <tr border="1">
        <td>$i</td>
        <td>$DivisionName</td>
        <td>$BudgetDescription</td>
        <td>$BudgetExpected</td>
        <td>$BudgetActual</td>

    </tr>

EOD;

	$pdf->writeHTML($tbl2, true, false, false, false, '');
}

$Difference = $totalExpected - $totalActual;

if($Difference >0 )
$desc = "Under";
else if($Difference <0)
$desc = "Over";
else 
$desc = "Balanced";    

$tbl3 = <<<EOD
<br/><br/>
<table cellspacing="0" cellpadding="1" border="1">
    <tr border="1">
        <td></td>
        <td></td>
        <td><b>Total</b></td>
        <td>$totalExpected</td>
        <td>$totalActual</td>
    </tr>
    <tr border="1">
        <td></td>
        <td></td>
        <td><b>Budget Difference</b></td>
       <td>$Difference</td>
        <td>($desc)</td>
    </tr>
EOD;

$pdf->writeHTML($tbl3, true, false, false, false, '');


$pdf->SetFont('helvetica', 'B', 16);


$GrandTotalExpected += $totalExpected;
$GrandTotalActual += $totalActual;


}//end of while 1


$pdf->Write(0,'Summary', '', 0, 'l', true, 0, false, false, 0);


$pdf->SetFont('helvetica', '', 8);

//$pdf->Write(0,'Grand Total Expected  : Rp.'.$GrandTotalExpected, '', 0, 'l', true, 0, false, false, 0);
//$pdf->Write(0,'Grand Total Actual    : Rp.'.$GrandTotalActual, '', 0, 'l', true, 0, false, false, 0);

$totalDifference = $GrandTotalExpected - $GrandTotalActual;

if($totalDifference >0 )
$desc = "Under";
else if($totalDifference <0)
$desc = "Over";
else 
$desc = "Balanced";   

$tbl4 = <<<EOD
<br/><br/>
<table cellspacing="0" cellpadding="1" border="1">
    <tr border="1">
        <td>Grand Total Expected</td>
        <td>$GrandTotalExpected</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr border="1">
        <td>Grand Total Actual</td>
        <td>$GrandTotalActual</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr border="1">
        <td>Grand Total Difference</td>
        <td>$totalDifference ($desc)</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
EOD;

$pdf->writeHTML($tbl4, true, false, false, false, '');


/*$tbl4 = <<<EOD
<br/><br/>
<table cellspacing="0" cellpadding="1" border="1">
    <tr border="1">
        <td>GrandTotalExpected</td>
        <td></td>
        <td><b>Total</b></td>
        <td>$GrandTotalExpected   </td>
        <td>$GrandTotalActual        </td>
    </tr>
    <tr border="1">
        <td></td>
        <td></td>
        <td><b></b></td>
       <td></td>
        <td></td>
    </tr>
EOD

$tbl5 = '<br/><br/>GrandTotalExpected';


$pdf->Write(0,$tbl5, '', 0, 'l', true, 0, false, false, 0);*/

//$pdf->writeHTML($tbl5, true, false, false, false, '');

$pdf->SetFont('helvetica', 'B', 16);



// -----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+