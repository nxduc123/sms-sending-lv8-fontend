<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckRequestAPIZalo;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
class ApiUpdateStatusZalo extends Controller
{
    public function receiveZALO(CheckRequestAPIZalo $request)
    {
        $data = $request->all();
        \Log::info(json_encode($data));
        try {
            $connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), env('RABBITMQ_PORT'), env('RABBITMQ_LOGIN'), env('RABBITMQ_PASSWORD'), env('RABBITMQ_VHOST'));
            $channel = $connection->channel();
            $channel->queue_declare(env('QUEUE_ZALO'), false, true, false, false);
            $data = json_encode([
                'msg_id' => $data['msg_id'],
                'type' => $data['type'],
                'status' => $data['status'],
                'zns_msg_id' => $data['zns_msg_id'] ?? '',
                'vbr_msg_id' => $data['vbr_msg_id'] ?? '',
                'received_time' => $data['received_time'] ?? '',
                'error' => $data['error'] ?? '',
                'sms_msg_id' => $data['sms_msg_id'],
                'error_failover' => $data['error_failover'],
                'failover_sent_time' => $data['failover_sent_time'],
                'failover_received_time' => $data['failover_received_time'],
            ]);
            $msg = new AMQPMessage($data, ['delivery_mode' => 2]);
            $channel->basic_publish($msg, '', env('QUEUE_ZALO'));

            return response()->json(
                [
                    'status' => 1,
                    'desc' => 'Successful data transmission',
                ],
                200,
            );
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(
                [
                    'status' => 0,
                    'desc' => 'An unknown error. Please try again',
                ],
                400,
            );
        }
    }
}
