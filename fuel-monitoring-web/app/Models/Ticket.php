<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'lo_number',
        'spbu_number',
        'ship_to',
        'quantity',
        'product_type',
        'distance_km',
        'status',
        'driver_id',
        'driver_name',
        'karnet_number',
        'taken_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'distance_km' => 'decimal:2',
            'taken_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function driver()
    {
        return $this->belongsTo(User::class , 'driver_id');
    }

    public function deliveryPhotos()
    {
        return $this->hasMany(DeliveryPhoto::class);
    }

    public function checkinPhotos()
    {
        return $this->hasMany(DeliveryPhoto::class)->where('photo_type', 'checkin');
    }

    public function checkoutPhotos()
    {
        return $this->hasMany(DeliveryPhoto::class)->where('photo_type', 'checkout');
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
