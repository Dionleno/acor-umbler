<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjetoRequest;
use App\Http\Requests\UpdateProjetoRequest;
use App\Repositories\ProjetoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProjetoController extends AppBaseController
{
    /** @var  ProjetoRepository */
    private $projetoRepository;

    public function __construct(ProjetoRepository $projetoRepo)
    {
        $this->projetoRepository = $projetoRepo;
    }

    /**
     * Display a listing of the Projeto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->projetoRepository->pushCriteria(new RequestCriteria($request));
        $projetos = $this->projetoRepository->all();

        if(count($projetos) <= 0 ){
            Flash::warning('Nenhum projeto cadastrado!');
        }
        return view('projetos.index')
            ->with('projetos', $projetos);
    }

    /**
     * Show the form for creating a new Projeto.
     *
     * @return Response
     */
    public function create()
    {
        return view('projetos.create');
    }

    /**
     * Store a newly created Projeto in storage.
     *
     * @param CreateProjetoRequest $request
     *
     * @return Response
     */
    public function store(CreateProjetoRequest $request)
    {
        $input = $request->all();

        $projeto = $this->projetoRepository->create($input);

        Flash::success('Projeto saved successfully.');

        return redirect(route('projetos.index'));
    }

    /**
     * Display the specified Projeto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $projeto = $this->projetoRepository->findWithoutFail($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        return view('projetos.show')->with('projeto', $projeto);
    }

    /**
     * Show the form for editing the specified Projeto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $projeto = $this->projetoRepository->findWithoutFail($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        return view('projetos.edit')->with('projeto', $projeto);
    }

    /**
     * Update the specified Projeto in storage.
     *
     * @param  int              $id
     * @param UpdateProjetoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjetoRequest $request)
    {
        $projeto = $this->projetoRepository->findWithoutFail($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        $projeto = $this->projetoRepository->update($request->all(), $id);

        Flash::success('Projeto updated successfully.');

        return redirect(route('projetos.index'));
    }

    /**
     * Remove the specified Projeto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $projeto = $this->projetoRepository->findWithoutFail($id);

        if (empty($projeto)) {
            Flash::error('Projeto not found');

            return redirect(route('projetos.index'));
        }

        $this->projetoRepository->delete($id);

        Flash::success('Projeto deleted successfully.');

        return redirect(route('projetos.index'));
    }
}
