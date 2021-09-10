<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('id','desc')->get();
        return view('menus.index', compact('menus'));
    }
    public function create()
    {
        return view('menus.create');
    }
    public function store(Request $request)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|unique:menus|max:40',
            'price' => 'required',
            'description' => 'required|max:250',
            'state' => 'required'
        ]);
        $menu = new Menu;
        $menu->name =$request->name;
        $menu->price =$request->price;
        $menu->description = $request->description;
        $menu->state =$request->state;
        $menu->save();
        return redirect('/menus');
    }
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }
    public function update(Request $request, Menu $menu)
    {
        //validate the fields
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'description' => 'required|max:250',
            'state' => 'required'
        ]);
        $menu->name = $request->name;
        $menu->price = $request->price;
        $menu->description = $request->description;
        $menu->state = $request->state;
        $menu->save();
        return redirect('menus');
    }
    public function destroy(Menu $menu)
    {
        $id = $menu->id;
        $menus = DB::select('select m.id as menuId, s.id as saleId
                                from sales s, menus_sales ms, menus m
                                where m.id ='.$id.'
                                and m.id = ms.menu_id
                                and ms.sale_id = s.id');
        if($menus == null){
            $menu->delete();
            return redirect('/menus');
        }else{
            return redirect('/menus')->with('Message','Error when deleting the menu, because it is linked to a sale.');
        }
        
    }
}
