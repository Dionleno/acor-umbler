<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServicoAPIRequest;
use App\Http\Requests\API\UpdateServicoAPIRequest;
use App\Models\Servico;
use App\Repositories\ServicoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ServicoController
 * @package App\Http\Controllers\API
 */

class ServicoAPIController extends AppBaseController
{
    /** @var  ServicoRepository */
    private $servicoRepository;

    public function __construct(ServicoRepository $servicoRepo)
    {
        $this->servicoRepository = $servicoRepo;
    }

    /**
     * Display a listing of the Servico.
     * GET|HEAD /servicos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->servicoRepository->pushCriteria(new RequestCriteria($request));
        $this->servicoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $servicos = $this->servicoRepository->all();

        return $this->sendResponse($servicos->toArray(), 'Servicos retrieved successfully');
    }

    /**
     * Store a newly created Servico in storage.
     * POST /servicos
     *
     * @param CreateServicoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateServicoAPIRequest $request)
    {
        $input = $request->all();

        $servicos = $this->servicoRepository->create($input);

        return $this->sendResponse($servicos->toArray(), 'Servico saved successfully');
    }

    /**
     * Display the specified Servico.
     * GET|HEAD /servicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Servico $servico */
        $servico = $this->servicoRepository->findWithoutFail($id);

        if (empty($servico)) {
            return $this->sendError('Servico not found');
        }

        return $this->sendResponse($servico->toArray(), 'Servico retrieved successfully');
    }

    /**
     * Update the specified Servico in storage.
     * PUT/PATCH /servicos/{id}
     *
     * @param  int $id
     * @param UpdateServicoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServicoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Servico $servico */
        $servico = $this->servicoRepository->findWithoutFail($id);

        if (empty($servico)) {
            return $this->sendError('Servico not found');
        }

        $servico = $this->servicoRepository->update($input, $id);

        return $this->sendResponse($servico->toArray(), 'Servico updated successfully');
    }

    /**
     * Remove the specified Servico from storage.
     * DELETE /servicos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Servico $servico */
        $servico = $this->servicoRepository->findWithoutFail($id);

        if (empty($servico)) {
            return $this->sendError('Servico not found');
        }

        $servico->delete();

        return $this->sendResponse($id, 'Servico deleted successfully');
    }
}
