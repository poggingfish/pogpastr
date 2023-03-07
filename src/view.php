<?php
    require("config.php");
    $paste = $_GET['view'];
    if ($paste){
        $db = new PDO("sqlite:$dbFile");
        $stmt = $db->prepare("SELECT * FROM pastes WHERE PasteID=?;");
        $x = $stmt->execute([$paste]);
        if(!$x){
            echo "There was a server error.";
            die();
        }
        $ctr = 0;
        foreach ($stmt->fetchAll() as $t){
            $paste = $t["Paste"];
            $ctr++;
        }
        if ($ctr == 0){
            echo "This paste doesnt exist.";
            die();
        }
        if ($_GET['raw'] == "true"){
            echo $paste;
            die();
        }
    }
    else{
        echo "Invalid request.";
        die();
    }
    echo str_replace("\$_license_replace",$license_paste_id,file_get_contents("header.html"))
?>
    <form>
        <div style="background-color: #FFFFFF; width: 75%; height: 75%;" class=content><textarea readonly style="font-size: 18px;height: 100%; width: 100%; resize: none;"><?php echo "$paste" ?></textarea>
        </div>
    </form>
</body>
</html>