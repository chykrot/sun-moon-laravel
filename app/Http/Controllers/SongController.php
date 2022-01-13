<?php

namespace App\Http\Controllers;

use App\Interfaces\Service\SongServiceInterface;
use App\Http\Requests\{ ListSongRequest, StoreSongRequest, UpdateSongRequest };

class SongController extends Controller
{
    /**
     * Inject Dependencies
     * 
     * @param \App\Interfaces\Service\SongServiceInterface
     */
    public function __construct(SongServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the songs.
     *
     * @param \App\Http\Requests\ListSongRequest
     * @return \Illuminate\Http\Response
     */
    public function index(ListSongRequest $request)
    {   
        return $this->service->index($request->validated());
    }

    /**
     * Store a song.
     *
     * @param  \App\Http\Requests\StoreSongRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSongRequest $request)
    {
        return $this->service->store($request->validated());
    }

    /**
     * Display the specific song.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified song.
     *
     * @param  \App\Http\Requests\UpdateSongRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSongRequest $request, $id)
    {
        return $this->service->update($request->validated(), $id);
    }

    /**
     * Remove the specified song.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
