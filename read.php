<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'conecta.php';
include_once 'colaborador.php';

$database = new Database();
$db = $database->getConnection();

$items = new Colaborador($db);

$stmt = $items->getColaborador();
$itemCount = $stmt->rowCount();


if ($itemCount > 0) {

    $ColaboradorArr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $e = array(
            "Nome" => $Nome,
            "Gender" => $Gender,
            "GPN" => $GPN,
            "Rank Atual" => $RankAtual,
            "Employee Status" => $EmployeeStatus,
            "País" => $País,
            "SL" => $SL,
            "SUBSL" => $SUBSL,
            "SMUName" => $SMUName,
            "LEAD" => $LEAD,
            "SB" => $SB,
            "HiringDate" => $HiringDate,
            "Avatar" => $Avatar,


        );

        array_push($ColaboradorArr, $e);
    }
    echo json_encode($ColaboradorArr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
