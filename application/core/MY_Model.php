<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * A base model to provide basic CRUD actions for all models that inherit
 * from it.
 * Inspired by Joost van Veen @codeigniter.tv
 * Expanded by Me (Oteng Kwame Appiah Nti)
 * I think this wil be useful :)
 * Note it is not well documented.
 *
 * @author	Oteng Kwame Appiah Nti <developerkwame@gmail.com>
 * @author  Jesse Boyer <contact@jream.com>
 * @license
 * @link
 * @version 1.0
 *
 * A Simple CRUD model
 * - Must have a primary key in your table
 * - Enabled: get, insert, update, insertUpdate, delete to any Model/Table.
 * - Place in your ~/app/core/ folder and extend your models!
 * - Optionally add to ~/app/config/autoload.php: $autoload['model']
 *
 * @usage:
 *
 *  class User_Model extends CRUD_model {
 *
 *      $_table       = 'user';
 *      $_primary_key = 'user_id';'
 *
 *      // Optional Fetch mode (Default is array)
 *      $_fetch_mode = 'object|array';
 *
 *      public function __construct() {
 *          parent::__construct();
 *      }
 *  }
 *
 * Use without Model
 *
 * $crud = new CRUD_model();
 * $crud->setOptions('user', 'user_id');
 * $crud->get();
 *
 * @examples:
 *
 *  GET ALL
 *      $this->user_model->get();
 *
 *  GET PK (defined in your model) is 25
 *      $this->user_model->get(25);
 *
 *  GET CUSTOM COLUMN
 *      $this->user_model->get('email', 'test@test.com');
 *
 *  GET ALL WHERE
 *      $this->user_model->get(array('user_type'=>'admin', 'other' => 1));
 *
 *  INSERT
 *      $this->user_model->insert(['name' => 'jesse', 'age' => 28]);
 *
 *  UPDATE PK (defined in your model) is 12
 *      $this->user_model->update(['age' => 29], 12);
 *
 *  UPDATE CUSTOM COLUMN
 *      $this->user_model->update(['age' => 0], 'name', 'jesse');
 *
 *  DELETE (defined in your model) is 17
 *      $this->user_model->delete(17);
 *
 *  DELETE CUSTOM COLUMN
 *      $this->user_model->delete(['age' => 29]);
 *
 */


class MY_Model extends CI_Model {

    public $_table;//if any issues access modifier should be changed to public
    public $_primary_key;

    /**
     * Change the fetch mode if desired
     *
     * @var string $_fetch_mode Optionally set to 'object', default is array
     */
    protected $_fetch_mode = 'array';

    /**
     * Construct the CI_Model
     */
    public function __construct() {
        parent::__construct();

        //$this->load->database();
    }

    /**
     * For using the class without a model
     *
     * @param string $table       Name of the table
     * @param string $primary_key Name of the tables Primary Key
     */
    public function setOptions($table, $primary_key = false)
    {
        $this->_table = $table;
        $this->_primary_key = $primary_key;
    }

    //All functions below are used for retrieving information from the database

    /**
     * Grabs data from a table
     *       OR a single record by passing $id,
     *       OR a different field than the primary_key by passing two paramters
     *       OR by passing an array
     *
     * @param integer|string $id_or_row      (Optional)
     *                                       null    = Fetch all table records
     *                                       number  = Fetch where primary key = $id
     *                                       string  = Fetch based on a different column name
     *                                       array   = Fetch based on array criteria
     *
     * @param integer|string $optional_value (Optional)
     * @param string         $order_by (Optional)
     *
     * @return object database results
     */
    public function get($id_or_row = null, $optional_value = null, $order_by = null)
    {
        // Custom order by if desired
        if ($order_by != null) {
            $this->db->order_by($order_by);
        }

        // Fetch all records for a table
        if ($id_or_row == null) {
            $query = $this->db->get($this->_table);
        } elseif (is_array($id_or_row)) {
            $query = $this->db->get_where($this->_table, $id_or_row);
        } else {
            if ($optional_value == null) {
                $query = $this->db->get_where($this->_table, array($this->_primary_key => $id_or_row));
            } else {
                $query = $this->db->get_where($this->_table, array($id_or_row => $optional_value));
            }
        }

        if ($this->_fetch_mode == 'array') {
            return $query->result_array();
        } else {
            return $query->result();
        }
    }

