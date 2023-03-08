<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\CreateStudentRequest;
use App\DataTables\StudentDataTable;
use App\Repositories\StudentRepository;
use App\Http\Controllers\AppBaseController;

use Illuminate\Http\Request;

class StudentController extends AppBaseController
{
    /** @var StudentRepository $studentRepository*/
    private $studentRepository;

    public function __construct(StudentRepository $studentRepo)
    {
        $this->studentRepository = $studentRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(StudentDataTable $studentDataTable)
    {
        return $studentDataTable->render('pages.students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect(route('students.index'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStudentRequest $request)
    {
        $input = $request->all();

        $input["nis"] = str_replace(" ", "", $request->nis);

        $student = $this->studentRepository->create($input);

        return $this->sendResponse($student->toArray(), 'Data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect(route('students.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return redirect(route('students.index'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Data not found');
        }
        $input = $request->all();

        $input["nis"] = str_replace(" ", "", $request->nis);

        $student = $this->studentRepository->update($input, $id);

        return $this->sendResponse($student->toArray(), 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = $this->studentRepository->find($id);

        if (empty($student)) {
            return $this->sendError('Data not found');
        }

        $this->studentRepository->delete($id);

        return $this->sendSuccess('Data deleted successfully');
    }

    public function list(Request $request)
    {
        $search = $request->q;

        $data = $this->studentRepository->select2($search);

        return $this->sendSelec2Response($data->items(), 'Fetched successfully', $data->hasMorePages()); 
    }
}
