<?php

class Countries
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Countries";
        $this->class_name_lower = "countries_class";
        $this->table_name = "countries";
    }

    public function get_countries ()
    {
        $q = "SELECT * FROM `{$this->table_name}` ORDER BY `country_name`";
        $s = $this->db->prepare($q);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_countries - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }
        if ($s->rowCount() < 1) {
            return ['status' => false, 'data' => 'No country found.'];
        }
        return ['status' => true, 'data' => $s->fetchAll()];
    }

}
