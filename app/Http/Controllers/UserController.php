<?php

namespace App\Http\Controllers;


use App\Models\{User,Detail,Category};
use Illuminate\Http\Request;
use App\Services\UserService;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = $this->userService->listCategories();
    
                return DataTables::of($query)
                    ->addColumn('name', function ($row) {
                        return $row->name ?? 'None';
                    })
                    ->addColumn('email', function ($row) {
                        return $row->email == 1 ? 'Enabled' : 'Disabled';
                    })
                    ->addColumn('mobile', function ($row) {
                        return $row->fullPath();
                    })
                    ->addColumn('address', function ($row) {
                        return $row->fullPath();
                    })
                    ->addColumn('action', function ($row) {
                        $edit = '<a href="' . route('users.edit', $row->id) . '" class="edit-icon">Edit</a>';
                        $delete = '<form action="' . route('users.destroy', $row->id) . '" method="POST" style="display:inline;">'
                            . csrf_field()
                            . method_field('DELETE')
                            . '<button type="submit">Delete</button></form>';
                        return $edit . ' ' . $delete;
                    })
                    ->addColumn('created_at', function ($user) {
                        return Carbon::parse($user->created_at)->format('d M Y, h:i A');
                    })
                    ->addColumn('updated_at', function ($user) {
                        return Carbon::parse($user->updated_at)->format('d M Y, h:i A');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            
    
            return view('users.index');
        }


    }

    public function create()
    {
        $users= User::all();
        return view('users.create', compact('users'));
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'firstname'    => 'required|string|max:255',
                'middlename'   => 'nullable|string|max:255',
                'lastname'     => 'required|string|max:255',
                'email'        => 'required|email|unique:users,email', 
                'mobile'       => 'nullable|string|max:10',
                'address'      => 'nullable|string|max:255',
                'prefixname'   => 'nullable|string|max:10',
                'photo'        => 'nullable|string',
                'password'     => 'required|string|min:8'
            ]);
    
            $validated['password'] = bcrypt($validated['password']);
            $user = User::create($validated);
    
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); 
        }
    }
    
    
}