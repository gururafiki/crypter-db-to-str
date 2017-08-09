<?php
$servername = "localhost";
$username = "name";
$password = "password";
$dbname = "dbname";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$sql = "SELECT * FROM subscriber";
$result = mysqli_query($conn, $sql);
$query = "SELECT * FROM subscriber_point";
$res = mysqli_query($conn, $query);
?>
<header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Editing using PHP MySQL and jQuery Ajax</title>
    <script type="text/javascript" src="script/1.js"></script>
</header>
<body>
<table class="table table-condensed table-hover table-striped bootgrid-table">
    <?php
    echo "<thead>
    <tr>";
    $fname1 = mysqli_fetch_fields($res);
    $arr1[0] = "pibi_hui";
    $index1=0;
    foreach ($fname1 as $item1) {
        $index1++;
        echo '<th>'.$item1->name.'</th>';
        $arr1[$index1] = $item1->name;
    }
    $fname2 = mysqli_fetch_fields($result);
    $row_cnt = mysqli_num_rows($result);
    $index2=0;
    $arr2[0] = "pibi_hui";
    foreach ($fname2 as $item2) {
        $index2++;
        $arr2[$index2] = $item2->name;
    }
    echo "</tr>
    </thead>
    <tbody>";
    $counter = 0; 
    $row_type[0]="";
    $arr3[0]= "";
    while( $allrows1 = mysqli_fetch_assoc($res) ) {
        $row_type['column_name']=$allrows1[$arr1[1]];
        $row_type['len']=$allrows1[$arr1[2]];
        $row_type['position']=$allrows1[$arr1[3]];
        $row_type['type']=$allrows1[$arr1[4]];
        $result = mysqli_query($conn, $sql);
        while( $allrows2 = mysqli_fetch_assoc($result) ) {
            for ($c=1;$c<=$index2;$c++) {
                $counter++;
                if ($row_type['column_name'] == $arr2[$c]) {
                    $name = $allrows2[$arr2[$c]];
                    if (strlen($name) < $row_type['len']) {
                        if ($row_type['position'] == 'left') {
                            if ($row_type['type'] == 'zero') {
                                $buf=$name;
                                for($y=$row_type['len'];$y>strlen($name);$y--){
                                    $buf='0'.$buf;
                                }
                                $name=$buf;
                            }
                            elseif($row_type['type'] == 'space'){
                                $buf=$name;
                                for($y=$row_type['len'];$y>strlen($name);$y--){
                                    $buf=' '.$buf;
                                }
                                $name=$buf;
                            }
                        }
                        elseif ($row_type['position'] == 'right') {
                            if ($row_type['type'] == 'zero') {
                                $buf=$name;
                                for($y=$row_type['len'];$y>strlen($name);$y--){
                                    $buf=$buf.'0';
                                }
                                $name=$buf;
                            }
                            elseif($row_type['type'] == 'space'){
                                $buf=$name;
                                for($y=$row_type['len'];$y>strlen($name);$y--){
                                    $buf=$buf.' ';
                                }
                                $name=$buf;
                            }
                        }
                    }
                    $arr3[$counter]=$name;
                }
            }
        }
    }
    echo $row_cnt."</br>";//количество строк
    $str= null;
    for ($i=1;$i<=$counter;$i++){
        $str.=$arr3[$i];
    }
    echo $str;
    ?>
    </tbody>
</table>

</body>