<?php

namespace App\Http\Controllers;
use App\models\Question;
use App\models\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index',compact('questions'));
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
        $question = Question::create($request->only(['body','level']));
        foreach($request->answers as $key=>$body){
            $answer = new Answer;
            $answer->body = $request->answers[$key];

            if($key+1 == $request->right){
                $answer->right = true;
            } else {
                $answer->right = false;
            }

            $answer->question_id = $question->id;
            $answer->save();
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
        $question = Question::find($id);
        return view('question.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('question.edit',compact('question'));
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
        Question::where('id',$id)->update($request->only(['body','level']));
        $question = Question::find($id);
        foreach($question->answers as $key => $answer){
            $answer->body = $request->answers[$key];

            if($key+1 == $request->right){
                $answer->right = true;
            } else {
                $answer->right = false;
            }
            $answer->save();
        }
        return redirect()->route('/questions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::where('question_id',$id)->delete();
        Question::where('id',$id)->delete();
        return redirect()->back();
    }
}
