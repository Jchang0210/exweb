<?php

namespace App\Http\Controllers;

use App\Question;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Session;
use Route;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(20);
        return view('questions.index')->withQuestions($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('questions.create')->withCategories($categories);
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
            'purpose' => 'required',
            'category' => 'required',
            'imported_file' => 'required',
        ));

        $fileD = fopen($request->file('imported_file')->getRealPath(),"r");

        while(!feof($fileD)){
            $rowData[] = fgetcsv($fileD);
        }

        DB::beginTransaction();

        $category = $request->category;
        $purpose = $request->purpose;

        foreach ($rowData as $key => $value) {
            // if ($key == 0) continue;
            if (!$value) continue;

            $question = New Question;
            $question->category_id = $category;
            $question->purpose = $purpose;
            $question->type = mb_convert_encoding($value[0], "UTF-8", "BIG-5");
            $question->question = mb_convert_encoding($value[1], "UTF-8", "BIG-5");
            $question->answer = mb_convert_encoding($value[2], "UTF-8", "BIG-5");
            $question->option1 = mb_convert_encoding($value[3], "UTF-8", "BIG-5");
            $question->option2 = mb_convert_encoding($value[4], "UTF-8", "BIG-5");
            $question->option3 = mb_convert_encoding($value[5], "UTF-8", "BIG-5");
            $question->option4 = mb_convert_encoding($value[6], "UTF-8", "BIG-5");
            $question->option5 = mb_convert_encoding($value[7], "UTF-8", "BIG-5");

            $save = $question->save();
        }

        DB::commit();

        $questions = Question::paginate(10);

        return redirect()->route('question.index')->withQuestions($questions);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('questions.edit')->withQuestion($question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $question = Question::find($id);

        $this->validate($request, array(
            'purpose' => 'required',
            'type' => 'required',
            'question' => 'required',
            'answer' => 'required'
        ));

        // store in the database
        $question->purpose = $request->purpose;
        $question->type = $request->type;
        $question->question = $request->question;
        $question->answer = $request->answer;
        $question->option1 = $request->option1;
        $question->option2 = $request->option2;
        $question->option3 = $request->option3;
        $question->option4 = $request->option4;
        $question->option5 = $request->option5;

        $save = $question->save();

        // session
        Session::flash('success', 'success to update');

        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $question = Question::find($id);

        $question->delete();

        Session::flash('success', 'the question was success deleted!');

        if (explode('/', Session::get('_previous')['url'])[3] == "category") {
            $id = explode('/', Session::get('_previous')['url'])[4];

            $category = Category::find($id);
            $questions = Question::where('category_id', $id)->paginate(10);

            return  redirect()->route('category.show', $id)->withCategory($category)->withQuestions($questions);
            // return  view('categories.show')->withCategory($category)->withQuestions($questions);

        } else {
            return redirect()->route('question.index');
        }
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
