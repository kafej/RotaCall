<?php
$usernameATdomain = $_SERVER['REMOTE_USER'];
$ATposition = strpos($usernameATdomain,"@");
$username = substr($usernameATdomain, 0, $ATposition);
$username1 = substr($usernameATdomain, 0, $ATposition);
$usb = strtoupper($username1);

$iddyzu = $_POST['iddyzu'];
$namdyzu = $_POST['namdyzu'];
$action = $_POST["action"];
$textdyz = $_POST['textdyz'];
$dyzdata = $_POST['dyzdata'];
$kontent = $_POST['kontent'];
$emaild = $_POST['emaild'];
$emaildyzm = $_POST['emaildyzm'];
$datawolne = $_POST['datawolne'];
$datadzial = $_POST['datadzial'];
$timea = $_POST['timea'];
$timeb = $_POST['timeb'];
$rmv = $_POST['rmv'];
$dzif = $_POST['dzif'];
$rota1 = $_POST['rota1'];
$rota2 = $_POST['rota2'];
$czasdyz = $_POST['czasdyz'];
$czasdyzdlugi = $_POST['czasdyzdlugi'];

$servername = "localhost";
$usernamer = "root";
$password = "";
$dbname = "dyzur";

$conn = new mysqli($servername, $usernamer, $password, $dbname);
$conn->set_charset("utf8");

$sqln = "SELECT * FROM users WHERE user='$username1'";
$n = $conn->query($sqln);

if ($n->num_rows > 0) {
    while($row = $n->fetch_assoc()) {
        $cut = substr($row["name"], 0, 1);
        $pieces = explode(" ", $row["name"]);
        $surn = $cut . "." . $pieces[1];
        $surnemail = $row["email"];
    }
}

if (strpos($namdyzu, $surn) !== false) {
    $namemail = $surnemail;
} elseif (strpos($namdyzu, $surn) !== false) {
    $namemail = $surnemail;
} elseif (strpos($namdyzu, $surn) !== false) {
    $namemail = $surnemail;
} elseif (strpos($namdyzu, $surn) !== false) {
    $namemail = $surnemail;
} elseif (strpos($namdyzu, $surn) !== false) {
    $namemail = $surnemail;
} elseif (strpos($namdyzu, $surn) !== false) {
    $namemail = $surnemail;
}

if($action=="start") {
    $sql21 = "SELECT * FROM users WHERE user='$username1'";
    $result21 = $conn->query($sql21);

    $array = array();
    while ($row = mysqli_fetch_array($result21)) {
        $array[] = $row;
    }

    echo json_encode($array);
}

if($action=="ludki") {
    $sql21 = "SELECT * FROM godziny WHERE dzialy='$dzif'";
    $result21 = $conn->query($sql21);

    $array = array();
    while ($row = mysqli_fetch_array($result21)) {
        $array[] = $row;
    }

    echo json_encode($array);
}

if($action=="dzi") {
    $sql21 = "SELECT dzialy FROM godziny";
    $result21 = $conn->query($sql21);

    $array = array();
    while ($row = mysqli_fetch_array($result21)) {
        $array[] = $row;
    }

    echo json_encode($array);
}

if($action=="dyzurujacy") {
    $sql21 = "SELECT * FROM users WHERE dzial LIKE '%{$dzif}%'";
    $result21 = $conn->query($sql21);

    $array = array();
    while ($row = mysqli_fetch_array($result21)) {
        $array[] = $row;
    }

    echo json_encode($array);
}

if($action=="czas") {
    $sql21 = "SELECT * FROM users WHERE user='$username1'";
    $result21 = $conn->query($sql21);
    
    while ($row=mysqli_fetch_row($result21))
      {
        $v = $row[4];
    
        $sql22 = "SELECT * FROM godziny WHERE dzialy='$datadzial'";
        $result22 = $conn->query($sql22);
    
        $array = array();
        while ($row = mysqli_fetch_array($result22)) {
            $array[] = $row;
        }
    
        echo json_encode($array);
      }
    
    mysqli_free_result($result21);
}

if($action=="wolne") {
    $sql21 = "SELECT * FROM users WHERE user='$username1'";
    $result21 = $conn->query($sql21);
    
    while ($row=mysqli_fetch_row($result21))
      {
        $v = $dzif;
    
        $sql22 = "SELECT * FROM dzialy WHERE nazwa='$v'";
        $result22 = $conn->query($sql22);
    
        $array = array();
        while ($row = mysqli_fetch_array($result22)) {
            $array[] = $row;
        }
    
        echo json_encode($array);
      }
    
    mysqli_free_result($result21);
}

