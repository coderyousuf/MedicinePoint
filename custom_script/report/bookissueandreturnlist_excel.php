<?php

include ("databaseconnection.php"); /* * *Connection information** */
$conn = mysqli_connect(HOSTNAME, DBUSER, DBPWD, DBNAME) or die('Could not connect to database');
mysqli_query($conn,'SET CHARACTER SET utf8');
include_once("xlsxwriter/xlsxwriter.class.php");

$loginuserid = $_GET['loginuserid']; 

$header = array(
  'Sl'=>'0',//integer
  'Issue Date'=>'@',
  'Book Name'=>'@',
  'Request Code'=>'@',
  'Issued to ID'=>'@',
  'Fine'=>0,
  'Return Date'=>'@',
  'Status'=>'@'
);
/* 
$header = array(
  'Sl'=>'0',//integer
  'Province'=>'@',//text
  'BCZ'=>'@',//text
  'Facility'=>'@',//text
  'Product Group'=>'@',//text
  'Product Name'=>'@',//text
  'OP Stock'=>'integer',
  'Receive'=>'integer',
  'Dispense'=>'integer',
  'Adj Stock'=>'integer',
  'CL Stock'=>'integer',
  'AMC'=>'integer',
  'MOS'=>'integer'//,
  // 'c4-integer'=>'0',
  // 'c5-price'=>'price',
  // 'c6-price'=>'#,##0.00',//custom
  // 'c7-date'=>'date',
  // 'c8-date'=>'YYYY-MM-DD',
); */


$writer = new XLSXWriter();
$sheetName = "Data";
$reportHeaders = array('Online Library Management System','Book Issue and Return List');

$writer->writeSheetHeader(
			$sheetName, 
			$header, 
			array(
				'widths'=>array(8,15,15,25,18,15,15,15),
				'font-style'=>'bold',
				'font-size'=>11,
				'fill'=>'#b4c6e7',
				'border'=>'left,right,top,bottom',
				// 'border'=>'left,left,left,right,right,right,left',
				'border-style'=>'thin',
				// 'border-style'=>'',
				'halign'=>'left',
				'report_headers'=>$reportHeaders
			)
		);

$rowStyle = array( 'border'=>'left,right,top,bottom','border-style'=>'thin');

 $sql = "SELECT a.*,BookName,usercode,c.name,c.userrole
FROM `t_bookrequest` a 
INNER JOIN t_books b ON a.BookId=b.BookId
INNER JOIN users c ON a.UserId=c.id
where (Status='Issued' OR Status='Returned')
ORDER BY IssueDate desc;";

$result = mysqli_query($conn, $sql);
$i = 1;

while ($val = mysqli_fetch_array($result)) {
	$Status = $val['Status'];
	
	
	$writer->writeSheetRow($sheetName, array($i++, $val['IssueDate'],$val["BookName"],
	$val['RequestCode'],$val['usercode'],$val['FineAmount'],$val['ReceiveDate'],$Status),$rowStyle );

}

//Report header merge
if(count($reportHeaders)>0){
	$writer->markMergedCell($sheetName, $start_row=0, $start_col=0, $end_row=0, $end_col=7);
	$writer->markMergedCell($sheetName, $start_row=1, $start_col=0, $end_row=1, $end_col=7);
} 


$exportFileName="book_issue_and_return_list_".date("Y_m_d_H_i_s").".xlsx";
$writer->writeToFile("media/".$exportFileName);
header('Location:./media/'.$exportFileName); //File open location	









