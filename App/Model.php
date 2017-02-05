<?php

namespace App;

use App\Exception\ExceptionMulti;

/**
 * Class Model
 * @package App
 */
abstract class Model
{

    public $id;

    /**
     * @return array
     */
    public static function findAll()
    {
        $db = new Db();
        $sql = 'SELECT * FROM11 ' . static::$table;
        return $db->query($sql, [], static::class);
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public static function findOneById($id)
    {
        $db = new Db();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $res = $db->query($sql, [':id' => $id], static::class);

        if (empty($res)) {
            return false;
        } else {
            return $res[0];
        }
    }

    public static function countAll()
    {
        $db = new Db();
        $sql = 'SELECT COUNT(*) AS num FROM ' . static::$table;
        return (int)$db->query($sql, [], static::class)[0]->num;
    }

    protected function update()
    {
        $sets = [];
        $data = [];
        foreach ($this as $key => $value) {
            $data[':' . $key] = $value;
            if ('id' == $key) {
                continue;
            }
            $sets[] = $key . '=:' . $key;
        }
        $db = new Db();
        $sql = 'UPDATE ' . static::$table . ' 
        SET ' . implode(',', $sets) . ' 
        WHERE id=:id';
        return $db->execute($sql, $data);
    }

    protected function insert()
    {
        $data = [];
        $fields = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            $data[':' . $key] = $value;
            $fields[] = $key;
        }
        $db = new Db();
        $sql = 'INSERT INTO ' . static::$table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', array_keys($data)) . ')';

        if (true === $db->execute($sql, $data)) {
            $this->id = $db->findId();
            return true;
        } else {
            return false;
        }

    }

    /**
     * @return bool Если $id == null то insert() иначе update()
     */
    public function save()
    {
        if (null === $this->id) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public function delete()
    {
        $db = new Db();
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id = :id';
        $db->execute($sql, [':id' => $this->id]);
    }

    /**
     * @param array $data
     * @throws ExceptionMulti если размеры полей Article не прошли валидацию
     */
    public function fill(array $data)
    {
        $err = new ExceptionMulti();

        foreach ($data as $key => $value) {

            $validator = 'validate' . ucfirst($key);

            if (method_exists($this, $validator)) {
                $result = $this->$validator($value);
                if (false === $result) {
                    $err->addError(new \Exception('Ошибка поля ' . $key));
                }
            }

            $this->$key = $value;

        }

        if (true === $err->errors()) {
            throw $err;
        }
    }

}