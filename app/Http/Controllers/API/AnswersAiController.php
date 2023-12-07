<?php

namespace App\Http\Controllers;
use App\Services\OpenAI;
use Illuminate\Http\Request;

class AnswersAiController extends Controller
{
  
    public function generateAnswers(Request $request, OpenAI $openAI)
    {
        $questions = $request->input('questions');
        $temperature = 0.8;
        $api_key = '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';
        $responses = [];
       

        
        $prompt = "I ahve set of array which have different questions plaese give an immdeate answes to the questions and the set of array is " + $questions;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $api_key,
            ])->post('https://api.openai.com/v1/engines/gpt-3.5-turbo-instruct/completions', [
                'prompt' => $prompt,
                'temperature' => floatval($temperature),
                'max_tokens' => 100,
                'n' => 1,
                'stop' => '.',
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $randomKey = rand(0, count($data['choices']) - 1);
                $randomValue = $data['choices'][$randomKey];
                $responseData = $randomValue['text'];
                return response()->json(['status' => 'success', 'data' => $responseData]);
            } else {
                return response()->json(['status' => 'error', 'message' => $response->json()], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    }
  

