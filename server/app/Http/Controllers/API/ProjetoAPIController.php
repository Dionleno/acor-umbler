<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProjetoAPIRequest;
use App\Http\Requests\API\UpdateProjetoAPIRequest;
use App\Models\Projeto;
use App\Repositories\ProjetoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProjetoController
 * @package App\Http\Controllers\API
 */

class ProjetoAPIController extends AppBaseController
{
    /** @var  ProjetoRepository */
    private $projetoRepository;

    public function __construct(ProjetoRepository $projetoRepo)
    {
        $this->projetoRepository = $projetoRepo;
    }

    /**
     * Display a listing of the Projeto.
     * GET|HEAD /projetos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->projetoRepository->pushCriteria(new RequestCriteria($request));
        $this->projetoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $projetos = $this->projetoRepository->all();

        return $this->sendResponse($projetos->toArray(), 'Projetos retrieved successfully');
    }

    /**
     * Store a newly created Projeto in storage.
     * POST /projetos
     *
     * @param CreateProjetoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProjetoAPIRequest $request)
    {
        $input = $request->all();

        $projetos = $this->projetoRepository->create($input);

        return $this->sendResponse($projetos->toArray(), 'Projeto saved successfully');
    }

    /**
     * Display the specified Projeto.
     * GET|HEAD /projetos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Projeto $projeto */
        $projeto = $this->projetoRepository->findWithoutFail($id);

        if (empty($projeto)) {
            return $this->sendError('Projeto not found');
        }

        return $this->sendResponse($projeto->toArray(), 'Projeto retrieved successfully');
    }

    /**
     * Update the specified Projeto in storage.
     * PUT/PATCH /projetos/{id}
     *
     * @param  int $id
     * @param UpdateProjetoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjetoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Projeto $projeto */
        $projeto = $this->projetoRepository->findWithoutFail($id);

        if (empty($projeto)) {
            return $this->sendError('Projeto not found');
        }

        $projeto = $this->projetoRepository->update($input, $id);

        return $this->sendResponse($projeto->toArray(), 'Projeto updated successfully');
    }

    /**
     * Remove the specified Projeto from storage.
     * DELETE /projetos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Projeto $projeto */
        $projeto = $this->projetoRepository->findWithoutFail($id);

        if (empty($projeto)) {
            return $this->sendError('Projeto not found');
        }

        $projeto->delete();

        return $this->sendResponse($id, 'Projeto deleted successfully');
    }
}
