<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\login;
use App\Models\Products;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    // for change password 
    public function change(Request $request)
    {
        if($request->isMethod('post'))
        {
            $oldpw = $request->get('oldpass');
            $newpw = $request->get('newpass');
            $cnewp = $request->get('cnewpass');
            if($newpw == $cnewp)
            {
                $data = login::where('password',$oldpw)->first();
                if(isset($data))
                {
                    $data->password = $newpw;
                    $data->save();
                    return redirect('/change-password')->withSuccess("Password Updated Successfully");
                }
                else
                {
                    return redirect('/change-password')->withSuccess("Old Password not match");
                }
                
            }
            else
            {
                return redirect('/change-password')->withSuccess( "New password and Confirm new password does not match");
            }                   
        }
    }

    // for uploading images on database table
    public function upload(Request $request)
    {
        if ($request->hasFile('csv_file')) 
        {
            $file = $request->file('csv_file');
            if ($file->isValid()) 
            {
                $filePath = $file->getRealPath();

                // file content
                $data = array_map('str_getcsv', file($filePath));
                $headers = array_shift($data);
                
                Products::truncate();
                foreach ($data as $row) 
                {
                    $rowData = array_combine($headers, $row);

                    // Create and save the model
                    Products::create($rowData);
                }
                return redirect()->back()->with('success', 'Data imported successfully.');
            } 
            else
            {
                return redirect()->back()->with('error', 'Invalid file uploaded.');
            }
        }
        return redirect()->back()->with('error', 'No file uploaded.');
    }

    // for making zip file of images 
    public function downloadImages()
    {
        // Fetch images
        $imageLinks = DB::table('products')->pluck('Image');

        // Create a new zip archive
        $zip = new ZipArchive;
        $zipFileName = 'images.zip';

        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) 
        {
            foreach ($imageLinks as $link) 
            {
                $filename = basename($link);

                // Download the image
                $imageContent = file_get_contents($link);

                // Adding downloaded image to the zip archive
                if ($imageContent !== false) {
                    $zip->addFromString($filename, $imageContent);
                }
            }
            $zip->close();

            return response()->download(public_path($zipFileName))->deleteFileAfterSend(true);
        }
        return 'Failed to create zip file.';
    }
}