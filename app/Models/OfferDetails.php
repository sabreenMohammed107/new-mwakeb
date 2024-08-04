<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferDetails extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offer_details';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_details_id',
        'offer_id',
        'offer_title',
        'offer_image',
        'offer_cost',
        'total_cost',
        'created_at',
        'updated_at'
    ];


    public function offer()
    {
        return $this->belongsTo(Offer::class,'offer_id');
    }
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];



    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = true;


}
