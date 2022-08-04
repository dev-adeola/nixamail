<?php

namespace App\Models;

use App\Jobs\ProcessContactUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $category_id;
    public function importContactToDb($category_id){
        $this->category_id = $category_id;
        $path = resource_path('pending-files/*.csv');
        $files = glob($path);
        foreach($files as $file){
            ProcessContactUpload::dispatch($file, $category_id);
            
        }
    }
}