    public function getJoin($limit = null, $order_by = null, $join = null, $fields="*")
    {
        if ($order_by != null) {
            $this->db->order_by($order_by);
        }
        if ($join != null) {
            switch ($join) {
                case "dvd":
                    $this->db->join('genre', 'genre.numG = dvd.genre_NumG');
                    $this->db->join('societe', 'societe.numS = dvd.societe_numS');
                    $this->db->select($fields);
                    break;
                case "emprunt":
                    $this->db->join('dvd', 'dvd.numD = emprunt.dvdE');
                    $this->db->join('clients', 'clients.numC = emprunt.clientE');
                    break;
                case "notes":
                    $this->db->join('dvd', 'dvd.numD = notes.dvdN');
                    break;
                case "remarques":
                    $this->db->join('dvd', 'dvd.numD = remarques.dvdR');
                    break;
            }
        }
        if ($limit != null ) {
            $this->db->from($this->_table)->limit($limit);
            $query = $this->db->get();
        } else {
            $this->db->from($this->_table);
        $query = $this->db->get(); }

        if ($this->_fetch_mode == 'array') {
            return $query->result_array();
        } else {
            return $query->result();
        }
    }

    public function getByJoin($id, $join = null, $fields="*")
    {
        if ($join != null) {
            switch ($join) {
                case "dvd":
                    $this->db->join('genre', 'genre.numG = dvd.genre_NumG');
                    $this->db->join('societe', 'societe.numS = dvd.societe_numS');
                    $this->db->select($fields);
                    break;
                case "emprunt":
                    $this->db->join('dvd', 'dvd.numD = emprunt.dvdE');
                    $this->db->join('clients', 'clients.numC = emprunt.clientE');
                    break;
                case "notes":
                    $this->db->join('dvd', 'dvd.numD = notes.dvdN');
                    break;
                case "remarques":
                    $this->db->join('dvd', 'dvd.numD = remarques.dvdR');
                    break;
            }
        }
        $query = $this->db->get_where($this->_table, array($this->_primary_key => $id));

        if ($this->_fetch_mode == 'array') {
            return $query->result_array();
        } else {
            return $query->result();
        }
    }


    public function get_some_fields($fields, $where = null, $limit = null, $order_by = null)
    {
        // Custom order by if desired
        if ($order_by != null) {
            $this->db->order_by($order_by);
        }

        if($limit != null)//$where != null)
        {
            $this->db->select($fields)->from($this->_table)->where($where)->limit($limit);
            $query = $this->db->get();
        }
        else if($where != null)
        {
            $this->db->select($fields)->from($this->_table)->where($where);
            $query = $this->db->get();
        }
        else
        {
            $this->db->select($fields)->from($this->_table);
            $query = $this->db->get();
        }

        if ($this->_fetch_mode == 'array') {
            return $query->result_array();
        } else {
            return $query->result();
        }
    }

    public function get_some_fields_limit($fields, $limit = null)
    {

        if($limit != null)//$where != null)
        {
            $this->db->select($fields)->from($this->_table)->limit($limit);
            $query = $this->db->get();
        }

        if ($this->_fetch_mode == 'array') {
            return $query->result_array();
        } else {
            return $query->result();
        }
    }

    /**
     * Get the total records in the table
     *
     * @param  string|array  $where
     * @return integer
     */
    public function get_total($where = null)
    {
        if (!empty($where))
        {
            $this->db->where($where);
        }

        $this->db->from($this->_table);
        return $this->db->count_all_results();
    }

    /**
     * Get all data from a table
     */

    /**
     *
     * @param string or array $field
     * @param string or array $value
     * @param string or array $orwhere
     * @param string $single
     * @return array
     */
    public function get_by($field, $value = FALSE, $orwhere = FALSE, $single = FALSE)
    {
        //Limit the results to retrieve
        if( !is_array($field))
        {
            $this->db->where( htmlentities( $field ), htmlentities($value));
        }
        else{
            $field = array_map('htmlentities', $field);
            $where_method = $orwhere == TRUE ? 'or_where' : 'where';
            $this->db->where_method($field);
        }

        //Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row_array' : 'result_array';
        return $this->db->get($this->_table)->$method;
    }

