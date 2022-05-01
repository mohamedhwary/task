<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\models\ProductCategory;

class CategoryController extends Controller
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
        return view('category');
    }

    public function getCategories(Request $request)
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
        $totalRecords = Category::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Category::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Category::orderBy($columnName,$columnSortOrder)
        ->where('.name', 'like', '%' .$searchValue . '%')
        ->with('products')
        ->select('*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $assign=$record->products->count();
            
            $data_arr[] = array(
            "id" => $id,
            "name" => $name,
            "assign"=>$assign,
            "actions" => "<button  data-id='".$id."' class='btn' onclick='updateCategory({$id})' ><i class='fa fa-edit' aria-hidden='true'></i></button>
            <button  data-id='".$id."' class='btn ' onclick='deleteCategory({$id})'><i class='fa fa-trash' aria-hidden='true'></i>
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
        return view('createCategory');
    }
    public function getCategory(Request $request)
    {

        $id = $request->id;
        $category = Category::find($id);

        return $category;
    }

    public function updateCategory(Request $request)
    {
        $id = $request->categoryId;

        $category = Category::where('id', $id)
                            ->update([
                                'name'=>$request->name,
                            ]);
                           

        return back()->with('success', 'category Updated!');
    }

    public function deleteCategory(Request $request)
    {
        $id = $request->categoryId;
        $check_gategory = ProductCategory::find($id)
                            ->select('product_id')
                            ->get()
                            ->toArray();

        if(count($check_gategory) > 0 ){
            return false; 
        }else{
            $category = Category::find($id);
            $category->delete();
        }                  

        return back()->with('success', 'category Delete!');
    }

    public function newCategory(Request $request)
    {
         $request->validate([
            'category' => 'required|min:3|max:255'
        ]);
        $category = Category::create([
            'name' =>$request->category,
        ]);
                           

        return redirect()->back()->with('success','Category created successfully');
    }

}
