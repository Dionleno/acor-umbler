<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlanoRequest;
use App\Http\Requests\UpdatePlanoRequest;
use App\Repositories\PlanoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class AssociadoPlanoController extends AppBaseController
{
    /** @var  PlanoRepository */
    private $planoRepository;
    private $associado;
    public function __construct(PlanoRepository $planoRepo)
    {
        $this->planoRepository = $planoRepo;
    }

    /**
     * Display a listing of the Plano.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->planoRepository->pushCriteria(new RequestCriteria($request));
        $planos = $this->planoRepository->findBy('tipo','0');

        return view('planos.index')
            ->with('planos', $planos);
    }


    /**
     * Show the form for creating a new Plano.
     *
     * @return Response
     */
    public function create()
    {
        return view('planos.create');
    }

    /**
     * Store a newly created Plano in storage.
     *
     * @param CreatePlanoRequest $request
     *
     * @return Response
     */
    public function store(CreatePlanoRequest $request)
    {
        $input = $request->all();
        $input['tipo'] = $this->associado;
        $plano = $this->planoRepository->create($input);

        Flash::success('Plano saved successfully.');

        return redirect(route('planos.index'));
    }

    /**
     * Display the specified Plano.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $plano = $this->planoRepository->findWithoutFail($id);

        if (empty($plano)) {
            Flash::error('Plano not found');

            return redirect(route('planos.index'));
        }

        return view('planos.show')->with('plano', $plano);
    }

    /**
     * Show the form for editing the specified Plano.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $plano = $this->planoRepository->findWithoutFail($id);

        if (empty($plano)) {
            Flash::error('Plano not found');

            return redirect(route('planos.index'));
        }

        return view('planos.edit')->with('plano', $plano);
    }

    /**
     * Update the specified Plano in storage.
     *
     * @param  int              $id
     * @param UpdatePlanoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlanoRequest $request)
    {
        $plano = $this->planoRepository->findWithoutFail($id);

        if (empty($plano)) {
            Flash::error('Plano not found');

            return redirect(route('planos.index'));
        }

        $plano = $this->planoRepository->update($request->all(), $id);

        Flash::success('Plano updated successfully.');

        return redirect(route('planos.index'));
    }

    /**
     * Remove the specified Plano from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $plano = $this->planoRepository->findWithoutFail($id);

        if (empty($plano)) {
            Flash::error('Plano not found');

            return redirect(route('planos.index'));
        }

        $this->planoRepository->delete($id);

        Flash::success('Plano deleted successfully.');

        return redirect(route('planos.index'));
    }
}
