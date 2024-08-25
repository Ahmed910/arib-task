<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'salary',
        'image',
        'manager_id',
        'department_id'
    ];


    public function manager()
    {
        return $this->belongsTo(self::class, 'manager_id');
    }

    public function department()
    {
        return $this->belongsTo(self::class, 'department_id');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "$this->first_name $this->last_name",
        );
    }

    public function setImageAttribute(?UploadedFile $image = null)
    {
        if ($image) {
            $filename = uploadImage($image, 'employees');

            $this->attributes['image'] = $filename;
        }
    }
}
