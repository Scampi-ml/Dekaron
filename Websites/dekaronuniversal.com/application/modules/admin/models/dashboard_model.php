<?php

class Dashboard_model extends CI_Model
{
    /* Modules */
    public function getEnabledModules()
    {
        $query = $this->db->query("SELECT id, name, display_name, enabled, type, creator, description, date_added FROM modules WHERE enabled = 1");

        if ($query->num_rows() > 0)
            return $query->result_array();

        return null;
    }

    public function getDisabledModules()
    {
        $query = $this->db->query("SELECT id, name, display_name, enabled, type, creator, description, date_added FROM modules WHERE enabled = 0");

        if ($query->num_rows() > 0)
            return $query->result_array();

        return null;
    }

    /* Enable / Disable modules */
    public function enableModule($moduleId)
    {
        $moduleId = (int)$moduleId;

        if (!is_int($moduleId))
            throw new Exception("Not a number");

        $query = $this->db->query("UPDATE modules SET enabled = 1 WHERE id = ?", array($moduleId));

        if ($query)
            return;

        throw new Exception("Could not enable module with id: ".$moduleId);
    }

    public function disableModule($moduleId)
    {
        $moduleId = (int)$moduleId;

        if (!is_int($moduleId))
            throw new Exception("Not a number");

        $query = $this->db->query("UPDATE modules SET enabled = 0 WHERE id = ?", array($moduleId));

        if ($query)
            return;

        throw new Exception("Could not disable module with id: ".$moduleId);
    }
}