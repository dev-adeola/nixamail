<?php

namespace App\Http\Controllers;

use Image;
use App\Models\Contact;
use App\Models\Category;
use App\Mail\MassMailing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EditorController extends Controller
{
    //

    
    public function index(){
        $data = Category::all();
        return view('editor', ['data' => $data]);
    }

    public function upload(Request $request){
        if($request->hasFile('upload')) {
            //get filename with extension   
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
    
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
    
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
    
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
    
            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);
            $request->file('upload')->storeAs('public/uploads/thumbnail', $filenametostore);
    
            //Resize image here
            $thumbnailpath = public_path('storage/uploads/thumbnail/'.$filenametostore);
            $img = Image::make($thumbnailpath)->resize(500, 300, function($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);
    
            echo json_encode([
                'default' => asset('storage/uploads/'.$filenametostore),
                '500' => asset('storage/uploads/thumbnail/'.$filenametostore)
            ]);
        }
    }

    public function sendMail(Request $request){
        $subject    = $request->input('subject');
        $body       = $request->input('editor');
        $cat        = $request->input('cat');
        $data       = Contact::where('category_id', $cat)->get();
        foreach($data as $item){
            Mail::to($item->emails)->later(now()->addMinutes(5), new MassMailing($subject, $body)); 
        }
        // Mail::to('workizzy89@gmail.com')->send(new MassMailing($name, $subject, $body));     
        return redirect('sendmail');
    }
}
