<?php
      include 'include/global.php';
      include 'include/function.php';

        $zonaWaktu = time() + (60 * 60 * 7); // GMT + 7 (Asia/Jakarta) // menyesuaikan waktu server
        $tgl = gmdate('Y-m-d', $zonaWaktu);

        $arr_id = array();
        $id= mysqli_query($link,"SELECT user_id FROM demo_user");
        while($row = mysqli_fetch_array($id)) {
            $nilai = $row[0];
            $arr_id[] = $nilai;
           // echo $nilai."<br>";
        }

        echo"<pre>";
        print_r($arr_id);
        echo "</pre>";

        // mysqli_free_result($id);
        // echo "<pre>";
        // print_r($arr_id);
        // // foreach($arr_id as $nilai)
        // // echo $nilai.PHP_EOL;
        // echo "</pre>";  
        

        // $id = mysqli_query($link,"SELECT user_id FROM demo_user");
        // while ($row = mysqli_fetch_array($id))
        // {
        //   $nilai = $row[0];
        //   //echo $nilai.'<br>';

        //   $arr_n = explode('<br>',$nilai);
         
 
        //   echo $arr_n[0];
          //print_r($coba);
       // }
        // $coba = array(Array (57),Array (60),Array (61),Array (62),Array (63),Array (64),Array (65),Array (70),Array (71),Array (72),Array (126));
      
        // foreach ($coba as $v)
        //     {
        //       var_dump($v[0]);
        //     }
          $v = '0';
        

        $sql = mysqli_query($link,"SELECT * from demo_user WHERE user_id='$arr_id[$v]'");

        while ($baris = mysqli_fetch_array($sql))
        {
          $value = $baris[1];

          $sql2 	= "select * from demo_log where user_name = '$value' and data like '%$tgl%' ;";
          $result	= mysqli_query($link,$sql2);

          echo $value;
          //print_r($result);

              if (mysqli_num_rows($result) > 0)
              {
                echo "<br>";
                echo "data ditemukan";
              } else 
              {
                echo "<br>";
                echo "data tidak ditemukan";
              }

              echo ' pada tanggal hari ini: '.$tgl;
              echo '<br>';

          //$arr_value = explode (',' , $value);

         // print_r($value);
          //print_r($arr_value);

          // echo $arr_value[0];

            // foreach ($arr_value as $v)
            // {
            //   echo $num.'. '.$v.'<br/>';
            // }

       //   var_dump($arr_value);
        }
?>



        							<?php
        								$Tampil = "SELECT user_name FROM demo_user";
                        $result = mysqli_query($link,$Tampil);

                        $mantra = mysqli_query($link,"SELECT * FROM demo_user");
                        $itung = mysqli_num_rows($mantra);
                        
                        for ($i = 1; $i <= $itung; $i++)
                        {
                          echo "Ini jumlah data username<br/>";
                        }

        								while($row = mysqli_fetch_array($result)){

                          $value = $row['user_name'];

                          echo $value.'<br/>';
                          $arr_v = explode('<br>',$value);

                          //var_dump($arr_v);
        									//echo "<option>$row[user_name]</option>";
        								}
        							?>

