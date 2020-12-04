<!DOCTYPE html>
<html lang="en">
    <head>
        <title>First</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="w3-container w3-text-white w3-center" style="background-color:black;">
            <h1>DBook</h1>
            <h4>Decentralized Book - To find MISSING people</h4>
        </div>
        <center>
            <div class="w3-container">
            <br><br>
            <form method="post" enctype="multipart/form-data" class="w3-container w3-blue w3-mobile w3-padding-16" style="width:50%;">
                Enter Id:<input type="text" name="vmpid" id="vmpid" class="w3-input" /><br>
                <input type="submit" name="view" id="view" value="View" class="w3-btn w3-black"/>
            </form>
            <?php
                $servername = "localhost";
                $database ="id10711229_butterfly";
                $username = "id10711229_reshma";
                $password = "Code6world";
                $tblname="police_images";
                $connect = mysqli_connect("localhost","id10711229_reshma","Code6world");
                mysqli_select_db($connect,$database);
                if(isset($_POST["view"]) && isset($_POST["vmpid"])) 
                {
                    $vmpidnum = $_POST["vmpid"];
                    $query = "SELECT * FROM police_images WHERE id LIKE '$vmpidnum'";
                    $result = mysqli_query($connect, $query);
                    if($result)
                    {
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '<script>alert("Image checking")</script>';
                            echo '
                                <center>
                                <div class="w3-container w3-mobile" style="width:70%;">
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'"/>
                                    <br/>
                                </div>
                                </center>
                            ';
                            echo "<b>Police ID:</b>"; echo $vmpidnum;
                        }
                    }
                }
            ?>
            </div>
        </center>
    </body>
</html>