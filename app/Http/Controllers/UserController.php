<?php

namespace App\Http\Controllers;

use App\Exceptions\TypeUserException;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use ReflectionClass;

class UserController extends Controller
{
    private $types = [
        TypeUser::ADMIN
    ];
    
    public function __construct()
    {
        $this->middleware(Util::buildRoles($this->types));
    }

    public function index() {
        try {
            return Utils::buildReturnSuccessStatement(User::all());
        } catch (\Throwable $th) {
          return Utils::buildReturnErrorStatement($th);
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required|unique:users,name',
                'email' => 'required|email:rfc,dns|unique:users,email',
                'password' => 'required',
                'role' => 'required',
            ]);
            
            $attributes = $request->all();

            $attributes['role'] = $this->isValidTypeUser($request->role);
            $attributes['password'] = Hash::make($request->password);
            
            User::create($attributes);

            return response()->json([
                'success' => true,
                'msg' => 'Usuario cadastrado com sucesso.'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->errors()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    private function isValidTypeUser($typeUser) {
        $refletionObject = new ReflectionClass(TypeUser::class);
        $constants = $refletionObject->getConstants();
        
        foreach ($constants as $constant) {
            if($constant == $typeUser){
                return $constant;
            }
        }

        throw new TypeUserException();
    }

}
