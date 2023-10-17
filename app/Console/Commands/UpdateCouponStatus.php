<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateCouponStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupon:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update coupon statuses based on start and end dates';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now=Carbon::now()->format('Y-m-d H:i:s');
        $coupons = Coupon::where('status','!=','expired')->with('discounttimeline')->get();
        foreach ($coupons as $coupon) {
            $start=$coupon->discounttimeline->start;
            $end=$coupon->discounttimeline->end;
            
            if($start > $now){
                $coupon->status = 'pending';
            }elseif($start <= $now && $end > $now){
                $coupon->status = 'active';
            }elseif($end <=$now){
                $coupon->status = 'expired';
            }
            $coupon->save();
        }
    }
}
