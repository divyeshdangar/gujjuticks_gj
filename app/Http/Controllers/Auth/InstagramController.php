<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\InstagramTrait;

class InstagramController extends Controller
{
    use InstagramTrait;

    // Here we get comments,live_comments,message_reactions,messages,messaging_optins,messaging_postbacks,messaging_referral,messaging_seen
    public function handleInstagramCallback(Request $request)
    {
        Log::alert($request->all());
        $verifyToken = config('services.instagram.INSTAGRAM_HUB_VERIFY_TOKEN');
        if ($request->hub_mode === 'subscribe' && $request->hub_verify_token === $verifyToken) {
            return response($request->hub_challenge, 200); // Respond with the challenge
        }
        return response('Invalid verification token', 403); // Respond with error if token is invalid
    }

    public function handleInstagramCallbackPost(Request $request)
    {
        $payload = $request->all();

        // Log the payload for debugging
        Log::info('Webhook payload received:', $payload);

        if (isset($payload['entry'])) {
            foreach ($payload['entry'] as $entry) {
                foreach ($entry['changes'] as $change) {
                    if ($change['field'] === 'comments') {
                        $commentData = $change['value'];

                        // Process the comment
                        $this->processComment($commentData);
                    }
                }
            }
        }

        return response('Event received', 200);
    }

    private function processComment(array $commentData)
    {
        $commentId = $commentData['id'];
        $commentText = $commentData['text'];
        $userId = $commentData['from']['id'] ?? null;
        $username = $commentData['from']['username'] ?? null;
        $postId = $commentData['post_id'];

        // Example: Log the comment data
        Log::info("New comment received on post $postId by @$username: $commentText");

        // Example: Save the comment to the database
        // \App\Models\InstagramComment::create([
        //     'comment_id' => $commentId,
        //     'post_id' => $postId,
        //     'user_id' => $userId,
        //     'username' => $username,
        //     'text' => $commentText,
        // ]);

        // Add further processing here, such as:
        // - Sending a notification
        // - Filtering for specific keywords
        // - Responding to the comment
    }

    // Deauthorize callback URL
    public function handleInstagramDeauthorizeCallback(Request $request)
    {
        Log::info("Deauthorize callback URL");
        try {
            Log::info($request);
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }

    // Data deletion request URL
    public function handleInstagramDeletionCallback(Request $request)
    {
        Log::info("Data deletion request URL");
        try {
            Log::info($request);
        } catch (\Throwable $th) {
            Log::info($th);
        }
    }
}
