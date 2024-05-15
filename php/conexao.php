<?php

    $uri = "mysql://avnadmin:AVNS_aUARk8UhMMjvPEyruym@bd-sagg-bd-aiven.b.aivencloud.com:23087/defaultdb?ssl-mode=REQUIRED";

    $fields = parse_url($uri);

    // build the DSN including SSL settings
    $conn = "mysql:";
    $conn .= "host=" . $fields["host"];
    $conn .= ";port=" . $fields["port"];;
    $conn .= ";dbname=bd_sagg_despachante";
    $conn .= ";sslmode=verify-ca;sslrootcert=ca.pem";

    try {
        $conexao = new PDO($conn, $fields["user"], $fields["pass"]);

        $stmt = $conexao->query("SELECT VERSION()");
        //   print($stmt->fetch()[0]);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

?>