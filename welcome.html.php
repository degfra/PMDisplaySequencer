<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/base.css">
        <title>Welcome to Display Sequencer (DS)</title>

        

    </head>
    <body style="padding: 40px;">
        <h2>Welcome to Display Sequencer (DS)</h2>
        
        <div>
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
            
            echo $list_1[0];
            
            $list_3 = array(
                0 =>'Jill',
                1 =>'Fred',
                2 =>'Bill'
            );
            
            $list_1[0] = $list_3;
            
            //$list_1[0][0] = $list_3;
            
            echo $list_1[1];
            
            echo "<br><br>";
            
            /*$sequenceclips = array( array( clipname => 'Clip1',
                                             clip_id => '1',
                                             sequence_id => 'seq3'),
                                      array( clipname => 'Clip2',
                                             clip_id => '2',
                                             sequence_id => 'seq3'),
                                      array( clipname => 'Clip3',
                                             clip_id => '3',
                                             sequence_id => 'seq3')
                                ); */
            
            $clips1 = array( clipname => 'Clip1',
                             clip_id => '1',
                             sequence_id => 'seq3');
            
            $clips2 = array( clipname => 'Clip2',
                             clip_id => '2',
                             sequence_id => 'seq3');
            
            $clips3 = array( clipname => 'Clip3',
                             clip_id => '3',
                             sequence_id => 'seq3');
            
            /*$sequenceclips = array( $clips1,
                                    $clips2,
                                    $clips3                    
            ); */
            
            $sequenceclips = array();
            
            array_push($sequenceclips, $clips1);
            array_push($sequenceclips, $clips2);
            array_push($sequenceclips, $clips3);
            
                
            for ($row = 0 ; $row < 3; $row++) {
                
                echo $sequenceclips[$row][clipname];
                echo "<br>";
                        
            }
            
            
            ?>
        </div>
        
        <p>
        <ul>
            <li><a href="visit/clips/">List all available clips</a></li>
            <li><a href="admin/">Manage Display Sequencer</a></li>    
        </ul>        
    </p>
</body>
</html>
