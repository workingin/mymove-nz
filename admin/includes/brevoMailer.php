<?php

require_once dirname(__DIR__, 2) . '/app/env.php';

class brevoMailer {
    
    function send($recipient,$subject,$message){
            
            $apiKey = env('BREVO_API_KEY');
            if ($apiKey === null || $apiKey === '') {
                return false;
            }

            $apiUrl = 'https://api.brevo.com/v3/smtp/email';
            
            // Email data
            $emailData = [
                'sender' => [
                    'name' => 'MyMove NZ Portal',
                    'email' => 'info@mymove.nz'
                ],
                'to' => [
                    [
                        'email' => $recipient['email'],
                        'name' => $recipient['firstname'].' '.$recipient['lastname'],
                    ]
                ],
                'subject' => $subject,
                'htmlContent' => $message,
            ];
            
            // cURL setup
            $ch = curl_init();
            
            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return the response as a string
            curl_setopt($ch, CURLOPT_POST, 1);  // Set method to POST
            
            // Add headers including the API key for authorization
            $headers = [
                'Content-Type: application/json',
                'api-key: ' . $apiKey,
            ];
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            // Convert email data to JSON and add it to the request body
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($emailData));
            
            // Execute the cURL request
            $response = curl_exec($ch);
            
            // Check for errors
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                // Decode the response
                $responseDecoded = json_decode($response, true);
            
                // Output the result
                if (isset($responseDecoded['messageId'])) {
                    return true;
                } else {
                    return false;
                    // $responseDecoded['message']
                }
            }
            
            // Close the cURL session
            curl_close($ch);


    }
    
}
?>