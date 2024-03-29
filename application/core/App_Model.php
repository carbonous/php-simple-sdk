<?php
class App_Model extends CI_Model {

	protected $_table = "";
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getAll($filters = null, $order = false, $page = false)
	{
		$this->db->select();
		$this->db->from($this->_table);
		if (isset($filters) && is_array($filters)) {
			foreach ($filters as $k => $v) {
				if (isset($v) && $v != "") {
					$this->db->where($k, $v);
				} elseif (!isset($v))  {
					$this->db->where($k.' IS NULL');
				}
			}
		}
		if (is_array($order)) {
			foreach ($order as $o => $d) {
				$this->db->order_by($o, $d); 
			}
		} else if (is_bool($order) && $order == true) {
			$this->db->order_by("order", "asc"); 
		}
		if ($page) {
			$this->db->limit(10);
			$this->db->offset(10*($page - 1));
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function find($id, $order = false)
	{
		$this->db->select();
		$this->db->where('id', $id);
		if (is_array($order)) {
			foreach ($order as $o => $d) {
				$this->db->order_by($o, $d); 
			}
		}
		$query = $this->db->get($this->_table);
		$result = $query->result();
		return $result[0];
	}
	
	public function insert($data)
    {
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}
	
	public function update($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->_table, $data);
	}
	
	public function delete($id)
	{
		$this->db->delete($this->_table, array('id' => $id)); 
	}
}
