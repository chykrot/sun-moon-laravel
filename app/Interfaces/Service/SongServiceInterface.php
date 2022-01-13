<?php

namespace App\Interfaces\Service;


interface SongServiceInterface
{
    /**
     * Display a listing of the songs.
     *
     * @param  array $request
     * @return \Illuminate\Http\Response
     */
    public function index(array $request);

    /**
     * Store a song.
     *
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function store(array $request);

    /**
     * Display the specific song.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id);

    /**
     * Update the specified song.
     *
     * @param  array $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $request, int $id);

    /**
     * Remove the specified song.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id);

}