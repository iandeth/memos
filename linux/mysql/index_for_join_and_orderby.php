<?php
$conf = require 'bootstrap.php';

# CREATE TABLE boards (
#     id int unsigned PRIMARY KEY,
#     title varchar(100)
# ) ENGINE=InnoDB; 
# 
# CREATE TABLE board_owners (
#     user_id int unsigned,
#     board_id int unsigned,
#     sort_order int unsigned,
#     PRIMARY KEY (user_id, board_id),
#     INDEX uid1 (user_id, sort_order, board_id)
#     /*
#     INDEX uid2 (user_id, board_id, sort_order),
#     INDEX uid3 (user_id, sort_order)
#     */
# ) ENGINE=InnoDB; 
# 
# SELECT * FROM board_owners bo JOIN boards b ON bo.board_id = b.id
# WHERE bo.user_id = 10 ORDER BY bo.sort_order;

$dbh = Zend_Db::factory($conf->database);

## boards
echo "insert boards...\n";
$b_cnt = 100000;
$dbh->query("TRUNCATE TABLE boards");
$sql = "INSERT INTO boards VALUES (?, ?)";
$sth = $dbh->prepare($sql);
for($i=1; $i<=$b_cnt; $i++){
    $sth->execute(array($i, "board $i"));
}

## board_owners
$dbh->query("TRUNCATE TABLE board_owners");
echo "insert board_owners...\n";
$o_cnt = 2;
$sql = "INSERT INTO board_owners VALUES (?, ?, ?)";
$sth = $dbh->prepare($sql);
for($i=1; $i<=$b_cnt; $i++){
    $uid = mt_rand(1, $o_cnt);
    $sort = mt_rand(1, $b_cnt);
    $sth->execute(array($uid, $i, $sort));
}
