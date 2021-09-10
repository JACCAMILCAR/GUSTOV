<?php
namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $month = $request->month +1;
            $menu = DB::select('select r.id, r.date, r.nameCostumer, s.quantity, m.name, m.price
                                from receipts r, sales_receipts sr, sales s, menus_sales ms, menus m
                                where DAY(r.date) = '."$request->day".'&& MONTH(r.date) = '."$month".' && YEAR(r.date) ='."$request->year".'&& r.id = sr.receipt_id && sr.sale_id = s.id && s.id = ms.sale_id && ms.menu_id = m.id'
                            );
            return $menu;
        }
        return view('reports.index');
    }
}