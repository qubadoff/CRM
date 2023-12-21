<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $table = 'employees';

    protected $fillable = [
        'compartment_id',
        'department_id',
        'position_id',
        'geometric_card_number', //nullable
        'full_name',
        'father_name',
        'id_number',
        'id_pin_number',
        'birthday',
        'sex',
        'location',
        'other_information', //nullable
        'email',  //nullable
        'phone',
        'education', //nullable
        'school_name',  //nullable
        'experience',  //nullable
        'job_type',
        'work_time',
        'hired_date',
        'start_time',
        'end_time',
        'reference',  //nullable
    ];

    protected $guarded = [];

    protected $casts = [];

    protected $dates = [
        'deleted_at'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user_photo');
        $this->addMediaCollection('user_documents');
    }

    /**
     * Get the URL of the first media item in the specified collection.
     *
     * @param int    $employeeId
     * @param string $collectionName
     * @return string|null
     */
    public static function getFirstMediaUrl($employeeId, string $collectionName = 'user_photos'): ?string
    {
        $employeeId = (int) $employeeId;

        $employee = self::find($employeeId);

        if (!$employee) {
            return null;
        }

        $media = $employee->getFirstMedia($collectionName);

        return $media ? $media->getUrl() : null;
    }
}
