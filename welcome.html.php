<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/base.css">
        <title>Welcome to Display Sequencer (DS)</title>

        

    </head>
    <body style="padding: 40px;">
        <h2>Welcome to Display Sequencer (DS)</h2>
        
        <!--<div>
            <?php 
            
            $list_1 = array(
                0 =>'one',
                1 =>'two',
                2 =>'three' 
            );
            
            
            $list_2 = array(
                0 =>'four',
                1 =>'five',
                2 =>'six' 
            );
            
            $list_1 = $list_2;
            
           // echo $list_1[0];
            
            $list_3 = array(
                0 =>'Jill',
                1 =>'Fred',
                2 =>'Bill'
            );
            
            $list_1[0] = $list_3;
            
            $clips1 = array( clipname => 'Clip1',
                             clip_id => '1',
                             sequence_id => 'seq1');
            
            $clips2 = array( clipname => 'Clip2',
                             clip_id => '2',
                             sequence_id => 'seq1');
            
            $clips3 = array( clipname => 'Clip3',
                             clip_id => '3',
                             sequence_id => 'seq1');
            
            
            $clips4 = array( clipname => 'Clip4',
                             clip_id => '4',
                             sequence_id => 'seq3');
            
            $clips5 = array( clipname => 'Clip5',
                             clip_id => '5',
                             sequence_id => 'seq3');
            
            $clips6 = array( clipname => 'Clip6',
                             clip_id => '6',
                             sequence_id => 'seq3');
            
            /*$sequenceclips = array( $clips1,
                                    $clips2,
                                    $clips3                    
            ); */
            
            $sequences = array();
            
                $sequence1 = array( sequence_id => '1',
                                    sequencename => 'Clips_1_to_3');

                $sequence2 = array( sequence_id => '3',
                                    sequencename => 'Clips_4_to_6');

                array_push($sequences, $sequence1);
                array_push($sequences, $sequence2);
            
            $clipsequences = array(); // 1 for each sequence
            
                $sequenceclips[0] = array();
            
                    array_push($sequenceclips[0], $clips1);
                    array_push($sequenceclips[0], $clips2);
                    array_push($sequenceclips[0], $clips3);

                array_push($clipsequences, $sequenceclips[0]);
            
                $sequenceclips[1] = array();
            
                    array_push($sequenceclips[1], $clips4);
                    array_push($sequenceclips[1], $clips5);
                    array_push($sequenceclips[1], $clips6);
            
                array_push($clipsequences, $sequenceclips[1]);
            
            //echo $sequenceclips[0][1][clipname];
            //echo "<br>";
                
            for ($i = 0 ; $i < count($sequences); $i++) {
                
                echo "<strong>";

                    echo "Sequence ".$sequences[$i][sequence_id].": ".$sequences[$i][sequencename];
                    echo "<br>";
                echo "</strong>";
                
                foreach ($sequenceclips[$i] as $row) {
                
                echo "<small>";
                    echo $row[clip_id].": ";
                    echo $row[clipname]." from ";
                    echo $row[sequence_id];
                    echo "<br>";
                echo"</small>";
                        
                }
                echo "<br>";
            }
            
            
            ?>
        </div> -->
        
        <p>
        <ul>
            <li><a href="visit/clips/">List all available clips</a></li>
            <li><a href="admin/">Manage Display Sequencer</a></li>    
        </ul>        
    </p>
</body>
</html>
