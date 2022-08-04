<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function create(Request $request){
        $request->validate([
            'file' => 'required|mimes:csv,txt',
            
        ]);

        $file = file($request->file->getRealPath());
        $data = array_slice($file, 0);
        $parts = (array_chunk($data, 200));
        foreach ($parts as $index => $part) {
            $fileName = resource_path('pending-files/'.date('y-m-d-h-i-s').$index.'.csv');
            file_put_contents($fileName, $part);
        }
        (new Contact())->importContactToDb($request->input('category_id'));
        session()->flash('status', 'queue importing');
        return redirect('dashboard');
    }

    public function createcats(Request $request){
        $data = $request->validate([
            'cats' => 'required|string'
        ]);

        Category::create([
            'category'  => $data['cats']
        ]);
        return back();
    }

    public function catdetails(){
        $data = Category::all();
        return view('dashboard', ['data' => $data]);
    }
}
