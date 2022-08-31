<?php
include_once "./vendor/autoload.php";

use Thrift\Transport\TBufferedTransport;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TPhpStream;
use Services\User\userClient;

try {

    $socket = new THttpClient('127.0.0.1', 8003, '/server.php');//服务端定义的url
    $transport = new TBufferedTransport($socket, 1024, 1024);
    $protocol = new TBinaryProtocol($transport);
    $client = new userClient($protocol);
    $transport->open();
    $result = $client->getinfo(1);//调用远程方法
    $transport->close();
    return $result;
} catch (TException $tx) {
    print 'TException: '.$tx->getMessage()."\n";
    return null;
}

