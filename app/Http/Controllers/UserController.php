<?php

namespace App\Http\Controllers;

use Event;
use App\Models\User;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserRessource;
use App\Http\Resources\EventRessource;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'data' => $users
        ], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request){
        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'roles' => $request->roles
        ]);
        return response()->json([
            'success' => true,
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'utilisateur introvable'
            ], 404);
        }
        return response()->json([
            'success'=>true,
            'data'=>$user,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'utilisateur introvable'
            ], 404);
        }
        $datas = $request->all();
        if(isset($datas['password'])){
            $datas['password'] = bcrypt($datas['password']);
        }
        $user->update($datas);
        return response()->json([
            'success' => true,
            'message' => 'utilisateur modifie'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'utilisateur introvable'
            ], 404);
        }
        if ($user->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'utilisateur supprime'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'utilisateur non supprime'
        ], 500);
    }

    public function getEventsByUser($userId){
        $Events = Events::where('user_id', $userId)->get();
        return response()->json([
            'status'=> Response::HTTP_OK,
            'message' => 'liste des evenements de l\'utilisateur',
            'success' => true,
            'data' => EventRessource::collection($Events)
        ]);

    }
}