    /**
     * Get data by a single field or many fields
     * an alternative to the above function
     * @see get(param...)
     * @param type $field
     * @return type
     */
    public function get_by_fields($value)
    {
        $this->db->select()->from($this->_table)->where($value);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    /**
     * Get data by selecting a field or many fields
     * where the values are provided
     *
     * @param type $field
     * @return type
     */
    public function select_where($field, $value)
    {
        $this->db->select($field)->from($this->_table)->where($value);
        $query = $this->db->get();
        return $query->first_row('array');
    }

    /**
     * Insert a record
     */
    public function save($data)
    {
        //This is an insert
        $this->db->set($data)->insert($this->_table);
        return $this->db->insert_id();
    }

    /**
     * Creates a record
     *
     * @usage  insert(['name' => 'jesse', 'age' => 28])
     *
     * @param     array   $data key value pair of mySQL fields
     *
     * @return    integer  insert id
     */
    public function insert($data)
    {
        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    /**
     * Insert if not exists, if exists Update
     *
     * @usage   insertUpdate(['item' => 10], 25)
     *          insertUpdate(['item' => 10], 'other_key' => 25)
     *
     * @param array $data Associative array [column => value]
     *
     * @param   integer|string $id_or_row (Optional)
     *           null    = Fetch all table records
     *           number  = Fetch where primary key = $id
     *           string  = Fetch based on a different column name
     *
     * @param integer|string $optional_value (Optional)
     *
     * @return integer InsertID|Update Result
     */
    public function insertUpdate($id_or_row, $optional_value = null, $data)
    {
        // First check to see if the field exists
        $this->db->select($this->_primary_key);

        if ($optional_value == null)
        {
            $query = $this->db->get_where($this->_table, array($this->_primary_key => $id_or_row));
        }
        else
        {
            $query = $this->db->get_where($this->_table, array($id_or_row => $optional_value));
        }

        // Count how many records exist with this ID
        $result = $query->num_rows();

        // INSERT
        if ($result == 0)
        {
            $this->db->insert($this->_table, $data);
            return $this->db->insert_id();
        }

        // UPDATE
        if ($optional_value == null) {
            $this->db->where($this->_primary_key, $id_or_row);
        } else {
            $this->db->where($id_or_row, $optional_value);
        }

        return $this->db->update($this->_table, $data);
    }


    /**
     * Update a record
     *
     * @usage   update(['age' => 29], 12);
     *          update(['age' => 0], 'name', 'jesse');
     *
     * @param  array    $data key/value pair to update
     * @param  integer  $id_or_row (Optional)
     * @param  array    $data
     *
     * @return    boolean result
     */
    public function update($id_or_row, $optional_value = null, $data)
    {
        if ($optional_value == null)
        {
            if (is_array($id_or_row))
            {
                $this->db->where($id_or_row);
            }
            else
            {
                $this->db->where(array($this->_primary_key => $id_or_row));
            }
        }
        else
        {
            $this->db->where(array($id_or_row => $optional_value));
        }

        return $this->db->update($this->_table, $data);
    }


    /**
     * update a record
     */
    public function simple_update($data, $where)
    {
        //$this->db->set($data);
        $this->db->where($where);
        return $this->db->update($this->_table,$data);
    }

    /**
     * update a record in string mode
     */
    function update_by_string($data, $where)
    {
        $this->db->query($this->db->update_string($this->_table, $data, $where));
        return;
    }

    /**
     * Delete a record
     *
     * @usage   delete(12)
     *          delete('email', 'test@test.com')
     *          delete(array(
     *              'name' => 'ted',
     *              'age' => 25
     *          ));
     *
     * @param   integer|string|array $id_or_row (Optional)
     *          number  = Delete primary key ID
     *          string  = Column Name
     *          array   = key/value pairs
     *
     * @param integer|string|array $optional_value
     *              (Optional) Use when first param is string
     *
     * @return boolean result
     */
    public function delete($id_or_row, $optional_value = null)
    {
        if ($optional_value == null) {
            if (is_array($id_or_row)) {
                $this->db->where($id_or_row);
            } else {
                $this->db->where(array($this->_primary_key => $id_or_row));
            }
        } else {
            $this->db->where($id_or_row, $optional_value);
        }

        return $this->db->delete($this->_table);
    }

}