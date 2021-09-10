<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Sale extends Model
{
    //relation * - *
    public function menus(){
        return $this->belongsToMany(Menu::class, 'menus_sales');
    }
}
