<?php


class Stats
{
    public function calculate($posts)
    {
        $stats=[];
        foreach($posts as $key => $monthly_post){
            $messages=array_column($monthly_post,'message');
            $character_length=strlen(implode($messages,''));
            $average=round($character_length/count($messages));

            $longest_character = max(array_map('strlen',$messages));

            $users=array_unique(array_column($monthly_post,'from_id'));
            $average_posts=round(count($monthly_post) / count($users));

            $stats[] = [
                "Average character length of ".date('M, Y',strtotime($key)) => $average,
                "Longest post by character length of ".date('M, Y',strtotime($key)) => $longest_character,
                "Average number of posts per user in ".date('M, Y',strtotime($key)) => $average_posts
            ];
        }
        echo json_encode($stats);
    }
}