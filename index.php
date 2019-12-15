<?php
include_once('header.php');

$query = "SELECT * FROM `Stations`";
$stmt = $db->prepare($query);
$stmt-> execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

//echo var_dump($_SESSION);

if(!$data)
{
    die('invalid query'. mysql_error());
}
#echo var_dump($data);
//echo var_dump($_POST);
if (isset($_POST['stationlist']))
{
    //echo $_POST['stationlist'];
    $url = 'https://dv.njtransit.com/webdisplay/tid-mobile.aspx?sid=' . $_POST['stationlist'];
    //echo $url;
    if ( $_POST['stationlist']!=''){
        header("Location: ".$url);
    }
}
?>

<section class="container">
    <br>
    <div class="bs-component">
        <div class="jumbotron">
            <div align="center">
                <img style="height: 450px; width: 100%; display: block;" src="https://cdn.abcotvs.com/dip/images/4182118_090818-wabc-ap-nj-transit-img.jpg?w=800&r=16%3A9">
            </div>
        </div>
    </div>

    <div class="bs-component">
        <div class="jumbotron">
            <div class="card text-white bg-primary mb-3" style="max-width:500rem;">
                <div class="card-header">Stations</div>
                <div class="card-body">
                    <form method="POST" action="">
                        <select name="stationlist" id="stationlist" class="form-control">
                            <option value=""></option>
                            <?php
                            foreach($data as $row) {
                                echo '<option value="'.$row['STATION 2CHAR'].'">'.$row['STATION NAME'].'</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" value="SUBMIT" class="form-control">
                    </form>
                    <script>
                        var url='';
                        $("#stationlist").on("change",function(){
                            //Getting Value
                            var selValue = $("#stationlist").val();
                            //Setting Value
                            $url = 'https://dv.njtransit.com/webdisplay/tid-mobile.aspx?sid=' + selValue;
                            $("#textf").val(url);
                            //$("#thebutton span").text(selValue);
                        });
                        $('#submit').click(function(){
                            window.location.href = $url;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once('footer.php');
?>
