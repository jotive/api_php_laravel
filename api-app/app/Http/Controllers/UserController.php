<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    private function cargarArchivo($file){
        $nameFile = $file->getClientOriginalName();
        $file->move(public_path('imgs') , $nameFile );
        return $nameFile;
    }
    
    public function login(Request $request){
        
        if ($request->header('Content-Type') == 'application/json'){
            $user = User::whereEmail($request->email)->first();
            if( ! is_null($user) && Hash::check($request->password, $user->password)  ){
                $user->api_token = Str::random(100);
                $user->save();
                
                return response()->json([
                    'id'=>$user->id,
                    'first_name'=>$user->first_name,
                    'last_name'=>$user->last_name,
                    'email'=>$user->email,
                    'token'=>$user->api_token,
                    'age'=>$user->age,
                    'image'=>$user->image,
                    'description'=>$user->description
                ], 200);
            }else{
                return response()->json([
                    'error'=>'Error in user o password'
                ], 401);
            }
        }else{
            return response()->json([
                'error'=>'',
            ], 403);
        }

        
    }

    public function logout(){
        $user = auth()->user();
        $user->api_token = null;
        $user->save();

        return response()->json([
            'res'=>true,
            'token'=>$user->api_token,
            'message'=>'Logout'
        ], 200);
    }


    // Get Listar
    public function index(Request $request)
    {
        if ($request->header('Content-Type') == 'application/json'){
            $data = json_encode( User::all() );
            return response($data, 200)
                  ->header('Content-Type', 'text/json');
        }else{
            return response()->json([
                'error'=>'error',
            ], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->header('Content-Type') == 'application/json'){
            
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            
            $user = new User;

            $user->first_name = $input['first_name'];
            $user->last_name = $input['last_name'];
            $user->email = $input['email'];
            $user->password = $input['password'];
            $user->age = $input['age'];
            $user->image = $input['image'];
            $user->api_token = Str::random(100);

            $user->save();

            // Cuando cargue imagenes
            /*
            if($request->has('image')){
                $this->cargarArchivo($request->image);
                $input['image'] = $request->image->getClientOriginalName();
            }
            */
            return response()->json([
                'id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'token'=>$user->api_token,
                'age'=>$user->age,
                'image'=>$user->image,
                'description'=>$user->description
            ], 201);

        }else{
            return response()->json([
                'error'=>'error',
            ], 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        if ($request->header('Content-Type') == 'application/json'){
            $data = json_encode( $user );
            return response($data, 200)
                  ->header('Content-Type', 'text/json');
        }else{ 
            return response()->json([
            'error'=>'error',
        ], 403);}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->header('Content-Type') == 'application/json'){
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user->update($input);

            return response()->json([
                'id'=>$user->id,
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'token'=>$user->api_token,
                'age'=>$user->age,
                'image'=>$user->image,
                'description'=>$user->description
            ], 200);
        }else{
            return response()->json([
               'error'=>'error',
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($request->header('Content-Type') == 'application/json'){
            User::destroy($id);
        }else{
            return response()->json([
               'error'=>'error',
            ], 403);
        }
    }

    public function any(){
        $response = json_encode( ['error' => 'Not found'] );
        response($response, 200);
    }
}
