<?php

session_start();
include "conn.php";

if(isset($_POST['submit'])){

 if(isset($_SESSION['user'])){
    if ($_SESSION['user']->role == "user"){

    $selected=$_POST['selected'];
    $query="SELECT id FROM poll WHERE question=:selected";
    $stmt=$conn->prepare($query);
    $stmt->bindParam(':selected',$selected);
 try{
    $stmt->execute();
    $prepare=$stmt->fetch();
    $answerId=$prepare->id;
 
    $idUser=$_SESSION['user']->id;
    $query="SELECT * FROM poll_option WHERE user_id = $idUser";
 try{
    $stmt=$conn->query($query);
    $numberOfVotes=$stmt->rowCount();

        if($numberOfVotes == 0){
        $insert="INSERT INTO poll_option VALUES('',$answerId,$idUser)";
    try{
            $conn->query($insert);
            $arrayAnswers=['Java','Javascript','Python'];
            $numberOfAnswers=getNumberOfAnswers($conn);
            $output="<br/><br/><br/><br/>";
            foreach($arrayAnswers as $answer){
                  $upit="SELECT * FROM poll_option WHERE
                  poll_id = (SELECT id FROM poll WHERE question='$answer')";
                   $stmt=$conn->query($upit);
                   $totalRowsAnswers=$stmt->rowCount();
    
                     $percent=round(($totalRowsAnswers/$numberOfAnswers)*100);
               $output.='
                 <span>'.$answer.':</span>
                     <span class="progress">
                 <span class="progress-bar" role="progressbar"
                style="width: '.$percent.'%;" aria-valuenow="25" aria-valuemin="0"
                 aria-valuemax="100">'.$percent.'%</span>
                      </span>';
                     }
              echo $output;
    
          }
     catch(PDOException $e){
     // echo $e->getMessage();
     }
   }else{
     echo "<div class='alert alert-danger'>You already voted!</div>";
     
     }
     }
     catch(PDOException $e){
    // echo $e->getMessage();
     }
    
    
     }
     catch(PDOException $e){
     // echo $e->getMessage());
     }
    }//if not logged in
}else{
        
     echo "<div class='alert alert-danger'>You have to be logged in to vote!</div>";
    
        


        $arrayAnswers=['Java','Javascript','Python'];
        $numberOfAnswers=getNumberOfAnswers($conn);
        $output="<br/><br/><br/><br/>";
        foreach($arrayAnswers as $answer){
        $upit="SELECT * FROM poll_option WHERE poll_id= (SELECT id FROM poll WHERE question='$answer')";
        $stmt=$conn->query($upit);
        $totalRowsAnswers=$stmt->rowCount();
       
       $percent=round(($totalRowsAnswers/$numberOfAnswers)*100);
        $output.='
       <label>'.$answer.':</label>
        <div class="progress">
        <div class="progress-bar" role="progressbar"
       style="width: '.$percent.'%;" aria-valuenow="25" aria-valuemin="0"
       aria-valuemax="100">'.$percent.'%</div>
        </div>';
   
        }
           echo $output;
    
    
    }
}//if not submit
    if(isset($_POST['survey'])){
        $arrayAnswers=['Java','Javascript','Python'];
        $numberOfAnswers=getNumberOfAnswers($conn);
        $output="<br/><br/><br/><br/>";
        foreach($arrayAnswers as $answer){
        $upit="SELECT * FROM poll_option WHERE poll_id= (SELECT id FROM poll WHERE question='$answer')";
        $stmt=$conn->query($upit);
        $totalRowsAnswers=$stmt->rowCount();
       
       $percent=round(($totalRowsAnswers/$numberOfAnswers)*100);
        $output.='
       <label>'.$answer.':</label>
        <div class="progress">
        <div class="progress-bar" role="progressbar"
       style="width: '.$percent.'%;" aria-valuenow="25" aria-valuemin="0"
       aria-valuemax="100">'.$percent.'%</div>
        </div>';
   
        }
           echo $output;
     
       }
       function getNumberOfAnswers($conn){
        $upit="SELECT * FROM poll_option";
        $answersQuery=$conn->query($upit);
        return $answersQuery->rowCount();
       }    