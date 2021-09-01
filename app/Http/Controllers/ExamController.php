<?php

namespace App\Http\Controllers;
use App\models\Question;
use App\models\Exam;
use Illuminate\Http\Request;
use Exception;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $exams = Exam::all();
        return view('exam.index',compact('questions','exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = Exam::create($request->only('name'));
        foreach($request->questions as $question){
            $exam->questions()->attach($question);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam = Exam::find($id);
        $questions = $exam->questions;
        $questions = $questions->shuffle();
        return view('exam.show',compact('exam','questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exam::where('id',$id)->delete();
        return redirect()->back();
    }

    public function print_word($id){
        $exam = Exam::find($id);
        $questions = $exam->questions;
        $questions = $questions->shuffle();
        $html =  view('exam.word',compact('exam','questions'))->render();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html, false, false);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('exam.docx'));
        } catch (Exception $e) {
        }
        return response()->download(storage_path('exam.docx'));
    }
}
