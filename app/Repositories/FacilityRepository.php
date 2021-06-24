<?php
namespace App\Repositories;

use App\Admin\Facility;
use App\Repositories\Interfaces\FacilityRepositoryInterface;

class FacilityRepository implements FacilityRepositoryInterface
{
    public function get_facility($type = false)
    {
        if($type){
            $facility = Facility::where('status',1)->where('facilitytype', $type)->get();
            dd($facility);
            if($facility->image != ''){
                $facility->image = asset('/storage/uploads/facilityimage/' . $facility->image);
            }
            return $facility;
        }
        return false;
    }
}
