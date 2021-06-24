<?php
namespace App\Repositories;

use App\Admin\Facility;
use App\Repositories\Interfaces\FacilityRepositoryInterface;

class FacilityRepository implements FacilityRepositoryInterface
{
    public function get_facility($type = false)
    {
        if ($type) {
            $facility = Facility::where('status', 1)->where('facilitytype', $type)->get();
            if (!empty($facility)) {
                foreach ($facility as $fc) {
                    if ($fc->image != '') {
                        $fc->image = asset('/storage/uploads/facilityimage/' . $fc->image);
                    }
                }
            }

            return $facility;
        }
        return false;
    }
}
