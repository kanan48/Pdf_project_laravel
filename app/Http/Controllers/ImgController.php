<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Http;

class ImgController extends Controller
{
    public function generatePDF(Request $request)
    {
        // uploaded CSV file
        $csvFile = $request->file('csv_file');
        
        // Process CSV to get SKUs
        $csvData = array_map('str_getcsv', file($csvFile));
        $skus = array_column($csvData, 0); // Sku is in the first column
        
        $imageUrls = Products::whereIn('Sku_Code', $skus)->pluck('Image')->toArray();
        
        // Create a temporary directory to store images
        $tempDir = storage_path('app/temp_images_' . uniqid());
        if (!is_dir($tempDir)) {
            mkdir($tempDir);
        }

        // store in the temporary directory
        foreach ($imageUrls as $imageUrl) 
        {
            $response = Http::get($imageUrl);
            if ($response->successful()) 
            {
                file_put_contents($tempDir . '/' . basename($imageUrl), $response->body());
            }
        }

        // This will create ZIP file
        $zip = new ZipArchive();
        $zipFileName = 'images.zip';
        $zipFilePath = storage_path("app/{$zipFileName}");

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Add files to the ZIP archive
            $files = glob($tempDir . '/*');
            foreach ($files as $file) 
            {
                $zip->addFile($file, basename($file));
            }
            $zip->close();
        }

        // Delete temporary directory after creating the ZIP file
        Storage::deleteDirectory('temp_images_' . basename($tempDir));

        // Provide the ZIP file for download
        return response()->download($zipFilePath);
    }
}