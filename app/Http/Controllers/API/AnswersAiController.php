<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Services\OpenAI;
use Illuminate\Http\Request;

class AnswersAiController extends Controller
{
  
    public function generateAnswers(Request $request)
    {
        $questions = $request->questions; // Assuming you're getting questions from the request
        $temperature = 0.8;
        $api_key = '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';
        
        $prompt = "I have a set of array which has different questions. Please give immediate answers to the questions. The set of array is $questions";
        
        try {
            $ch = curl_init('https://api.openai.com/v1/engines/gpt-3.5-turbo-instruct/completions');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
                'prompt' => $prompt,
                'temperature' => floatval($temperature),
                'max_tokens' => 100,
                'n' => 1,
                'stop' => '.',
            ]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $api_key,
                'Content-Type: application/json',
            ]);
        
            $response = curl_exec($ch);
        
            if ($response === false) {
                return $response;
               // throw new Exception(curl_error($ch), curl_errno($ch));
            }
        
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
            if ($httpCode === 200) {
                $data = json_decode($response, true);
                $randomKey = rand(0, count($data['choices']) - 1);
                $randomValue = $data['choices'][$randomKey];
                $responseData = $randomValue['text'];
                echo json_encode(['status' => 'success', 'data' => $responseData]);
            } else {
                echo json_encode(['status' => 'error', 'message' => $response], 400);
            }
        
            curl_close($ch);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

}
  

