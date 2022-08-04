<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessContactUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $file;
    public $category_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file, string $category_id)
    {
        //
        $this->file = $file;
        $this->category_id = $category_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Redis::throttle('upload-csv')->allow(1)->every(10)->block(60)->then(function(){
            $data = array_map('str_getcsv', file($this->file));
            foreach($data as $row){
                DB::insert('insert into contacts (category_id, emails) values (?, ?)', [$this->category_id, $row[0]]);
            }
            unlink($this->file);

        }, function (){
            return $this->release(10);
        });         
    }
}
