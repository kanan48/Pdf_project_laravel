<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use TCPDF;

class CsvController extends Controller
{
    public function CsvToPdf(Request $request)
    {
        if ($request->hasFile('csv_file')) 
        {
            $file = $request->file('csv_file');

            // TCPDF object
            $pdf = new TCPDF();
            $pdf->SetTitle('Generated PDF');

            // Read the CSV file
            $csvData = array_map('str_getcsv', file($file));

            // Get the headers 
            $headers = array_shift($csvData);
            $skuColumnIndex = array_search('SKU', $headers);

            foreach ($csvData as $row) 
            {
                $sku = $row[$skuColumnIndex];

                // Fetching product data based on Sku from the database
                $product = Products::where('Sku_Code', $sku)->first();

                if ($product && $product->Image) 
                {
                    $imagePath = $product->Image;

                    // for new page
                    $pdf->AddPage();

                    // Setting image size
                    $width = 100;
                    $height = 100;

                    // Conversion of image to PDF
                    $pdf->Image($imagePath, null, null, $width, $height);

                    // Add SKU code as text to the PDF
                    $pdf->SetXY(15, 10); // position for the text
                    $pdf->SetFont('helvetica', '', 10); // font and size
                    $pdf->Cell(0, 0, "SKU: $sku", 0, false, 'L', 0, '', 0, false, 'T', 'M'); // Add SKU code
                }
            }
            $pdf->Output('generated_pdf.pdf', 'D');
        }
    }
}