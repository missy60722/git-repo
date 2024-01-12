<?php
require_once './DBConnectionHandler.php';

$serverName = "140.127.74.201:9001";
$userName = "root";
$password = "root";
$db = 'bigdata';

DBConnectionHandler::setConnection(
    $serverName,
    $userName,
    $password,
    $db
);
$connection = DBConnectionHandler::getConnection();

//1.1
$sql = "SELECT COUNT(DISTINCT dpoo1_review_sn) AS result FROM edu_bigdata_imp1 WHERE PseudoID=:ID";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':ID',39);
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//1.2
$sql = "SELECT COUNT(DISTINCT dpoo1_review_sn) AS result FROM edu_bigdata_imp1 WHERE PseudoID=:ID AND dpoo1_review_sn != :VAL";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':ID',39);
$stmt->bindValue(':VAL','NA');
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//2.1
$sql = "SELECT DISTINCT dp001_video_item_sn, dp001_indicator FROM edu_bigdata_imp1 WHERE PseudoID = :ID";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':ID',281);
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//2.2
$sql = "SELECT COUNT(*) AS result FROM edu_bigdata_imp1 WHERE PseudoID = :ID AND dp001_prac_score_rate = :SCORE";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':ID',281);
$stmt->bindValue(':SCORE',100);
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//3.1
$sql = "SELECT COUNT(*) AS result FROM edu_bigdata_imp1 WHERE PseudoID = :ID AND dp001_record_plus_view_action = :ACTION";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':ID',71);
$stmt->bindValue(':ACTION','暫停');
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//3.2
$sql = "SELECT DISTINCT DATE(dp001_review_start_time) FROM edu_bigdata_imp1 WHERE PseudoID = :ID";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':ID',71);
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//4.1
$sql = "SELECT dp001_review_sn, COUNT(*) AS frequency FROM edu_bigdata_imp1 GROUP BY dp001_review_sn ORDER BY COUNT(*) DESC LIMIT 1";
$stmt = $pgConn->prepare($sql);
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//4.2
$sql = "SELECT COUNT(*) AS result FROM edu_bigdata_imp1 WHERE dp002_extensions_alignment LIKE :KEYWORD";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':KEYWORD','%十二年國民基本教育類%');
$stmt->bindValue(':VAL','NA');
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//4.3
$sql = "SELECT dp002_verb_display_zh_TW, COUNT(*) AS count FROM edu_bigdata_imp1 GROUP BY dp002_verb_display_zh_TW ORDER BY COUNT(*) DESC LIMIT 3";
$stmt = $pgConn->prepare($sql);
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);

//4.4
$sql = "SELECT COUNT(*) AS result FROM edu_bigdata_imp1 WHERE dp002_extensions_alignment LIKE :KEYWORD";
$stmt = $pgConn->prepare($sql);
$stmt->bindValue(':KEYWORD','%校園職業安全%');
$stmt->execute();
$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
print_r($r);
?>