if($action=="mail") {
    require_once 'vendor/autoload.php';
    $mail = new PHPMailer;

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'poczta.';
    $mail->SMTPAuth = true;
    $mail->Username = 'skrypty@';
    $mail->Password = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Add a recipient
    $mail->addAddress($namemail);

    $mail->setFrom($surnemail);

    $mail->addCC($surnemail);

    // Email subject
    $mail->Subject = "Dyzur $dzif - $surn Prosi o zmianę w dniu $dyzdata. DyżurFiltr";

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = "<h1>$surn Prosi o zmianę w dniu $dyzdata.</h1><p>$textdyz</p>";
    $mail->Body = $mailContent;
    $mail->CharSet = "UTF-8";

    // Send email
    $mail->send();
}

if($action=="specjalna") {
    // Include and initialize phpmailer class
    require_once 'vendor/autoload.php';
    $mail = new PHPMailer;

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'poczta.';
    $mail->SMTPAuth = true;
    $mail->Username = 'skrypty@';
    $mail->Password = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Add a recipient
    $mail->addAddress('michal.zbyl@');

    // Email subject
    $mail->Subject = "Dyzur - Kierownik Dyżury ruszył. DyżurFiltr";

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = "<h1>Kierownik Dyżury ruszył.</h1>";
    $mail->Body = $mailContent;
    $mail->CharSet = "UTF-8";

    // Send email
    $mail->send();
}

if($action=="emailwyslij") {
    // Include and initialize phpmailer class
    require_once 'vendor/autoload.php';
    $mail = new PHPMailer;

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'poczta.';
    $mail->SMTPAuth = true;
    $mail->Username = 'skrypty@';
    $mail->Password = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Add a recipient
    $mail->addAddress($emaild);

    $mail->setFrom("skrypty@");

    // Email subject
    $mail->Subject = "Dyzur $dzif na miesiąc $emaildyzm. DyżurFiltr";

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = "<p>$emaildyzm</p><style>.date {text-align: left;vertical-align: top;} .Weekendt {font-size: 10px; !important; float: right;} div.bx {min-width: 4px; max-width: 80px; width: auto; height: 2px; margin-left: auto; margin-right: auto; background-color: red;} td {width: 280px !important;}</style><table border='1'>$kontent</table>";
    $mail->Body = $mailContent;
    $mail->CharSet = "UTF-8";

    // Send email
    $mail->send();
}

if($action=="mailremove") {
    // Include and initialize phpmailer class
    require_once 'vendor/autoload.php';
    $mail = new PHPMailer;

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'poczta.';
    $mail->SMTPAuth = true;
    $mail->Username = 'skrypty@';
    $mail->Password = '';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Add a recipient
    $mail->addAddress($namemail);

    $mail->setFrom($surnemail);

    $mail->addCC($surnemail);

    // Email subject
    $mail->Subject = "Dyzur $dzif - $surn Wycofał prośbę o zmianę  w dniu $dyzdata. DyżurFiltr";

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = "<h1>$surn Wycofał prośbę o zmianę w dniu $dyzdata.</h1>";
    $mail->Body = $mailContent;
    $mail->CharSet = "UTF-8";

    // Send email
    $mail->send();
}

if($action=="addcheck") {
    $sql21 = "SELECT * FROM dyzur WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
    $result21 = $conn->query($sql21);

    if (mysqli_num_rows($result21)) {
        $array = array();
        while ($row = mysqli_fetch_array($result21)) {
            $array[] = $row;
        }
        echo json_encode($array);
    }
}

if($action=="timea") {
    $sql21 = "SELECT * FROM users WHERE user='$username1'";
    $result21 = $conn->query($sql21);
    
    while ($row=mysqli_fetch_row($result21))
      {
        $v = $row[4];
        $sql2 = "UPDATE godziny SET dlugi='$timea', user='$namdyzu' WHERE dzialy='$datadzial'";
        $result2 = $conn->query($sql2);
      }
}

if($action=="timeb") {
    $sql21 = "SELECT * FROM users WHERE user='$username1'";
    $result21 = $conn->query($sql21);
    
    while ($row=mysqli_fetch_row($result21))
      {
        $v = $row[4];
        $sql2 = "UPDATE godziny SET normalny='$timeb', user='$namdyzu' WHERE dzialy='$datadzial'";
        $result2 = $conn->query($sql2);
      }
}

