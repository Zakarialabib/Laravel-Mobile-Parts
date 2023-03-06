<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\UuidGenerator;
use App\Traits\GetModelByUuid;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use UuidGenerator;
    use GetModelByUuid;

    const ATTRIBUTES = [
        'id',
        'brand_id',
        'name',
        'slug',
        'image',
        'status',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $orderable = self::ATTRIBUTES;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $filterable = self::ATTRIBUTES;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
        'brand_id',
    ];
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
