<?php

namespace App\Http\Controllers;
use App\Models\login;
use App\Models\Products;
use Illuminate\Http\Request;

class CrudController extends Controller
{
//    public function insert(Request $request)
//    {
//         $add=new addpage;
//         if($request->isMethod('post'))
//         {
//             $add->name=$request->get('name');
//             $add->content=$request->get('content');
//             $add->status=$request->get('status');
//             $add->save();
            
//         }
//         return redirect("/addpage");   
//    }
//    public function display()
//    {
//     $data=addpage::paginate(10);
//     return view('pagesumm',compact('data'));
//    }
//    public function delete($id)
//    {
//     $ob=addpage::find($id);
//     $ob->delete();
//     return redirect('pagesumm');
//    }
//    public function edit($id)
//    {
//        $findrec=addpage::where('id',$id)->get();
//        return view('addpage',compact('findrec'));
//    }
//    public function edit_form(Request $request, $id='')
//    {
//        $add=addpage::find($id);
//        if($request->isMethod('post'))
//        {
//            $add->name = $request->get('name');
//            $add->content = $request->get('content');
//            $add->status = $request->has('status')? 1 : 0 ;
//            $add->save();
//        }
//        return redirect('pagesumm');
//    }
//    public function search(Request $request)
//     {
//         if($request->isMethod('post'))
//         {
//             $name=$request->get('find');
//             $data=addpage::where('name','LIKE','%'.$name.'%')->paginate(5);
//         }
//         return view('pagesumm',compact('data'));

//     }
//     public function category(Request $request )
//     {
//         $insert=new category;
//         if($request->isMethod('post'))
//         {
//             $insert->name=$request->get('catname');
//             $insert->save();

//         }
//         return redirect('categoryadd');
//     }
//     public function show()
//     {
//         $data=category::paginate(10);
//         return view('category',compact('data'));
//     }
//     public function del_cat($id)
//     {
//         $data=category::find($id);
//         $data->delete();
//         return redirect('category');
//     }
//     public function edit_cat($id)
//     {
//         $findrec=category::where('id',$id)->get();
//         return view('categoryadd',compact('findrec'));  
//     }
//     public function edit_cform(Request $request, $id='')
//     {
//         $insert=category::find($id);
//         if($request->isMethod('post'))
//         {
//             $insert->name=$request->get('catname');
//             $insert->save();
//         }
//         return redirect('category');
//     }
//     public function findcat(Request $request)
//     {
//         if($request->isMethod('post'))
//         {
//             $name=$request->get('search');
//             $data=category::where('name','LIKE','%'.$name.'%')->paginate(5);
//         }
//         return view('category',compact('data'));
//     }
//     public function product(Request $request)
//     {
//         if ($request->hasFile('pimage'))
//         {
//             $image = $request->file('pimage');
//             $customName =  time() . '.' . $image->getClientOriginalExtension();
//             $imagePath = $image->move('product_images', $customName, 'public');
//         }
        
//         if($request->isMethod('post'))
//         {
//             $addata=new product;
//             $addata->cid=$request->get('cid');
//             $addata->pname=$request->get('pname');
//             $addata->desc=$request->get('pdesc');
//             $addata->price=$request->get('pprice');
//             $addata->image=$imagePath;
//             $addata->save();
//         }
//         return redirect('productadd');
//     }
//     public function showp()
//     {
//         $data=product::paginate(2);
//         return view('product',compact('data'));
//     }
//     public function del_pro($id)
//     {
//         $ob=product::find($id);
//         $ob->delete();
//         return redirect('product');
//     }
//     public function edit_pro($id)
//     {
//         $findrec=product::where('id',$id)->get();
//         return view('productadd',compact('findrec'));
//     } 
//     public function pro_display(Request $request, $id='')
//     {
//         $findrec=product::find($id);
//         if($request->isMethod('post'))
//         {
//             $findrec->pname=$request->get('pname');
//             $findrec->desc=$request->get('pdesc');
//             $findrec->price=$request->get('pprice');
//             $findrec->save();
//         }
//         return redirect('product');
//     }
    // public function record(Request $request)
    // {
    //     if($request->isMethod('post'))
    //     {
    //         $name=$request->get('record');
    //         $data=product::where('pname','LIKE','%'.$name.'%')->paginate(5);
    //     }
    //     return view('product',compact('data'));
    // }
    public function change(Request $request)
    {
        // $data = new Login;
        if($request->isMethod('post'))
        {
            $oldpw = $request->get('oldpass');
            $newpw = $request->get('newpass');
            $cnewp = $request->get('cnewpass');
            if($newpw == $cnewp){
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

    public function upload(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csvData = file_get_contents($file);
            $rows = array_map("str_getcsv", explode("\n", $csvData));

            foreach ($rows as $row) {
                Products::create([
                    'Sku_Code' => $row[0], // Map CSV columns to database columns
                    'Image' => $row[1],
                    // Add more columns as needed
                ]);
            }
        }

        return redirect()->back()->with('success', 'CSV data has been uploaded successfully');
    }
}