<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Services\OpenAI;
use Illuminate\Http\Request;

class AnswersAiController extends Controller
{
  
    public function generateAnswers(Request $request)
    {
        $questionsArray = $request->input('question'); // Assuming 'question' is the key for the array in the JSON payload
    
        $answers = [];
    
        $temperature = 0.8;
        $api_key = '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';
    
        foreach ($questionsArray as $question) {
                try {
                $prompt = "Hi, I will give you the questions , and you can provide the answer . Do not disclose your identity as an AI manager. This is the question: $question";
    
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
                }
    
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
                if ($httpCode === 200) {
                    $data = json_decode($response, true);
                    if (isset($data['choices']) && count($data['choices']) > 0) {
                        $randomValue = $data['choices'][0];
                        $answer = $randomValue['text'];
    //echo $answer;                        // Store the question and answer in the $answers array
                        $answers[] = ['question' => $question, 'answer' => $answer];
                    } else {
                        return  json_encode(['status' => 'error', 'message' => 'Invalid API response'], 500);
                    }
                } else {
                    return json_encode(['status' => 'error', 'message' => $response], 400);
                }
    
                curl_close($ch);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()], 500);
            }
        }
    
        // Return the array of answers
        echo json_encode(['status' => 'success', 'data' => $answers]);
    }
    

}
  

