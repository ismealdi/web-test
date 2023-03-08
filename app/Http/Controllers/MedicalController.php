<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMedicalRequest;
use App\Http\Requests\CreateMedicalRequest;
use App\DataTables\MedicalDataTable;
use App\Repositories\MedicalRepository;
use App\Http\Controllers\AppBaseController;

use Illuminate\Http\Request;

class MedicalController extends AppBaseController
{
    /** @var MedicalRepository $medicalRepository*/
    private $medicalRepository;

    public function __construct(MedicalRepository $medicalRepo)
    {
        $this->medicalRepository = $medicalRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(MedicalDataTable $medicalDataTable)
    {
        return $medicalDataTable->render('pages.medicals.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect(route('medicals.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMedicalRequest $request)
    {
        $input = $request->all();

        $input["height"] = str_replace(" CM", "", $request->height);
        $input["weight"] = str_replace(" KG", "", $request->weight);

        $medical = $this->medicalRepository->create($input);

        return $this->sendResponse($medical->toArray(), 'Data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('medicals.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect(route('medicals.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalRequest $request, string $id)
    {
        $medical = $this->medicalRepository->find($id);

        if (empty($medical)) {
            return $this->sendError('Data not found');
        }
        $input = $request->all();

        $input["height"] = str_replace(" CM", "", $request->height);
        $input["weight"] = str_replace(" KG", "", $request->weight);

        $medical = $this->medicalRepository->update($input, $id);

        return $this->sendResponse($medical->toArray(), 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medical = $this->medicalRepository->find($id);

        if (empty($medical)) {
            return $this->sendError('Data not found');
        }

        $this->medicalRepository->delete($id);

        return $this->sendSuccess('Data deleted successfully');
    }
}
