<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(15);
        return view('admin.feedbacks.index', compact('feedbacks'));
    }
}
