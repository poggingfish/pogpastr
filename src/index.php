<?php
    require("config.php");
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $paste = $_GET['paste'];
    if($paste){
        if($paste != ""){
            if (strlen($paste) <= 15000){
                $id = generateRandomString(25);
                $db = new PDO("sqlite:$dbFile");
                $paste = htmlspecialchars($paste);
                $stmt = $db->prepare("INSERT INTO pastes (PasteID, Paste) VALUES (?, ?);");
                $stmt->execute([$id,$paste]);
                $uri = $_SERVER["HTTP_HOST"];
                header("Location: http://$uri/view.php?view=$id", true, 303);
                die();
            }
            else{
                echo "This paste was too long and couldnt be posted!!";
                die();
            }
        }
    }
    echo file_get_contents("header.html")
?>
    <form>
        <div style="background-color: #443C68; width: 75%; height: 75%; text-align: center;" class=content>
            <textarea maxlength=5000 name=paste style="min-height: 50%; background-color: #635985; max-height: 50%; font-size: 18px; color:#E384FF;max-width: 75%; min-width: 75%;resize: none;margin-top: 10%;"></textarea>
            <br><br><button style="width:75px; height:45px; border-radius: 15%;">Paste!</button>
        </div>
    </form>
</body>
</html>