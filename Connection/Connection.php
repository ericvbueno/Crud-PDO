<?php
abstract class Connection {
    abstract protected function start();
    abstract public function getAll ($query);
    abstract public function getById ($query, $id);
    abstract public function insert($data);
}