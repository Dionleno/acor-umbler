<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEventoAPIRequest;
use App\Http\Requests\API\UpdateEventoAPIRequest;
use App\Models\Evento;
use App\Repositories\EventoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class EventoController
 * @package App\Http\Controllers\API
 */

class EventoAPIController extends AppBaseController
{
    /** @var  EventoRepository */
    private $eventoRepository;

    public function __construct(EventoRepository $eventoRepo)
    {
        $this->eventoRepository = $eventoRepo;
    }

    /**
     * Display a listing of the Evento.
     * GET|HEAD /eventos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->eventoRepository->pushCriteria(new RequestCriteria($request));
        $this->eventoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $eventos = $this->eventoRepository->all();

        return $this->sendResponse($eventos->toArray(), 'Eventos retrieved successfully');
    }

    /**
     * Store a newly created Evento in storage.
     * POST /eventos
     *
     * @param CreateEventoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEventoAPIRequest $request)
    {
        $input = $request->all();

        $eventos = $this->eventoRepository->create($input);

        return $this->sendResponse($eventos->toArray(), 'Evento saved successfully');
    }

    /**
     * Display the specified Evento.
     * GET|HEAD /eventos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Evento $evento */
        $evento = $this->eventoRepository->findWithoutFail($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found');
        }

        return $this->sendResponse($evento->toArray(), 'Evento retrieved successfully');
    }

    /**
     * Update the specified Evento in storage.
     * PUT/PATCH /eventos/{id}
     *
     * @param  int $id
     * @param UpdateEventoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEventoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Evento $evento */
        $evento = $this->eventoRepository->findWithoutFail($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found');
        }

        $evento = $this->eventoRepository->update($input, $id);

        return $this->sendResponse($evento->toArray(), 'Evento updated successfully');
    }

    /**
     * Remove the specified Evento from storage.
     * DELETE /eventos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Evento $evento */
        $evento = $this->eventoRepository->findWithoutFail($id);

        if (empty($evento)) {
            return $this->sendError('Evento not found');
        }

        $evento->delete();

        return $this->sendResponse($id, 'Evento deleted successfully');
    }
}
