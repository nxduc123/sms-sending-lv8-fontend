<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckRequestAPI;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class ApiUpdateStatus extends Controller
{
    public function receiveMo(CheckRequestAPI $request)
    {
        $data = $request->all();
        \Log::info(json_encode($data));
        try {
            $connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST'),
                env('RABBITMQ_PORT'),
                env('RABBITMQ_LOGIN'),
                env('RABBITMQ_PASSWORD'),
                env('RABBITMQ_VHOST')
            );
            $channel = $connection->channel();
            $channel->queue_declare(env('QUEUE_DLR'), false, true, false, false);
            $data = json_encode([
                'TmpID' => $data['smsid'],
                'Status'  => $data['status'],
                'Telco' => $data['telco'] ?? 'FPT',
                'ErrorCode' => $data['error'] ?? '',
                'MsgCount'  => $data['mt_count']
            ]);
            $msg = new AMQPMessage($data, array('delivery_mode' => 2));
            $channel->basic_publish($msg, '', env('QUEUE_DLR'));

            return response()->json([
                'status' => 1,
                'desc' => 'Successful data transmission',
            ], 200);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json([
                'status' => 0,
                'desc' => 'An unknown error. Please try again',
            ], 400);
        }
    }
}
