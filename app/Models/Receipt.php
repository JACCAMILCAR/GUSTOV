<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Receipt extends Model
{
    //relation * - *
    public function sales(){
        return $this->belongsToMany(Sale::class, 'sales_receipts');
    }
}
