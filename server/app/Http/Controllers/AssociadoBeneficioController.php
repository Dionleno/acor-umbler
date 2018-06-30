<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBeneficioRequest;
use App\Http\Requests\UpdateBeneficioRequest;
use App\Repositories\BeneficioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AssociadoBeneficioController extends AppBaseController
{
    /** @var  BeneficioRepository */
    private $beneficioRepository;
    private $associado = 0;

    public function __construct(BeneficioRepository $beneficioRepo)
    {
        $this->beneficioRepository = $beneficioRepo;
    }

    /**
     * Display a listing of the Beneficio.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->beneficioRepository->pushCriteria(new RequestCriteria($request));
        $beneficios = $this->beneficioRepository->findBy('tipo','0');

        return view('beneficios.index')
            ->with('beneficios', $beneficios);
    }

    /**
     * Show the form for creating a new Beneficio.
     *
     * @return Response
     */
    public function create()
    {
        return view('beneficios.create');
    }

    /**
     * Store a newly created Beneficio in storage.
     *
     * @param CreateBeneficioRequest $request
     *
     * @return Response
     */
    public function store(CreateBeneficioRequest $request)
    {
        $input = $request->all();
        $input['tipo'] = $this->associado;
        $beneficio = $this->beneficioRepository->create($input);

        Flash::success('Beneficio saved successfully.');

        return redirect(route('beneficios.index'));
    }

    /**
     * Display the specified Beneficio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $beneficio = $this->beneficioRepository->findWithoutFail($id);

        if (empty($beneficio)) {
            Flash::error('Beneficio not found');

            return redirect(route('beneficios.index'));
        }

        return view('beneficios.show')->with('beneficio', $beneficio);
    }

    /**
     * Show the form for editing the specified Beneficio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $beneficio = $this->beneficioRepository->findWithoutFail($id);

        if (empty($beneficio)) {
            Flash::error('Beneficio not found');

            return redirect(route('beneficios.index'));
        }

        return view('beneficios.edit')->with('beneficio', $beneficio);
    }

    /**
     * Update the specified Beneficio in storage.
     *
     * @param  int              $id
     * @param UpdateBeneficioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBeneficioRequest $request)
    {
        $beneficio = $this->beneficioRepository->findWithoutFail($id);

        if (empty($beneficio)) {
            Flash::error('Beneficio not found');

            return redirect(route('beneficios.index'));
        }

        $beneficio = $this->beneficioRepository->update($request->all(), $id);

        Flash::success('Beneficio updated successfully.');

        return redirect(route('beneficios.index'));
    }

    /**
     * Remove the specified Beneficio from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $beneficio = $this->beneficioRepository->findWithoutFail($id);

        if (empty($beneficio)) {
            Flash::error('Beneficio not found');

            return redirect(route('beneficios.index'));
        }

        $this->beneficioRepository->delete($id);

        Flash::success('Beneficio deleted successfully.');

        return redirect(route('beneficios.index'));
    }
}
