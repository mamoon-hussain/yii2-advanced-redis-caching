<?php
/**
 * Created by PhpStorm.
 * User: Anas Mattar
 * Date: 11/23/2018
 * Time: 10:10 PM
 */
namespace common\traits;
use common\models\ModelFactory;
use common\models\Queue;
use yii\base\Exception;

trait ExportSql
{
    public $form_date;
    public $to_date;

    public function export()
    {

        $rows = self::find();
        $sql = '';
        if (!empty($this->form_date)) {

        }
        $rows = $rows->all();
        $sql = self::deleteSql($rows);
        $sql .= self::insertSql($rows);
        $sql .= self::updateSql($rows);
        $sql = 'SET FOREIGN_KEY_CHECKS=OFF; START TRANSACTION; ' . PHP_EOL . $sql . PHP_EOL . ' COMMIT; SET FOREIGN_KEY_CHECKS=ON;' . PHP_EOL;
        return $sql;
    }


    public static function deleteSql($rows)
    {
        $text = '';
        foreach ($rows as $row) {
            if($row->operation==Queue::DELETED) {
                $data = json_decode($row->text, true);
                if (!is_null($data)) {
                    $text .= 'DELETE FROM ' . $row->table_name . ' WHERE `id`=' . $data['id'] . ';'.PHP_EOL;
                }
            }
        }
        return $text;
    }

    public static function insertSql($rows)
    {
        $text='';
        foreach ($rows as $row) {
            if($row->operation==Queue::INSERTED) {
                $find=ModelFactory::getModelWithOutRelation($row->table_name);
                if(!is_null($find)) {
                    $text.=self::insertStatment($row);
                }
            }
        }
        try {
            foreach ($rows as $row) {
                if ($row->operation == Queue::INSERTED) {
                    $find = ModelFactory::getModelWithRelation($row->table_name);
                    if (!is_null($find)) {
                        $text .= self::insertStatmentWithRelation($row);
                    }

                }
            }
        }catch(Exception $e) {
            var_dump($e->getMessage());
            die();
        }


        return $text;
    }


    public static function updateSql($rows)
    {
        $text='';
        foreach ($rows as $row) {
            if($row->operation==Queue::UPDATED) {
                $find=ModelFactory::getModelWithOutRelation($row->table_name);
                if(!is_null($find)) {
                    $text.=self::updateStatment($row);
                }
            }
        }

        foreach ($rows as $row) {
            if ($row->operation == Queue::UPDATED) {
                $find = ModelFactory::getModelWithRelation($row->table_name);
                if (!is_null($find)) {
                    $text .= self::updateStatmentWithRelation($row);
                }
            }
        }


        return $text;
    }

    public static function insertStatment($row)
    {
        $data = json_decode($row->text, true);
        $temp_key = '';
        $temp_value = '';
        $text = '';
        foreach ($data as $key => $value) {
            if (strpos($key, '_symbol') !== false) {
                continue;
            }
            $temp_key .= ($temp_key != '' ? ' , ' : '') . ('`' . $key . '`');
            $temp_value .= ($temp_value != '' ? ' , ' : '') . (self::setType($key, $value));
        }

        if (!empty($temp_value) && !empty($temp_key)) {
            $text = 'INSERT INTO `' . $row->table_name . '` ( ' . $temp_key . ') VALUES (' . $temp_value . ');'.PHP_EOL;
        }
        return $text;
    }


    public static function updateStatment($row){
        $data = json_decode($row->text, true);
        $temp_update='';
        $text = '';
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            if (strpos($key, '_symbol') !== false) {
                continue;
            }
            $temp_update .= ($temp_update != '' ? ' , ' : '') . ("`$key`=" . self::setType($key, $value));
        }

        if (!empty($temp_update)) {
            $variable = '@' . $row->table_name . '_symbol_' . $data['symbol'];
            $text_with_variable = "SET $variable=(SELECT `" . $row->table_name . "`.`id` FROM `" . $row->table_name . "` WHERE `symbol`='" . $data['symbol'] . "');".PHP_EOL;
            $text = 'UPDATE `' . $row->table_name . '` SET ' . $temp_update . ' WHERE `symbol` = ' . $variable . ';'.PHP_EOL;
            $text = $text_with_variable . $text;
        }
        return $text;
    }


    public static function insertStatmentWithRelation($row)
    {
        $data = json_decode($row->text, true);
        $temp_key = '';
        $temp_value = '';
        $text = '';
        $text_with_variable = '';
        $items = ModelFactory::getModelForeignKeys($row->table_name);
        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            if (strpos($key, '_symbol') !== false) {
                continue;
            }
            $temp_key .= ($temp_key != '' ? ' , ' : '') . ('`' . $key . '`');
            $value_string = self::setType($key, $value);
            if (array_key_exists($key, $items)) {
                if (isset($data[$key . '_symbol'])) {
                    $variable = '@' . $key . '_' . $data[$key . '_symbol'];
                    $text_with_variable .= "SET $variable=(SELECT `" . $items[$key] . "`.`id` FROM `" . $items[$key] . "` WHERE `symbol`='" . $data[$key . '_symbol'] . "');" . PHP_EOL;
                    $value_string = $variable;
                }
            }
            $temp_value .= ($temp_value != '' ? ' , ' : '') . $value_string;
        }
        if (!empty($temp_value) && !empty($temp_key)) {
            $text = 'INSERT INTO `' . $row->table_name . '` ( ' . $temp_key . ') VALUES (' . $temp_value . ');'.PHP_EOL;
        }
        $text = $text_with_variable . $text;
        return $text;
    }


    public static function updateStatmentWithRelation($row)
    {
        $data = json_decode($row->text, true);
        $temp_update = '';
        $text = '';
        $text_with_variable = '';
        $items = ModelFactory::getModelForeignKeys($row->table_name);

        foreach ($data as $key => $value) {
            if ($key == 'id') {
                continue;
            }
            if (strpos($key, '_symbol') !== false) {
                continue;
            }
            $temp_update .= ($temp_update != '' ? ' , ' : '') . ("`$key`=" . self::setType($key, $value));
            $value_string = self::setType($key, $value);
            if (array_key_exists($key, $items)) {
                $variable = '@' . $key . '_' . $data[$key . '_symbol'];
                $text_with_variable .= "SET $variable=(SELECT `" . $items[$key] . "`.`id` FROM `" . $items[$key] . "` WHERE `symbol`='" . $data[$key . '_symbol'] . "');".PHP_EOL;
                $value_string = $variable;
            }
        }
        if (!empty($temp_update)) {
            $variable = '@' . $row->table_name . '_symbol_' . $data['symbol'];
            $_variable = "SET $variable=(SELECT `" . $row->table_name . "`.`id` FROM `" . $row->table_name . "` WHERE `symbol`='" . $data['symbol'] . "');".PHP_EOL;
            $text = $_variable . 'UPDATE `' . $row->table_name . '` SET ' . $temp_update . ' WHERE `symbol` = ' . $variable . ';'.PHP_EOL;
        }
        $text = $text_with_variable . $text;
        return $text;
    }


    public static function setType($key,$value)
    {
        if ($key == 'id') {
            return 'NULL';
        }
        if (!is_null($value)) {
            if($value=='\\') {
                $value = '\\\\';
            }
            $value = str_replace("'", "\'", $value);
            return "'$value'";
        } else {
            return 'NULL';
        }
    }
}