<style>

    .send {
        float:right;
        padding: 15px 10px 15px 10px;
        color: black;
        border: 2px solid #128C7E;
        border-radius:20px;
        width:50%;
        margin:8px;
        display:flex;
        flex-direction:column;
        background:#25D366;
        text-align:left;
    }
    .send span{
        text-align:right;
        background:#25D366;
    }
    .receive {
        float:left;
        padding: 15px 10px 15px 10px;
        color: black;
        border: 2px solid #128C7E;
        border-radius:20px;
        width:50%;
        margin:8px;
        display:flex;
        flex-direction:column;
        background:#34B7F1;
        text-align:left;
    }
    .receive span{
        text-align:right;
        background:#34B7F1;
    }
</style>

<?php
include('../connect.php');
switch( $_REQUEST['action']){

    case "MessageFetch":
        $message='';
        $query1=$db->prepare("SELECT * FROM messages");
        $result1=$query1->execute();
        $run=$query1->fetchAll(PDO::FETCH_OBJ);
        session_start();
        foreach($run as $chat){
            if($chat->user==$_SESSION['username']){
            $message.="<div class='send'>
            <strong style='background:#25D366;'>".$chat->user." :</strong> ".$chat->message.
            "<br><span>".date('h:i a ',strtotime($chat->date))."</span> 
            </div> "; }

            else{
            $message.="<div class='receive'>
            <strong style='background:#34B7F1;'>".$chat->user." :</strong> ".$chat->message.
            "<br><span>".date('h:i a ',strtotime($chat->date))."</span> 
            </div> ";
            };

        }
        echo $message;
        break;

    case "MessageSend":
        session_start();
        $query2=$db->prepare("INSERT INTO messages SET user=?,message=?");
        $result2=$query2->execute([$_SESSION['username'],$_REQUEST['message']]);
        echo 1;
        if($result2){
            echo 1;
            exit;
        }
        break;
    


}
?>