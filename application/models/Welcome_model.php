<?php

/**
 * Welcome_model is for setting and getting on intro and welcome tables
 */
class Welcome_Model extends CI_Model
{
    /**
     * Get Specified attribute (key) and it's details from tableName
     *
     * @param [string] $tableName
     * @param [string] $key
     * @return array
     */
    public function getAttribute($tableName, $key)
    {
        return $this->db
            ->select('attribute_id, attribute_type, attribute_behavior')
            ->from($tableName)
            ->where('attribute_name', $key)
            ->get();
    }

    /**
     * Get attributeDetails for userid and attributeId from details tableName
     *
     * @param string $tableName
     * @param int $userId
     * @param int $attributeId
     * @return array
     */
    public function getAttributeDetail($tableName, $userId, $attributeId)
    {
        return $this->db
            ->select('attribute_id, value')
            ->from($tableName)
            ->where('user_id', $userId)
            ->where('attribute_id', $attributeId)
            ->order_by('date_added', 'DESC')
            ->get();
    }

/**
 * Updates attribute with data based on userID table and attributeId
 *
 * @param int $userId
 * @param string $table
 * @param int $attributeId
 * @param array $data
 * @return affected_rows|false
 */
    public function updateUserAttribute($userId, $attributeId, $table, $data)
    {
        $this->db->where('user_id', $userId);
        $this->db->where('attribute_id', $attributeId);
        if ($this->db->update($table, $data)) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    /**
     * Inserts data array into table
     *
     * @param string $table
     * @param array $data
     * @return affected_rows|false
     */
    public function insertData($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return $this->db->affected_rows();
        } else {
            return false;
        }
    }

    /**
     * Instert visitor ip into data field in table and return inserted id
     *
     * @param string $table
     * @param array $data
     * @return insert_id|false
     */
    public function reserveId($table)
    {
        $ip = $this->input->ip_address();
        $data = array('data' => $ip);
        if ($this->db->insert($table, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /**
     * Gets joined table results of all detail tables based on baseTable
     * and filtered on UserId
     *
     * @param string $baseTable
     * @param int $detailsUserId
     * @return query object|false
     */
    public function getUserAttributesData($baseTable, $detailsUserId)
    {
        $types = $this->getAttributeTypes($baseTable);
        $unionQueries = array();
        foreach ($types as $type) {
            $prepared_table_name = $baseTable . 'Details_' . $type;
            $this->db->get_where($prepared_table_name, array('user_id' => $detailsUserId));
            $unionQueries[] = $this->db->last_query();
        }
        $sql = implode('
        UNION
        ', $unionQueries);
        if (!$this->db->query($sql)) {
            return false;
        } else {
            return $this->db->query($sql);
        }
    }

    /**
     * Get all distinct types of attributes from baseTable
     *
     * @param string $baseTable
     * @return array
     */
    public function getAttributeTypes($baseTable)
    {
        $typesquery = $this->db->distinct()->select('attribute_type')->from($baseTable)->get();
        $types = array();
        foreach ($typesquery->result() as $row) {
            $types[] = $row->attribute_type;
        }
        return $types;
    }

    /**
     * Get speciffic attributes base object from baseTable
     *
     * @param string $baseTable
     * @param int $attributeId
     * @return object row
     */
    public function getAttributeBase($baseTable, $attributeId)
    {
        $query = $this->db->get_where($baseTable, array('attribute_id' => $attributeId));
        return $query->result();
    }

    /**
     * Transfer temp intro form data to user account tables
     * Overwrites existing data!
     *
     * @param string $baseTable
     * @param string $newBaseTable
     * @param int $introUserId
     * @param int $userId
     * @return void
     * 
     * @todo return something useful
     */
    public function saveIntroData($baseTable, $newBaseTable, $introUserId, $userId)
    {
        $introData = $this->getUserAttributesData($baseTable, $introUserId);
        $error = 0;
        foreach ($introData as $key => $value) {
            $attributeId = $value['attribute_id'];
            $attribute = $this->getAttributeBase($baseTable, $attributeId);
            $prepared_table_name = $newBaseTable . 'Details_' . $attribute->attribute_type;
            $data = array(
                'user_id' => $userId,
                'attribute_id' => $attributeId,
                'value' => $value['value']
            );
            $query = $this->getAttributeDetail($prepared_table_name, $userId, $attributeId);
            if ($query->num_rows() > 0)
            {
                //update
                $this->updateUserAttribute($userId, $attributeId, $prepared_table_name, $data);
            } else {
                //insert
                $this->insertData($prepared_table_name, $data);
            }
        }
    }

}
