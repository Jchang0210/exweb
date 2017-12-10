<?php

namespace App\Http\Controllers;

use App\Practice;
use App\Exam;
use App\Question;
use Illuminate\Http\Request;
use Session;

class PracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::where('release', 1)->paginate(10);
        return view('practices.index')->withExams($exams);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Practice  $practice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);

        $aQuestion = array();
        foreach(json_decode($exam->weights) as $category_id => $weights) {
            $amount = ($exam->size * $weights) / 100;
            $aQuestion[] = Question::where('category_id', $category_id)->where('purpose', $exam->purpose)->inRandomOrder()->take($amount)->get()->toArray();
        }

        $questions = $this->custom_shuffle(array_reduce($aQuestion, 'array_merge', []));

        Session::put('questions', $questions);
        Session::put('examname', $exam->name);

        // dd($questions);
        return view('practices.show')->withExam($exam)->withQuestions($questions);

    }

    function custom_shuffle($my_array = array()) {
        $result = array();
        while (count($my_array)) {
            // takes a rand array elements by its key
            $element = array_rand($my_array);
            // assign the array and its value to an another array
            $result[] = $my_array[$element];
            //delete the element from source array
            unset($my_array[$element]);
        }
        return $result;
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
