<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBeneficioAPIRequest;
use App\Http\Requests\API\UpdateBeneficioAPIRequest;
use App\Models\Beneficio;
use App\Repositories\BeneficioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BeneficioController
 * @package App\Http\Controllers\API
 */

class BeneficioAPIController extends AppBaseController
{
    /** @var  BeneficioRepository */
    private $beneficioRepository;

    public function __construct(BeneficioRepository $beneficioRepo)
    {
        $this->beneficioRepository = $beneficioRepo;
    }

    /**
     * Display a listing of the Beneficio.
     * GET|HEAD /beneficios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->beneficioRepository->pushCriteria(new RequestCriteria($request));
        $this->beneficioRepository->pushCriteria(new LimitOffsetCriteria($request));
        $beneficios = $this->beneficioRepository->all();

        return $this->sendResponse($beneficios->toArray(), 'Beneficios retrieved successfully');
    }

    /**
     * Store a newly created Beneficio in storage.
     * POST /beneficios
     *
     * @param CreateBeneficioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBeneficioAPIRequest $request)
    {
        $input = $request->all();

        $beneficios = $this->beneficioRepository->create($input);

        return $this->sendResponse($beneficios->toArray(), 'Beneficio saved successfully');
    }

    /**
     * Display the specified Beneficio.
     * GET|HEAD /beneficios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Beneficio $beneficio */
        $beneficio = $this->beneficioRepository->findWithoutFail($id);

        if (empty($beneficio)) {
            return $this->sendError('Beneficio not found');
        }

        return $this->sendResponse($beneficio->toArray(), 'Beneficio retrieved successfully');
    }

    /**
     * Update the specified Beneficio in storage.
     * PUT/PATCH /beneficios/{id}
     *
     * @param  int $id
     * @param UpdateBeneficioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBeneficioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Beneficio $beneficio */
        $beneficio = $this->beneficioRepository->findWithoutFail($id);

        if (empty($beneficio)) {
            return $this->sendError('Beneficio not found');
        }

        $beneficio = $this->beneficioRepository->update($input, $id);

        return $this->sendResponse($beneficio->toArray(), 'Beneficio updated successfully');
    }

    /**
     * Remove the specified Beneficio from storage.
     * DELETE /beneficios/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Beneficio $beneficio */
        $beneficio = $this->beneficioRepository->findWithoutFail($id);

        if (empty($beneficio)) {
            return $this->sendError('Beneficio not found');
        }

        $beneficio->delete();

        return $this->sendResponse($id, 'Beneficio deleted successfully');
    }
}
