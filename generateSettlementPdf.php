<?php
require_once 'tcpdf/tcpdf.php';
require_once 'connection.php';

if (isset($_GET['settlement_id'])) {
    $settlementId = $_GET['settlement_id'];

    // Fetch settlement and customer details
    // Assuming $conn is your MySQLi connection object
    
    // Prepare to call the stored procedure
    $stmt = $conn->prepare("CALL GetSettlementDetails(?)");
    
    // Bind the settlementId parameter to the stored procedure
    $stmt->bind_param("i", $settlementId);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result set
    $result = $stmt->get_result();
    
    // Fetch the settlement details
    $settlement = $result->fetch_assoc();
    
    // Close the prepared statement
    $stmt->close();
    

    

    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Settlement Report');
    $pdf->SetSubject('Settlement Details');
    $pdf->SetKeywords('TCPDF, PDF, settlement, report');

    // Add a page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Generate PDF content
    $html = '
    <h1>Settlement Report</h1>
    <p><strong>Customer Name:</strong> ' . $settlement['Customer_Name'] . '</p>
    <p><strong>Shop Name:</strong> ' . $settlement['Shop_Name'] . '</p>
    <p><strong>Paid Amount:</strong> ' . number_format($settlement['paid_amount'], 2) . '</p>
    <p><strong>Current Outstanding:</strong> ' . number_format($settlement['Customer_Outstanding'], 2) . '</p>
    <p><strong>Date & Time:</strong> ' . $settlement['date & time'] . '</p>';

    $pdf->writeHTML($html, true, false, true, false, '');

    // Define the path to save the PDF using settlement_id
    $file_path = __DIR__ . '/report/settlement/settlement_' . $settlementId . '.pdf';

    // Output the PDF to the specified path
    $pdf->Output($file_path, 'F');

    // Redirect to the generated PDF
    //header('Location: ' . str_replace(__DIR__, '', $file_path));
    //exit();
    header('Location:dashboard.php');
    exit();
} else {
    echo "Invalid request.";
}
