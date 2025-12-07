<?php
require_once(__DIR__.'/../App_class/ChatApp.php');
class WaWebhook
{
    public static function router($page)
    {
        ob_start();
        $input = file_get_contents('php://input');

        // Convert JSON string to associative array
        // $data = json_decode($input, true);
        parse_str($input, $data);
        // Output the result
        $data['data']['wid'] = str_replace('+','',$data['data']['wid']);
        $data['data']['phone'] = str_replace('+','',$data['data']['phone']);
        print_r($data);
        $to_chat_app['from'] = $data['data']['phone'];
        $to_chat_app['sender'] = $data['data']['wid'];
        $to_chat_app['bufferImageLink'] = $data['data']['attachment'];
        $to_chat_app['bufferImage'] = "";
        $to_chat_app['participant'] = $data['data']['phone'];;
        $to_chat_app['message'] = $data['data']['message'];;
        ChatApp::initialize_chat($page,$to_chat_app);
        file_put_contents('whatsapp.txt', '[' . date('Y-m-d H:i:s') . "]\n" . ob_get_clean() . "\n\n", FILE_APPEND);
    }
}
