<?php

namespace App\Services;

use App\Models\Song;
use Illuminate\Support\Facades\DB;
use App\Interfaces\Service\SongServiceInterface;

class SongService implements SongServiceInterface
{

    /**
     * Inject Dependencies
     * 
     * @param \App\Models\Song
     */
    public function __construct(Song $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the songs.
     *
     * @param  array $request
     * @return \Illuminate\Http\Response
     */
    public function index(array $request)
    {
        return $this->model->orderBy('title')->paginate($request['per_page'] ?? 5);
    }

    /**
     * Store a song.
     *
     * @param  array  $request
     * @return \Illuminate\Http\Response
     */
    public function store(array $request)
    {
        DB::beginTransaction();

        try {

            $song = $this->model->create($request);

            DB::commit();

            return response()->json($song);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specific song.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified song.
     *
     * @param  array $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(array $request, int $id)
    {
        $song = $this->model->findOrFail($id);

        DB::beginTransaction();

        try {

            $song->update($request);

            DB::commit();

            return response()->json($song);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified song.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $song = $this->model->findOrFail($id);
        
        DB::beginTransaction();

        try {

            $song->delete();

            DB::commit();

            return response()->json(['message' => 'Successfully Deleted']);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}