<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',["data"=>$data])
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.add-user',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles_name' => 'required',
            'Avatar' => 'mimes:jpeg,png,jpg',
        ]);

          $input = $request->all();
          $input['password'] = Hash::make($input['password']);
            if (empty($input['Avatar'])) {
                $input['Avatar'] = 'avatar.png';
            }else{
                $input['Avatar'] = $imageName = time().'.'.$request->Avatar->extension();
                $request->Avatar->move(public_path('assets/avatar'), $imageName);
            }
         $user = User::create($input);
         $user->assignRole($request->input('roles'));
        session()->flash('add-user');
        return redirect()->route('users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show-user',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit-user',compact('user','roles','userRole'));
    }


    public function editUserAuth($id)
    {
        $user = User::find($id);

        return view('users.edit-user-auth',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fileAvatar = User::where('id', $id)->first();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required',
        ]);
        $input = $request->all();
        $user = User::find($id);
        if (empty($input['Avatar'])) {
            $input['Avatar'] = $fileAvatar->Avatar ;
        }else{
            $input['Avatar'] = $imageName = time().'.'.$request->Avatar->extension();
            $request->Avatar->move(public_path('assets/avatar'), $imageName);
        }
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        session()->flash('update-user');
        return redirect()->route('users.index');
    }




    public function updateUserAuth(Request $request)
    {
        $id = $request->id;
        $fileAvatar = User::where('id', $request->id)->first();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|'
        ]);
        $input = $request->all();
        $user = User::find($request->id);
        if (empty($input['Avatar'])) {
            $input['Avatar'] = $fileAvatar->Avatar ;
        }else{
            $input['Avatar'] = $imageName = time().'.'.$request->Avatar->extension();
            $request->Avatar->move(public_path('assets/avatar'), $imageName);
        }
        $user->update($input);
        session()->flash('update-user');
        return redirect()->route('home');
    }
    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'same:confirm-password',
        ]);
        $update=[
            'password' => Hash::make($request->password),
        ];
        User::where("id",$request->id)->update($update);
            return response()->json([
                'status' => true
                
             ]);
    }


 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $id = $request->id;

        User::find($id)->delete();
        session()->flash('delete-user');
        return redirect()->route('users.index');
    }


}
