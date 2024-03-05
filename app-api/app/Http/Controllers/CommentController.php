<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function getFeedbacks($planId)
    {
        // $feedback = Feedback::all()->where('plan_id', $planId);
        $user = Feedback::with('user:id,name,avatar,remember_token')->where('plan_id', $planId)->get();
        return response()->json(['success' => $user]);
    }

    public function addFeedback(Request $request, $planId, $trainerId)
    {
        // Получаем текущего аутентифицированного пользователя
        $user = Auth::user();

        // Создаем новую обратную связь (feedback)
        $feedback = new Feedback();
        $feedback->avatar = $user->avatar;
        $feedback->user_id = $user->id; // Устанавливаем идентификатор пользователя
        $feedback->plan_id = $planId; // Устанавливаем идентификатор плана
        $feedback->trainer_id = $trainerId; // Предполагается, что идентификатор тренера передается в запросе
        $feedback->rating = $request->input('rating'); // Предполагается, что рейтинг передается в запросе
        $feedback->comment = $request->input('comment'); // Предполагается, что комментарий передается в запросе
        // Если есть необходимость сохранить аватар, учтите его также

        $feedback->save(); // Сохраняем обратную связь в базе данных

        return response()->json(['success' => true, 'message' => 'Feedback added successfully']);
    }
    public function delFeedback($feedbackId)
    {
        $user = Auth::user();    
        $feedback = Feedback::where('id', $feedbackId)
        ->where('user_id', $user->id)
        ->first();
        if ($feedback) {
            $feedback->delete();
            return response()->json(['success' => true, 'message' => 'Feedback deleted successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Feedback not found or unauthorized'], 404);
        }
    }
    
}
