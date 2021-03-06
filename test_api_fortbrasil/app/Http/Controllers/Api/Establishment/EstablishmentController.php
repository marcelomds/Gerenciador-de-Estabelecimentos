<?php

namespace App\Http\Controllers\Api\Establishment;

use App\Http\Controllers\Controller;
use App\Models\Establishment\Establishment;
use App\Repositories\Establishment\EstablishmentRepository;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{

    /**
     * @var EstablishmentRepository
     */
    private $repository;

    public function __construct(EstablishmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * Listar Todos os Estabelecimentos
     */
    public function index()
    {
        try {
            $establishments = $this->repository->all();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao listar estabelecimentos'], 400);
        }

        return response()->json($establishments, 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * Cadastrar Novo Estabelecimento
     */
    public function store(Request $request)
    {
        try {
            $establishment = $this->repository->store($request->all());
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar estabelecimento'], 400);
        }

        return response()->json([
            'success' => 'Estabelecimento cadastrado com sucesso',
            'establishment' => $establishment
        ], 201);
    }

    /**
     * @param Establishment $establishment
     * @return \Illuminate\Http\JsonResponse
     *
     * Mostrar dados do Estabelecimento
     */
    public function show(Establishment $establishment)
    {
        return response()->json($establishment);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Atualização de Estabelecimento
     */
    public function update(Request $request, $id)
    {
        try {
            $establishment = $this->repository->updateEstablishment($request->all(), $id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar estabelecimento'], 400);
        }

        return response()->json([
            'success' => 'Estabelecimento Atualizado com sucesso',
            'establishment' => $establishment
        ], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     *
     * Deletar Estabelecimento
     */
    public function destroy($id)
    {
        try {
            $establishment = $this->repository->deleteEstablishment($id);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir estabelecimento'], 400);
        }

        return response()->json(['success' => 'Estabelecimento excluido com sucesso'], 200);
    }
}
