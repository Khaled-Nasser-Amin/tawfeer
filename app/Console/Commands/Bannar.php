<?php

namespace App\Console\Commands;

use App\Models\Banner;
use Illuminate\Console\Command;

class Bannar extends Command
{

    protected $signature = 'banner:check';


    protected $description = 'check for expired banners';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $currentDate=now();
        $banners=Banner::whereDate('expire_at','<=',$currentDate)->where('expire_at','!=',null)->where('expire_at','!=','')->get();
        foreach ($banners as $banner){
            if(date('y-m-d H:i:s',strtotime($banner->expire_at)) < date('y-m-d H:i:s',strtotime($currentDate))) {
                unlink(storage_path('app\public\banners\\').$banner->getAttributes()['image']);
                $banner->delete();
            }
        }
        return 0;
    }
}
