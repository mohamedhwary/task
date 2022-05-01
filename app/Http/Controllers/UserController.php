<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        return view('user');
    }

    public function getusers(Request $request)
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
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
        ->where('name', 'like', '%' .$searchValue . '%')
        ->select('*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $id = $record->id;
            $name = $record->name;
            $email = $record->email;
           

            $data_arr[] = array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "actions" => "<button  data-id='".$id."' class='btn' onclick='updateUser({$id})' ><i class='fa fa-edit' aria-hidden='true'></i></button>
            <button  data-id='".$id."' class='btn ' onclick='deleteUser({$id})'><i class='fa fa-trash' aria-hidden='true'></i>
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
        return view('createUser');
    }

    public function getUser(Request $request)
    {

        $id = $request->id;
        $user = User::find($id);

        return $user;
    }

    public function updateUser(Request $request)
    {
        $id = $request->userId;

        $user = User::where('id', $id)
                            ->update([
                                'name'=>$request->name,
                                'email'=>$request->email,

                            ]);
                           

        return back()->with('success', 'User Updated!');
    }

    public function deleteUser(Request $request)
    {
        $id = $request->userId;

        $user = User::find($id);
        $user->delete();
                           

        return back()->with('success', 'User Delete!');
    }

    public function newUser(Request $request)
    {
        $request->validate([
            'user' => 'required|min:3|max:255',
            'email'=> 'unique:App\User,email',
            'password' => ['required', 'string', 'min:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/']
           
        ],
        [
            'regex' => 'password must be at least 8 characters long contain a 
            number and anuppercase letter.',
        ]);
        
        $user = User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),

        ]);
                           

        return redirect()->back()->with('success','User created successfully');
    }
}

