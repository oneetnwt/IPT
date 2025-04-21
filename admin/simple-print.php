<?php

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once __DIR__ . '../../vendor/autoload.php';
    require_once __DIR__ . '../../includes/db.php' ;

    $mpdf = new \Mpdf\Mpdf();
    header("Content-Type: application/pdf");

    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;

    $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: "Helvetica Neue", sans-serif;
                    font-size: 12px;
                    padding: 20px;
                    color: #333;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                table, th, td {
                    border: 1px solid #000;
                }
                th, td {
                    padding: 8px;
                    text-align: left;
                }
                .signature_section {
                    margin-top: 50px;
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h4>Product List</h4>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
    ';

    foreach ($products as $product) {
        $html .= '
            <tr>
                <td>' . $count++ . '</td>
                <td>' . htmlspecialchars($product['product_name']) . '</td>
                <td>' . htmlspecialchars($product['category']) . '</td>
                <td>' . htmlspecialchars($product['price']) . '</td>
                <td>' . htmlspecialchars($product['stock']) . '</td>
            </tr>
        ';
    }

    $html .= '
                </tbody>
            </table>
            <div class="signature_section">
                <p>_________________________________________________</p>
                <p><strong>General Manager</strong></p>
            </div>
        </body>
        </html>
    ';

    $mpdf->SetHTMLFooter('
        <div style="text-align: left;">
            Page {PAGENO} of {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);
    $mpdf->Output(); // Or $mpdf->Output("products.pdf", "I");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Products</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Helvetica Neue", sans-serif;
            width: 100%;
            height: 100vh;
            background: #151314;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }

        button {
            background: none;
            border: 1px solid #fff;
            color: white;
            font-weight: bold;
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            transition: all 0.3s ease-in-out;
        }

        button:hover {
            background: #fff;
            color: #151314;
            border: 1px solid #fff;
        }
    </style>
</head>
<body>
    <h1>Print Product List</h1>
    <form action="" method="POST">
        <button type="submit">Print Products</button>
    </form>
</body>
</html>