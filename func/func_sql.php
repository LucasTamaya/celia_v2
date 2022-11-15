<?php
    function query($sql){
        // Execution de la requete sur le serveur BDD
        $result = mysqli_query($GLOBALS['___mysqli_ston'], $sql);
        if(!$result){
            return false;
        }
        return $result;
    }

    // Insertion en BDD
    // INSERT INTO ma_table ......
    // Nom de table, tableau memoire (colonnes et les valeurs a inserer...)
    function sql_simple_insert($table, $r){
        foreach($r as $key => $val){
            // Gestion securité injection SQL
            $insert[] = '`'.$key.'`';
            $value[] = "'".addslashes($val)."'";
        }
        $sql = "INSERT INTO ".$table." ( ".implode(',',$insert) .") VALUES ( ".implode(',',$value) .");";
        query($sql);
        return @((is_null($___mysqli_res = mysqli_insert_id($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
    }

    function sql_simple_delete($table, $id){
        $sql = "DELETE FROM ".$table." WHERE id='".$id."' LIMIT 1;";
        return query($sql);
    }

    function sql_simple_update($table,$id,$r){
        foreach($r as $key => $value){
            $tmp_set[]=$key."='".addslashes($value)."'";
        }

        $sql="UPDATE ".$table." SET ".implode(', ',$tmp_set)." WHERE id='".$id."' LIMIT 1;";
        //echo "\n".$sql."\n";

        return query($sql);
    }

    function squery($sql, $debug=false){
        $result = query($sql);

        // hack PHP8
        if($result === true || $result === 1)
            return true;
        if(mysqli_num_rows($result) == 1){
            $r = mysqli_fetch_row($result);
            return $r[0];
        }
        if(mysqli_num_rows($result) > 1){
            $r = array();
            while($row = mysqli_fetch_row($result)) $r[]=$row[0];
            return $r;
        }
        return false;
    }


?>