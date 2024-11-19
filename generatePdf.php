<?php
require_once 'tcpdf/tcpdf.php';
require_once 'connection.php';

// Suppress warnings temporarily to prevent headers from being sent prematurely
error_reporting(E_ERROR | E_PARSE);

if (isset($_GET['bill_no'], $_GET['customer_id'], $_GET['subtotal'], $_GET['customer_paid'], $_GET['bill_balance'], $_GET['date_time'], $_GET['products'])) {
    // Retrieve data from query parameters
    $bill_no = $_GET['bill_no'];
    $customer_id = $_GET['customer_id'];
    $subtotal = (float)$_GET['subtotal'];
    $customer_paid = (float)$_GET['customer_paid'];
    $bill_balance = (float)$_GET['bill_balance'];
    $date_time = $_GET['date_time'];
    $product_details = json_decode(urldecode($_GET['products']), true);

    // Query the database to get the Shop_Name from customer table
    $query = "SELECT Shop_Name FROM customer WHERE Customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer_data = $result->fetch_assoc();
    $shop_name = $customer_data['Shop_Name'] ?? 'Unknown Shop';

    // Create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('D&S Marketting');
    $pdf->SetTitle('INVOICE');
    $pdf->SetSubject('Bill Report');
    $pdf->SetKeywords('TCPDF, PDF, bill, report');

    // Set margins and auto page breaks
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // Disable header and footer to resolve the error
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    // Add a page
    $pdf->AddPage();

    // Add logo to the top-left corner (adjust the file path, position, and size as needed)
    $logo = 'logo/logo.png'; // Replace with the actual path to your logo file
    $pdf->Image($logo, 10, 10, 55, 30, 'PNG', '', '', true);

    // Set font for the address and contact information
    $pdf->SetFont('helvetica', 'B', 12);

    // Add address and contact information
    $html = '<div style="text-align: center; margin-bottom: 5px;">
        <h1>D & S MARKETING</h1>
        <p>No. 79/E, Welgama, Thiththapaththara.<br>
        <span style="color: red;">Hot Line: 076-6967135, 076-5664742 </span> Office: 011-2536288<br>
        <span style="color: green;">Whatsapp: 070-1043515</span><br>
        E-mail: rapsolchemicals@gmail.com<br>
        Reg No. WN 3623</p>
    </div>';

    $pdf->writeHTML($html, true, false, true, false, '');

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Add bill details with Shop Name
    $html = '<h2>Bill Details</h2>
    <p>Bill No: ' . htmlspecialchars($bill_no, ENT_QUOTES) . '</p>
    <p>Shop Name: ' . htmlspecialchars($shop_name, ENT_QUOTES) . '</p>
    <p>Date and Time: ' . htmlspecialchars($date_time, ENT_QUOTES) . '</p>
    <p>Subtotal: Rs. ' . number_format($subtotal, 2) . '</p>
    <p>Customer Paid: Rs. ' . number_format($customer_paid, 2) . '</p>
    <p>Bill Balance: Rs. ' . number_format($bill_balance, 2) . '</p>';

    $pdf->writeHTML($html, true, false, true, false, '');

    // Add product details
    $html = '<h3>Product Details</h3>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>';

    foreach ($product_details as $product) {
        $html .= '<tr>
            <td>' . htmlspecialchars($product['name'], ENT_QUOTES) . '</td>
            <td>Rs. ' . number_format((float)$product['price'], 2) . '</td>
            <td>' . (int)$product['qty'] . '</td>
            <td>Rs. ' . number_format((float)$product['amount'], 2) . '</td>
        </tr>';
    }

    $html .= '</tbody></table>';

    // Output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // Move the cursor to the bottom middle of the page for the footer text
    $pdf->SetY(-30); // 30 units from the bottom
    $pdf->SetFont('helvetica', 'I', 10);

    // Add the footer text
    $pdf->Cell(0, 10, 'Software by Chox Trading - 0771168439', 0, 1, 'C');

    // Define the path to save the PDF using bill_no
    $file_name = 'Bill_Report_' . $bill_no . '.pdf';
    $file_path = __DIR__ . '/report/invoice/' . $file_name;

    // Ensure the directory exists
    if (!is_dir(dirname($file_path))) {
        mkdir(dirname($file_path), 0755, true);
    }

    // Output the PDF to the specified file path
    $pdf->Output($file_path, 'F');

    // Redirect to a different page after generating the PDF
    header('Location: dashboard.php');
    exit();
} else {
    echo "Invalid request.";
}

?>
