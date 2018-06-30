<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlanoAPIRequest;
use App\Http\Requests\API\UpdatePlanoAPIRequest;
use App\Models\Plano;
use App\Repositories\PlanoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PlanoController
 * @package App\Http\Controllers\API
 */

class PlanoAPIController extends AppBaseController
{
    /** @var  PlanoRepository */
    private $planoRepository;

    public function __construct(PlanoRepository $planoRepo)
    {
        $this->planoRepository = $planoRepo;
    }

    /**
     * Display a listing of the Plano.
     * GET|HEAD /planos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->planoRepository->pushCriteria(new RequestCriteria($request));
        $this->planoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $planos = $this->planoRepository->all();

        return $this->sendResponse($planos->toArray(), 'Planos retrieved successfully');
    }

    /**
     * Store a newly created Plano in storage.
     * POST /planos
     *
     * @param CreatePlanoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanoAPIRequest $request)
    {
        $input = $request->all();

        $planos = $this->planoRepository->create($input);

        return $this->sendResponse($planos->toArray(), 'Plano saved successfully');
    }

    /**
     * Display the specified Plano.
     * GET|HEAD /planos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Plano $plano */
        $plano = $this->planoRepository->findWithoutFail($id);

        if (empty($plano)) {
            return $this->sendError('Plano not found');
        }

        return $this->sendResponse($plano->toArray(), 'Plano retrieved successfully');
    }

    /**
     * Update the specified Plano in storage.
     * PUT/PATCH /planos/{id}
     *
     * @param  int $id
     * @param UpdatePlanoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Plano $plano */
        $plano = $this->planoRepository->findWithoutFail($id);

        if (empty($plano)) {
            return $this->sendError('Plano not found');
        }

        $plano = $this->planoRepository->update($input, $id);

        return $this->sendResponse($plano->toArray(), 'Plano updated successfully');
    }

    /**
     * Remove the specified Plano from storage.
     * DELETE /planos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Plano $plano */
        $plano = $this->planoRepository->findWithoutFail($id);

        if (empty($plano)) {
            return $this->sendError('Plano not found');
        }

        $plano->delete();

        return $this->sendResponse($id, 'Plano deleted successfully');
    }
}
