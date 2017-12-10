<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Category;
use Illuminate\Http\Request;
use Session;
use App\Rules\Weights;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::paginate(10);

        $weights = array();
        foreach ($exams as $key => $value) {
            $weights = json_decode($value['weights']);
        }

        return view('exams.index')->withExams($exams)->withWeights($weights);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('exams.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            'purpose' => 'required',
            'size' => 'required|max:300|integer',
            'weights' => new Weights,
        ));

        $exam = New Exam;
        $exam->name = $request->name;
        $exam->purpose = $request->purpose;
        $exam->size = $request->size;
        $exam->release = 0;
        $exam->weights = json_encode($request->weights);
        $exam->save();

        Session::flash('success', 'add a new exam ' . $exam->name);
        return redirect()->route('exam.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::find($id);
        return view('exams.edit')->withExam($exam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::find($id);

        $this->validate($request, array(
            'name' => 'required',
            'purpose' => 'required',
            'size' => 'required|max:300|integer',
            'weights' => new Weights,
        ));

        $exam->name = $request->name;
        $exam->purpose = $request->purpose;
        $exam->size = $request->size;
        $exam->release = $exam->release;
        $exam->weights = json_encode($request->weights);
        $exam->save();

        Session::flash('success', 'update ' . $exam->name);

        return redirect()->route('exam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::find($id);

        $exam->delete();

        Session::flash('success', 'the exam was success deleted!');

        return redirect()->route('exam.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function release(Request $request, $id, $type)
    {

        $exam = Exam::find($id);
        $exam->release = $type;
        $exam->save();

        Session::flash('success', (($type == 1) ?'release ' : 'close ') . $exam->name);

        return redirect()->route('exam.index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
