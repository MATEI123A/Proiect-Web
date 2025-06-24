<?php

function point(){
    $servername = "localhost";
    $username = "root";
    $password = "";     
    $dbname = "utilizator";

    $conn = mysqli_connect($servername, $username, $password);
    if (!$conn) 
        die("Connection error: " . mysqli_connect_error());

    $sql = "CREATE DATABASE IF NOT EXISTS utilizator";
    mysqli_query($conn, $sql);

    mysqli_select_db($conn, $dbname); 
    $users=[];

    if($_COOKIE["points"]=="total_points"){
        $sql = "SELECT username, total_points FROM user_points
                WHERE username NOT LIKE 'Admin' ORDER BY total_points DESC";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
        while ($row = $result->fetch_assoc()) {
            $users[] = [
                'username' => $row['username'],
                'total_points' => $row['total_points']
            ];}
        } else {
                    $users[] = [
                            'username' => "No user registred",
                            'pull_points' => 0
                        ];
                }
    
        echo json_encode($users);        
    }  else  if($_COOKIE["points"]=="lower_points"){
                $sql = "SELECT username, pull_points FROM user_points
                        WHERE username NOT LIKE 'Admin' AND pull_points > 0
                        ORDER BY pull_points DESC";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $users[] = [
                            'username' => $row['username'],
                            'pull_points' => $row['pull_points']
                        ];
                    }
                } else {
                    $users[] = [
                            'username' => "No user registred",
                            'pull_points' => 0
                        ];
                }
                
                echo json_encode($users);        
            }   else  if($_COOKIE["points"]=="upper_points"){
                
                        $sql = "SELECT username, push_points FROM user_points
                                WHERE username NOT LIKE 'Admin' AND push_points > 0
                                ORDER BY push_points DESC";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $users[] = [
                                    'username' => $row['username'],
                                    'push_points' => $row['push_points']
                                ];
                            }
                        } else {
                            $users[] = [
                                    'username' => "No user registred",
                                    'push_points' => 0
                                ];
                        }
                        
                        echo json_encode($users);        
                    }  else if($_COOKIE["points"]=="abs_points"){
                    
                                $sql = "SELECT username, abs_points FROM user_points
                                        WHERE username NOT LIKE 'Admin' AND abs_points > 0
                                        ORDER BY abs_points DESC";

                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $users[] = [
                                            'username' => $row['username'],
                                            'abs_points' => $row['abs_points']
                                        ];
                                    }
                                } else {
                                    $users[] = [
                                            'username' => "No user registred",
                                            'abs_points' => 0
                                        ];
                                }
                                
                                echo json_encode($users);  

                            }   else if($_COOKIE["points"]=="legs_points"){
                    
                                    $sql = "SELECT username, legs_points FROM user_points
                                            WHERE username NOT LIKE 'Admin' AND legs_points > 0
                                            ORDER BY legs_points DESC";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $users[] = [
                                                'username' => $row['username'],
                                                'legs_points' => $row['legs_points']
                                            ];
                                        }
                                    } else {
                                        $users[] = [
                                                'username' => "No user registred",
                                                'legs_points' => 0
                                            ];
                                    }
                                    
                                    echo json_encode($users);        
                                }  else  if($_COOKIE["points"]=="pdf"){
                    
                                    require('../fpdf186/fpdf.php');
                                    $pdf = new FPDF();
                                    $pdf->AddPage();
                                    $pdf->SetFont('Arial', 'B', 18);
                                    $pdf->Cell(60,20,'List with all users registred');
                                    $pdf->Ln();

                                    $sql = "SELECT username, total_points FROM user_points
                                            WHERE username NOT LIKE 'Admin' ORDER BY total_points DESC";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        $pdf->SetFont('Arial', '', 12); 

                                        while ($row = $result->fetch_assoc()) {
                                            $pdf->Cell(60, 10, $row['username'], 1);
                                            $pdf->Cell(40, 10, $row['total_points'], 1);
                                            $pdf->Ln();
                                        }
                                    } else 
                                        $pdf->Cell(100, 10, 'No users with an account!', 1);
                                        $pdf->Output('D', 'users.pdf');
                                        $pdf->Output();
                                        exit;       
                                    }  else  if($_COOKIE["points"]=="json"){

                                                $path='../data/new-file.json';
                                                $sql="SELECT username,total_points FROM user_points
                                                WHERE username NOT LIKE 'Admin' ORDER BY total_points DESC";

                                                $result=$conn->query($sql);

                                                if($result->num_rows > 0){
                                                    while($row = $result->fetch_assoc()){
                                                        $users[]=[
                                                            'username' => $row['username'],
                                                            'total_points' => $row['total_points']
                                                        ];
                                                    }
                                                }
                                   
                                               $encodeData = json_encode($users,JSON_PRETTY_PRINT);
                                               file_put_contents($path,$encodeData);
                                               exit;
                                        }   else  if($_COOKIE["points"]=="csv"){

                                               $fp = fopen('../data/new-file.csv','w');
                                               $sql = "SELECT username,total_points FROM user_points 
                                               WHERE username NOT LIKE 'Admin' ORDER BY total_points DESC";

                                               $result = $conn->query($sql);

                                               if($result->num_rows > 0){
                                                    while($row = $result->fetch_assoc()){
                                                        $users[]=[
                                                            'username' => $row['username'],
                                                            'total_points' => $row['total_points']
                                                        ];
                                                    }
                                               } else {
                                                    $users[]=[
                                                        'message' => 'No user registred'
                                                    ]; 
                                               }

                                               foreach($users as $line){
                                                    fputcsv($fp,$line,',');  
                                               }

                                               fclose($fp);
                                               exit;
                                        }  

    $conn->close();
}

point(); 
?>
