<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\models\ProductCategory;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('product');
    }

    public function getProducts(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name

        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Product::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Product::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Product::orderBy($columnName,$columnSortOrder)
        ->with('users')
        ->where('name', 'like', '%' .$searchValue . '%')
        ->select('*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $description = $record->description;
            $quantity = $record->quantity;
            $price = $record->price;
            $user_id = $record->users->name;
            $updated_at	 = $record->updated_at;

            $data_arr[] = array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "quantity" => $quantity,
            "price" => $price,
            "user_id" => $user_id,
            "updated_at" =>date("d-m-Y",strtotime($updated_at)),
            "actions" => "<input type='button' value='remove quantity' data-id='".$id."' class='btn btn-danger remove_qu' onclick='removeQunt({$id})'>
            <button  data-id='".$id."' class='btn'onclick='updateProduct({$id})' ><i class='fa fa-edit' aria-hidden='true'></i></button>
            <button  data-id='".$id."' class='btn  remove_qu' onclick='deleteProduct({$id})'><i class='fa fa-trash' aria-hidden='true'></i>
            </button>",
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
        
    }
    public function create(Request $request)
    {
        $category = Category::all();
        return view('createProduct' , ['category' => $category]);
    }
    public function removeQuantity(Request $request)
    {
        $id = $request->id;
        $product = product::find($id);
        $product->decrement('quantity', 1);

        if($product->quantity == 0){
            $product->delete();
        }
        
        return $product->quantity;
    }

    public function getProduct(Request $request)
    {
        $id = $request->id;
        $product = product::find($id);

        return $product;
    }

    public function updateProduct(Request $request)
    {
        $id = $request->porductId;

        $product = product::where('id', $id)
                            ->update([
                                'name'=>$request->name,
                                'description'=>$request->desc,
                                'quantity'=>$request->qty,
                                'price'=>$request->price
                            ]);
                           

        return back()->with('success', 'Post Updated!');
    }

    public function deleteProduct(Request $request)
    {
        $id = $request->porductId;

        $product = product::find($id);
        $product->delete();
                           

        return back()->with('success', 'Product Delete!');
    }

    public function newProduct(Request $request)
    {
        
        $id = auth()->user()->id;
        $request->validate([
            'name' => 'required|min:3|max:255',
            'category' => "required|array|min:1",
            'qty'   =>'required|numeric|min:0|not_in:0',
            'price' =>"required|gt:0"
        ]);

        $product = product::create([
            'name' =>$request->name,
            'description'=>$request->desc,
            'quantity'=>$request->qty,
            'price'=>$request->price,
            'user_id'=>$id
        ]);

        $product->save();
        $lastId = $product->id;

        foreach($request->category as $id){
            $product = ProductCategory::create([
                'product_id' =>$lastId,
                'category_id'=>$id,

            ]);
            
        }
        
        
                           

        return redirect()->back()->with('success','Product created successfully');
    }
}
