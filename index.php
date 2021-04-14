<?php
require_once 'Register.php';

$url='https://api.supermetrics.com/assignment/register';
$data=[
  'client_id'  =>   'ju16a6m81mhid5ue1z3v2g0uh',
    'email'     => 'bilalali0002@gmail.com',
    'name'      => 'Bilal Ali'
];
$register=new Register('post',$url,$data);
$result=$register->submit();

echo $result;