if($action=="adddata") {
    $sql = "INSERT INTO dzialy (nazwa,wolne)
    VALUES ('$datadzial', '$datawolne')";
    $conn->query($sql);
}

if ($action=="removedata") {
    $sql21 = "SELECT * FROM users WHERE user='$username1'";
    $result21 = $conn->query($sql21);

    while ($row=mysqli_fetch_row($result21))
      {
        $v = $row[4];
        $sql21 = "DELETE FROM dzialy WHERE nazwa='$dzif' AND wolne='$rmv'";
        $result21 = $conn->query($sql21);
      }
}

if($action=="add") {
    $sql21 = "SELECT * FROM dyzur WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
    $result21 = $conn->query($sql21);

    if (mysqli_num_rows($result21)) {
        
    } else {
        $sql = "INSERT INTO dyzur (id_dyzur,user,datadyzuru,prosba,dzial)
        VALUES ('$iddyzu','$namdyzu','$dyzdata','$textdyz','$dzif')";
        $conn->query($sql);
    }

    $sql1f = "SELECT * FROM users WHERE user='$username1'";
    $result1f = $conn->query($sql1f);
    
    if (mysqli_num_rows($result1f)) {
        while ($row=mysqli_fetch_row($result1f)) { 
            $wd = $row[4].','.$datadzial;
            if (strpos($row[4], $datadzial) !== false) {
            } else {
                $sqlff = "UPDATE users SET dzial='$wd' WHERE user='$username1'";
                $resultff = $conn->query($sqlff);
            }
        }
    }
}

if($action=="add2") {
    $sqla1 = "SELECT * FROM dyzur WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
    $resula1 = $conn->query($sqla1);
    
    while ($row=mysqli_fetch_row($resula1)) {
        if ($row[2]==NULL) {
            $sqlff = "UPDATE dyzur SET user='$namdyzu' WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
            $resultff = $conn->query($sqlff);
        } elseif ($row[3]==$NULL) {
            $sqlff = "UPDATE dyzur SET user2='$namdyzu' WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
            $resultff = $conn->query($sqlff);
        }
    }
}

if($action=="addnd") {
    $sql = "INSERT INTO godziny (dzialy,normalny,dlugi,user,ludki) VALUES ('$rota1', '$czasdyzdlugi', '$czasdyz', '$namdyzu', '$rota2')";
    $conn->query($sql);
}

if($action=="update") {
    $sql21 = "SELECT user FROM dyzur WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
    $result21 = $conn->query($sql21);

    if ($result21->num_rows > 0) {
        while($row = $result21->fetch_assoc()) {
            $sql = "UPDATE dyzur SET upd='$namdyzu', prosba=$textdyz WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
            $conn->query($sql);  
        }
    }
}

if($action=="wycofaj") {
    $sql21 = "SELECT user FROM dyzur WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
    $result21 = $conn->query($sql21);

    if ($result21->num_rows > 0) {
        while($row = $result21->fetch_assoc()) {
            $sql = "UPDATE dyzur SET upd='', prosba='' WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
            $conn->query($sql);  
        }
    }
}

if($action=="showmemore") {
    $sql21 = "SELECT * FROM dyzur WHERE dzial='$dzif'";
    $result21 = $conn->query($sql21);

    $array = array();
    while ($row = mysqli_fetch_array($result21)) {
        $array[] = $row;
    }

    echo json_encode($array);
}

if($action=="delete") {
    $sqld1 = "SELECT * FROM dyzur WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
    $resuld1 = $conn->query($sqld1);
    
    while ($row=mysqli_fetch_row($resuld1))
      {
        if ($row[3]) {
            if ($row[2]==$namdyzu) {
                $sqlff = "UPDATE dyzur SET user='$row[3]' WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
                $resultff = $conn->query($sqlff);

                $sqlfff = "UPDATE dyzur SET user2='' WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
                $resultfff = $conn->query($sqlfff);
            } elseif ($row[3]==$namdyzu) {
                $sqlff = "UPDATE dyzur SET user2='' WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
                $resultff = $conn->query($sqlff);
            }
        } else {
            $sqld2 = "DELETE FROM dyzur WHERE id_dyzur='$iddyzu' AND dzial='$dzif'";
            $resultd2 = $conn->query($sqld2);
        }
      }
}

$conn->close();
?>