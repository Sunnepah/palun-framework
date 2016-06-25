<?php

namespace Palun\Database;

use Application\Config\DBConfig;

abstract class MysqliDBO implements DatabaseInterface {

    protected $mysqli;
    private $_nameQuote = NULL;

    function __construct(){

        $option = array ();
        $option['host'] = DBConfig::$driver['mysql']['host'];
        $option['user'] = DBConfig::$driver['mysql']['username'];
        $option['password'] = DBConfig::$driver['mysql']['password'];
        $option['database'] = DBConfig::$driver['mysql']['database'];

        $this->mysqli = new \mysqli($option['host'], $option['user'], $option['password'], $option['database']);
        $this->mysqli->set_charset("utf8");

    }
    
    public function getAll($table, array $where = NULL) {
        $where = "";
        if(!empty($where)) {
            $where = "";
        }
        
        $query = "SELECT * FROM " . $table . $where;
        return $this->loadObjectList($query);
    }

    public function insert($table, &$object) {
        return $this->insertObject($table, $object);
    }

    public function find($table, $keyName) {
        $query = "SELECT * FROM " . $table . " WHERE id = ". $keyName;
        return $this->loadObject($query);
    }

    public function update($table, &$object, $keyName) {
        return $this->updateObject($table, $object, $keyName);
    }

    public function delete($table, $keyName) {
        $query = "DELETE FROM " . $table . " WHERE id = " . $keyName;
        return $this->loadResult($query);
    }

    private function insertObject($table, &$object, $keyName = NULL) {
        $fmtsql = 'INSERT INTO '.$this->nameQuote($table).' ( %s ) VALUES ( %s ) ';
        $fields = array();
        foreach (get_object_vars( $object ) as $k => $v) {
            if (is_array($v) or is_object($v) or $v === NULL) {
                continue;
            }
            if ($k[0] == '_') { // internal field
                continue;
            }
            $fields[] = $table . "." . $k;
            $v = $this->mysqli->real_escape_string($v);
            $values[] = "'".$v."'";
        }
        $res = $this->mysqli->query( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
        if (!$res) {
            return false;
        }
        $id = $this->mysqli->insert_id;
        if ($keyName && $id) {
            $object->$keyName = $id;
        }
        return true;
    }

    private function updateObject($table, &$object, $keyName, $updateNulls=true) {
        $fmtsql = 'UPDATE '.$this->nameQuote($table).' SET %s WHERE %s';
        $where = "";
        $tmp = array();
        foreach (get_object_vars( $object ) as $k => $v) {
            if( is_array($v) or is_object($v) or $k[0] == '_' ) { // internal or NA field
                continue;
            }
            if( $k == $keyName ) { // PK not to be updated
                $where = $keyName . '=' . "'".$v."'";
                continue;
            }
            if ($v === null)
            {
                if ($updateNulls) {
                    $val = 'NULL';
                } else {
                    continue;
                }
            } else {
                $v = $this->mysqli->real_escape_string($v);
                $val = $v;
            }
            $tmp[] = $this->nameQuote( $k ) . '=' . "'" . $val . "'";
        }
        return $this->mysqli->query( sprintf( $fmtsql, implode( ",", $tmp ) , $where ) );
    }

    private function loadObjectList($query) {
        $data = array();
        $query_result = $this->mysqli->query($query);
        $i = 0;
        while($row = $query_result->fetch_object()){
            $data[$i] = $row;
            $i++;
        }
        return $data;
    }

    private function nameQuote($s) {
        // Only quote if the name is not using dot-notation
        if (strpos( $s, '.' ) === false) {
            $q = $this->_nameQuote;
            if (strlen( $q ) == 1) {
                return $q . $s . $q;
            } else {
                return $q{0} . $s . $q{1};
            }
        }
        else {
            return $s;
        }
    }

    private function loadObject($query){
        $query_result = $this->mysqli->query($query);
        return $query_result->fetch_object();
    }

    private function loadResult($query){
        $result = $this->mysqli->query($query);
        $row = $result->fetch_object();

        if(!empty($row)){
            foreach($row as $key=>$val) {
                return $val;
            }
        }

        return false;
    }
}