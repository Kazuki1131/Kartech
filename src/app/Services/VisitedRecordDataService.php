<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\{VisitedRecord, Photo};
use Auth;

final class VisitedRecordDataService
{
    /**
     * @ver bool
     */
    private $visitedRecordExist;

    /**
     * @ver int
     */
    private $visitedRecordPrimaryId;

    /**
     * @property int $request
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getVisitedRecords(int $request)
    {
        $this->visitedRecordExist = VisitedRecord::where([
            ['user_id', Auth::id()],
            ['customer_id', $request]
        ])->exists();

        if ($this->visitedRecordExist) {
            $this->visitedRecordPrimaryId = VisitedRecord::where([
                ['user_id', Auth::id()],
                ['customer_id', $request]
            ])->pluck('id');

            return VisitedRecord::where([
                ['user_id', Auth::id()],
                ['customer_id', $request]
            ])->paginate(5);
        }
        return null;

    }

    /**
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getImagePaths()
    {
        if ($this->visitedRecordExist) {
            foreach ($this->visitedRecordPrimaryId as $id){
                $ImagePaths[$id] = Photo::where('record_id', $id)->pluck('image_path');
            }
            return $ImagePaths;
        }
    }
}
