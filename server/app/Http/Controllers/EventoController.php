<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Repositories\EventoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Image;

class EventoController extends AppBaseController
{
    /** @var  EventoRepository */
    private $eventoRepository;

    public function __construct(EventoRepository $eventoRepo)
    {
        $this->eventoRepository = $eventoRepo;
    }

    /**
     * Display a listing of the Evento.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->eventoRepository->pushCriteria(new RequestCriteria($request));
        $eventos = $this->eventoRepository->all();
        if(count($eventos) <= 0 ){
            Flash::warning('Nenhum evento cadastrado!');
        }
        return view('eventos.index')
            ->with('eventos', $eventos);
    }

    /**
     * Show the form for creating a new Evento.
     *
     * @return Response
     */
    public function create()
    {
        return view('eventos.create');
    }

    /**
     * Store a newly created Evento in storage.
     *
     * @param CreateEventoRequest $request
     *
     * @return Response
     */
    public function store(CreateEventoRequest $request)
    {
        $input = $request->all();
        
        $input['logo'] = $this->Base64ToUrl($request->logo);
        $evento = $this->eventoRepository->create($input);

        Flash::success('Evento saved successfully.');

        return redirect(route('eventos.index'));
    }

    /**
     * Display the specified Evento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $evento = $this->eventoRepository->findWithoutFail($id);

        if (empty($evento)) {
            Flash::error('Evento not found');

            return redirect(route('eventos.index'));
        }

        return view('eventos.show')->with('evento', $evento);
    }

    /**
     * Show the form for editing the specified Evento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $evento = $this->eventoRepository->findWithoutFail($id);

        if (empty($evento)) {
            Flash::error('Evento not found');

            return redirect(route('eventos.index'));
        }
        $createdAt = \Carbon\Carbon::parse($evento->data);
        $data = $createdAt->format('Y-m-d');

        
        return view('eventos.edit')->with('evento', $evento)->with('data', $data);
    }

    /**
     * Update the specified Evento in storage.
     *
     * @param  int              $id
     * @param UpdateEventoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventoRequest $request)
    {
        $evento = $this->eventoRepository->findWithoutFail($id);

        if (empty($evento)) {
            Flash::error('Evento not found');

            return redirect(route('eventos.index'));
        }
        $input = $request->all();
        $input['logo'] = $this->Base64ToUrl($request->logo);
        $evento = $this->eventoRepository->update($input , $id);

        Flash::success('Evento updated successfully.');

        return redirect(route('eventos.index'));
    }

    /**
     * Remove the specified Evento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $evento = $this->eventoRepository->findWithoutFail($id);

        if (empty($evento)) {
            Flash::error('Evento not found');

            return redirect(route('eventos.index'));
        }

        $this->eventoRepository->delete($id);

        Flash::success('Evento deleted successfully.');

        return redirect(route('eventos.index'));
    }
     private function Base64ToUrl($base64){
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        $thumb = Image::make($data);
        $new_image = sha1(time() . uniqid('',true));
        $thumb->save(public_path('/uploads/'.$new_image.'.jpg'));
        return '/uploads/'.$new_image.'.jpg';
    }
}
