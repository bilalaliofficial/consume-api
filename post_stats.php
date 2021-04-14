<?php
require_once 'Post.php';
require_once 'Stats.php';

if (!empty($_GET['sl_token'])){
    $sl_token=$_GET['sl_token'];

    $post_url='https://api.supermetrics.com/assignment/posts';
    $all_posts=[];
    for ($i=1;$i<=10;$i++){
        $get_params=['sl_token'=>$sl_token,'page'=>$i];
        $post=new Post('get',$post_url,$get_params);
        $post_data=$post->send();
        if (isset($post_data->error)){
            echo "Try Again!";
        }else{
            $all_posts=array_merge($all_posts,$post_data->data->posts);
        }
    }

    $monthly_posts=[];
    if (!empty($all_posts)){
        foreach ($all_posts as $p){
            $month=date('Y-m',strtotime($p->created_time));
            $monthly_posts[$month][]=((array)$p);
        }

        $stats=new Stats();
        $stats->calculate($monthly_posts);
    }
}