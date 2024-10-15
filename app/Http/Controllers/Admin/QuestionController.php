<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interface\CustomerQuestionRepositoryInterface;

class QuestionController extends Controller
{
    private $customer;

    public function __construct(CustomerQuestionRepositoryInterface $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            return $this->customer->dataTable();
        }

        return view('backend.question.index');
    }

    public function answer($id)
    {
        $question = $this->customer->findQuestionById($id);
        $answer = null;
        if($question->answer) {
            $answer = $this->customer->findAnswerById($question->answer->id);
        }

        return view('backend.question.answer', compact('question', 'answer'));
    }

    public function submitAnswer(Request $request) 
    {
        return $this->customer->updateOrCreateAnswer($request);
    }
}
