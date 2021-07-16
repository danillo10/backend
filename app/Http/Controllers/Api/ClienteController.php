<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Plano;
use Illuminate\Validation\ValidationException;
use App\Models\TypeUser;
use App\Http\Controllers\Auth\Helpers\Util;
use App\Http\Controllers\Helpers\Utils;
use Symfony\Contracts\Service\Attribute\Required;

class ClienteController extends Controller
{

    private $types = [
        TypeUser::ADMIN
    ];

    public function __construct()
    {
        $this->middleware(Util::buildRoles($this->types));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return Utils::buildReturnSuccessStatement(Cliente::all());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
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
        try {
            $request->validate([
                'nome' => 'required|max:191',
                'email' => 'required|unique:clientes',
                'telefone' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'data_nascimento' => 'required'
            ]);

            $cliente = Cliente::create($request->all());

            return Utils::buildReturnSuccessStatement($cliente);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Utils::buildReturnSuccessStatement(Cliente::find($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
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
        try {
            $request->validate([
                'nome' => 'required|max:191',
                'email' => 'required',
                'telefone' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'data_nascimento' => 'required'
            ]);

            $client = Cliente::find($id);
            $client->update($request->all());

            return Utils::buildReturnSuccessStatement($client);
        } catch (ValidationException $e) {
            return Utils::buildReturnErrorStatement($e->errors());
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
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
        try {
            $cliente = Cliente::find($id);
            $plano = Plano::getPlanoNome($cliente->plano_id);

            if($cliente->estado == 'SP' && $plano == 'Free'){
                return Utils::buildReturnCustomerSpFree();
            }

            return Utils::buildReturnSuccessStatement(Cliente::destroy($id));
        } catch (\Exception $e) {
            return Utils::buildReturnErrorStatement($e->getMessage());
        }
    }
}
