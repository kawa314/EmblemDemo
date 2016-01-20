<?php
    require_once 'config.php';
/***********************/
/*     データベースクラス    */
/***********************/
    class DB{

        function fetch($sql){
            try{
                $pdo = new PDO(
                    sprintf('mysql:dbname=%s;host=%s;charset=%s',DBNAME,DBHOST,DBCHARSET),
                    DBUSER,
                    DBPASS,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    )
                );
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } catch(PDOException $ei) {
                echo 'Connection failed:'.$e->getMessage();
                exit();
            }
        }

        function execute ($sql){
            try{
                $pdo = new PDO(
                    sprintf('mysql:dbname=%s;host=%s;charset=%s',DBNAME,DBHOST,DBCHARSET),
                    DBUSER,
                    DBPASS,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    )
                );
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $data = $pdo->lastInsertId();
                return $data;
            } catch(PDOException $ei) {
                echo 'Connection failed:'.$e->getMessage();
                exit();
            }
        }
    }


    class SYS{
      /* ハッシュ化 */
      function hash($password){
        return md5($password . SALT);
      }
    }
