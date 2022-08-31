<?php

include_once "./vendor/autoload.php";
include_once "user.php";

use Thrift\Transport\TBufferedTransport;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TPhpStream;
use Services\User\userIf;
use Services\User\userProcessor;
header('Content-Type', 'application/x-thrift');


class user implements userIf{
    function getinfo($uid){
        $user = [
            "name" => "杨舟"
        ];
        return $user;
    }
}


$handler = new user();//这里是定义在服务端提供服务的类
$processor = new userProcessor($handler);
$transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
$protocol = new TBinaryProtocol($transport, true, true);
$transport->open();
$processor->process($protocol, $protocol);
$transport->close();
