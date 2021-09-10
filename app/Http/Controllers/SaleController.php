<?php
namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Receipt;
use App\Models\Menu;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SaleController extends Controller
{
    public function index()
    {
        $sales = Receipt::orderBy('date','desc')->get();
        return view('sales.index',compact('sales'));
    }
    public function create(Request $request)
    {
        if($request->ajax()){
            $menu = Menu::where('id',$request->menu_id)->first();
            $price = $menu->price;
            return $price;
        }
        $menus = DB::select('select * from menus where state = 1');
        return view('sales.create',compact('menus'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nameCostumer' => 'required|max:200',
        ]);
        $date = new DateTime();
        $idUser = Auth::user()->id;
        $value = "ASPRA";
        $idReceipt = DB::select('select id from receipts ORDER BY id desc limit 1');
        if($idReceipt==null){
            $aux = 1;
        }else{
            $aux = $idReceipt[0]->id + 1;
        }
        $total = 0.0;
        $subTotal = 0.0;
        $limit = count($request->id_articulo);
        $receipt = new Receipt;
        $receipt->userId = $idUser;
        $receipt->nameCostumer = $request->nameCostumer;
        $receipt->nit = $request->nit;
        $receipt->phoneCostumer = $request->phoneCostumer;
        for($i=0 ; $i < $limit; $i++){
            $sales = new Sale;
            $sales->quantity = $request->quantity[$i];
            $sales->description = $request->description[$i];
            $sales->save();
            $price = DB::select('select price from menus where id ='.$request->id_articulo[$i]);
            $subTotal = $request->quantity[$i] * $price[0]->price;
            $total = $subTotal + $total;
            $sales->menus()->attach($request->id_articulo[$i]);
            $sales->save();
        }
        $receipt->date = $date->format('Y-m-d');
        $receipt->controlCode = str_replace('A', $aux, $value);
        $receipt->save();
        $idSalesLimit = DB::select('select id from sales ORDER BY id desc limit '.$limit);
        for($i= $limit-1 ; $i >=0 ; $i--){
            $receipt->sales()->attach($idSalesLimit[$i]);
            $receipt->save();
        }
        return redirect('/sales');
    }
    public function show(Sale $sale)
    {
        $id = $sale->id;
        $sales = DB::select('select r.id as idReceipt, r.date, r.nameCostumer, r.nit, r.phoneCostumer, r.controlCode,
         s.id as idSale, s.quantity, s.description, m.id as idMenu, m.name, m.price, m.description as descriptionMenu, m.state
        from menus m, menus_sales ms, sales s, sales_receipts sr, receipts r
        where m.id = ms.menu_id
        and ms.sale_id = s.id
        and s.id = sr.sale_id
        and sr.receipt_id = r.id
        and r.id ='.$id);
        return view('sales.show',compact('sales','id'));
    }
    public function edit(Sale $sale)
    {
        $id = $sale->id;
        $sales = DB::select('select r.id as idReceipt, r.date, r.nameCostumer, r.nit, r.phoneCostumer, r.controlCode,
        s.id as idSale, s.quantity, s.description, m.id as idMenu, m.name, m.price, m.state
        from menus m, menus_sales ms, sales s, sales_receipts sr, receipts r
        where m.id = ms.menu_id
        and ms.sale_id = s.id
        and s.id = sr.sale_id
        and sr.receipt_id = r.id
        and r.id ='.$id);
        $menus = DB::select('select * from menus where state = 1');
        return view('sales.edit',compact('sales','id','menus'));
    }
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'nameCostumer' => 'required|max:255',
        ]);
        $idReceipt = $request->receiptGustov;
        $iduser = Auth::user()->id;
        $total = 0.0;
        $subTotal = 0.0;
        $aux=0.0;
        $limitNewSale=0;
        $equalize = [];
        $limit = count($request->id_articulo);
        $quantitySold = 0.0;
        $dataExists = DB::select('select s.id as idSale, s.quantity as quantitySale
                                from menus m, menus_sales ms, sales s, sales_receipts sr, receipts r
                                where r.id = '.$idReceipt.'
                                and r.id = sr.receipt_id
                                and sr.sale_id = s.id
                                and s.id = ms.sale_id
                                and ms.menu_id = m.id');
        for($i=0 ; $i < $limit; $i++){
            $saleExists = DB::select('select s.id as idSale, s.quantity as quantitySale
                                from menus m, menus_sales ms, sales s, sales_receipts sr, receipts r
                                where r.id = '.$idReceipt.'
                                and r.id = sr.receipt_id
                                and sr.sale_id = s.id
                                and s.id = ms.sale_id
                                and ms.menu_id = m.id
                                and m.id = '.$request->id_articulo[$i]
                            );
            $quantitySold = $request->quantity[$i];
            if($saleExists==null){
                $sales = new Sale;
                $sales->quantity = $quantitySold;
                $sales->description = $request->description[$i];
                $price = DB::select('select price from menus where id ='.$request->id_articulo[$i]);
                $subTotal = $quantitySold * $price[0]->price;
                $total = $subTotal + $total;
                $sales->save();
                $sales->menus()->attach($request->id_articulo[$i]);
                $sales->save();
                $limitNewSale++;
            }else {
                DB::update('update sales 
                            set quantity = '.$quantitySold.',
                            description = "'.$request->description[$i].'"
                            where id = '.$saleExists[0]->idSale);
                $price = DB::select('select price from menus where id ='.$request->id_articulo[$i]);
                $subTotal = $quantitySold * $price[0]->price;
                $total = $subTotal + $total;
            }
        }
        $idSales = DB::select('select id from sales ORDER BY id desc limit '.$limitNewSale);
        $receipt = Receipt::findOrFail($idReceipt);
        if($limitNewSale>0){
            for($i= $limitNewSale-1 ; $i >=0 ; $i--){
                $receipt->sales()->attach($idSales[$i]);
                $receipt->save();    
            }
        }
        DB::update('update receipts
                    set userId = '.$idUser.',
                    nameCostumer = "'.$request->nameCostumer.'",
                    nit = "'.$request->nit.'",
                    phoneCostumer = "'.$request->phoneCostumer.'"
                    where id = '.$idReceipt
        );
        return redirect('/sales');
    }
    public function destroy(Sale $sale)
    {
        $id = $sale->id;
        $listSales = DB::select('select s.id as idSales, s.quantity
                                    from receipts r, sales_receipts sr, sales s
                                    where r.id ='.$id.'
                                    and r.id = sr.receipt_id
                                    and sr.sale_id = s.id
                                    ');
        Receipt::destroy($id);
        for($i = 0; $i < count($listSales); $i++){
            $idMenu = DB::select('select m.id as idMenu
                                    from menus m, menus_sales ms, sales s
                                    where s.id = '.$listSales[$i]->idSales.'
                                    and s.id = ms.sale_id
                                    and ms.menu_id = m.id
                                    ');
            // $menu = $idMenu[0]->idMenu;
            Sale::destroy($listSales[$i]->idSales);
        }
        return redirect('/sales');
    }
}