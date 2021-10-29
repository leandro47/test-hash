<?php

namespace App\Http\Controllers;

use App\Repositories\HashRepository;
use App\Services\HashGenerator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HashController extends Controller
{
    private HashRepository $repository;
    
    public function __construct()
    {
        $this->repository = new HashRepository;
    }
    /**
     * @param Request $request
     * @return Response
     */
    public function build(Request $request): Response
    {
        $hashgenerator = new HashGenerator($request->input('text'));

        try {
            $hashFound = $hashgenerator->search();
            $this->repository->store($hashFound);

            return response(['hash_found' => $hashFound->hash_found], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }
    
    /**
     * @param integer|null $numberTry
     * @return Response
     */
    public function generated(int $numberTry = null): Response
    {
        $data = $this->repository->fetch($numberTry);
        return response(['number' => $data]);
    }
}
