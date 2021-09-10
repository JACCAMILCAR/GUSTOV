<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Menu extends Model
{
    //relation * - *
    public function sales(){
        return $this->belongsToMany(Sale::class, 'menus_sales');
    }
}
