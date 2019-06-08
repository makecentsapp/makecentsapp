<?php

/**
 * Form_model is for setting and getting on forms and their tables
 */
class Form_Model extends CI_Model
{
    /**
     * Get and return main attribute IDs and names in array
     *
     * @return array
     */
    public function getTranslationArray() {
    $translationQuery = $this->db
		->select('*')
		->from('main')
		->get();
    foreach ($translationQuery->result_array() as $row) {
        $translationArray[$row['attribute_id']] = $row['attribute_name'];
    }
    return $translationArray;
    }

    /**
     * Get and return query object for Date type fields
     *
     * @param int $user_id
     * @return query object
     */
    public function getDateQuery($user_id) {
        $dateQuery = $this->db
			->select('*')
			->from('mainDetails_datetime')
			->where('user_id', $user_id)
			->order_by('date_added', 'ASC')
            ->get();
        return $dateQuery;
    }

    /**
     * Get and return query object for Decimal type fields
     *
     * @param int $user_id
     * @return query object
     */
    public function getDecimalQuery($user_id) {
        $decQuery = $this->db
			->select('*')
			->from('mainDetails_decimal')
			->where('user_id', $user_id)
			->order_by('date_added', 'ASC')
            ->get();
        return $decQuery;
    }

    /**
     * Get and return query object for VarChar type fields
     *
     * @param int $user_id
     * @return query object
     */
    public function getVarcharQuery($user_id) {
        $vcharQuery = $this->db
			->select('*')
			->from('mainDetails_varchar')
			->where('user_id', $user_id)
			->order_by('date_added', 'ASC')
            ->get();
        return $vcharQuery;
    }
}