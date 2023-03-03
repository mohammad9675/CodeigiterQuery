<?php


class Utility extends CI_Model
{

	public function __construct()
	{
		$this->load->helper("file");
		$this->load->library("AuthLib"); // you can find this library in my other repo named Auth
	}

	public function add($view, $info, $table, $redirectPage, $data = null, $data2 = array(), $data3 = array(), $data4 = array(), $path = 'uploads/', $path2 = 'uploads/', $name = 'files', $name2 = 'files2')
	{


		$this->load->view($view, array('data' => $data, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4));
		if (isset($_POST['submit'])) {
			if (!empty($_FILES['files']['name'])) {
				$file_path = $this->uploadFile2($path, $name);

			}
			if (!empty($_FILES['files2']['name'])) {
				$file_path2 = $this->uploadFile2($path2, $name2);
			}
			$info2 = $info;

			if ($file_path != null) {
				$info2['image_url'] = $file_path;
			}
			if ($file_path2 != null) {
				$info2['file_url'] = $file_path2;
			}
			$res = $this->db->insert($table, $info2);
			if ($res) {
				$_SESSION['success'] = 'Succesfull';
			} else {
				$_SESSION['error'] = 'An error has occured';

			}
			redirect($redirectPage);
		}

	}
	public function addVideo($view, $info, $table, $redirectPage, $data = null, $data2 = array(), $data3 = array(), $data4 = array(), $path = 'uploads/', $path2 = 'uploads/', $name = 'files', $name2 = 'files', $name3= 'files1')
	{


		$this->load->view($view, array('data' => $data, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4));
		if (isset($_POST['submit'])) {
			if (!empty($_FILES['files']['name'])) {
				$file_path = $this->uploadFile2($path, $name);
			}
			if (!empty($_FILES['files2']['name'])) {
				$file_path2 = $this->uploadFile2($path2, $name2);
			}
			if (!empty($_FILES['files1']['name'])) {
				$file_path3 = $this->uploadFile2($path, $name3);
			}
			$info2 = $info;

			if ($file_path != null) {
				$info2['video_link'] = $file_path;
			}
			if ($file_path2 != null) {
				$info2['file_url'] = $file_path2;
			}
			if ($file_path3 != null) {
				$info2['image_url'] = $file_path3;
			}
			$res = $this->db->insert($table, $info2);
			if ($res) {
				$_SESSION['success'] = 'Succesfull';
			} else {
				$_SESSION['error'] = 'An error has occured';

			}
			redirect($redirectPage);
		}

	}
	public function getAll($table)
	{
		$data = $this->db->get($table)->result_array();
		return $data;

	}
	public function getWithId($table,$id,$field='id')
	{
		$this->db->where($field,$id);
		$data = $this->db->get($table)->result_array();
		return $data;
	}
	public function singleGet($table,$id,$field,$nuid)
	{
		$this->db->where($field,$id);
		$data = $this->db->get($table)->row();
		return $data->$nuid;
	}
	public function getAllJoin($view, $table, $joiner, $field, $field2, $option = null, $option2 = null, $option3 = null, $option4 = null,$data2=null,$condition=null,$condition_field=null)
	{
		$this->db->select('*,' . $option . ',' . $option2 . ',' . $option3 . ',' . $option4);
		$this->db->from($table);
		if ($condition!==null){

			$this->db->where($condition_field,$condition);
		}
		$this->db->join($joiner, $table . '.' . $field . '=' . $joiner . '.' . $field2);
		$data = $this->db->get()->result_array();
		$this->load->view($view, array('data' => $data,'data2'=>$data2));

	}



	public function getById($view, $table, $field, $id, $table2 = null, $field2 = null, $id2 = null,$data3=null,$departments=null,$data4=null,$data5=null,$data6=null,$data7=null)
	{

		$this->db->where($field, $id);
		$data = $this->db->get($table)->result_array();
		if ($table2 != null) {
			$this->db->where($field2, $id2);
			$data2 = $this->db->get($table2)->result_array();
			$this->load->view($view, array('data' => $data, 'data2' => $data2,'data3'=>$data3,'departments'=>$departments,'data4'=>$data4,'data5'=>$data5,'data6'=>$data6,'data7'=>$data7));

		}else{

			$this->load->view($view, array('data' => $data,'data3'=>$data3,'departments'=>$departments,'data4'=>$data4,'data5'=>$data5,'data6'=>$data6,'data7'=>$data7));

		}
	}

	public function edit($view, $table, $filed, $id, $info, $redirectPage, $table2 = null, $path = 'uploads/', $path2 = 'uploads/', $name = 'files', $name2 = 'files2', $data3 = null)
	{
		$this->db->where($filed, $id);
		$data = $this->db->get($table)->result_array();

		if ($table2 != null) {
			$data2 = $this->db->get($table2)->result_array();

		}
		$this->load->view($view, array('data' => $data, 'data2' => $data2, 'data3' => $data3));
		if (isset($_POST['submit'])) {
			if (!empty($_FILES['files']['name'])) {
				$file_path = $this->uploadFile2($path, $name);
			}
			if (!empty($_FILES['files2']['name'])) {
				$file_path2 = $this->uploadFile2($path2, $name2);
			}
			$info2 = $info;
			if ($file_path != null) {
				$info2['image_url'] = $file_path;
				$image_url = $this->db->get_where($table, array($filed => $id))->row()->image_url;
				unlink($image_url);
			}

			if ($file_path2 != null) {
				$info2['file_url'] = $file_path2;
				$file_url = $this->db->get_where($table, array($filed => $id))->row()->image_url;
				unlink($file_url);
			}
			$this->db->where($filed, $id);
			$res = $this->db->update($table, $info2);
			if ($res) {
				$_SESSION['success'] = 'Succesfull';
			} else {
				$_SESSION['error'] = 'An error has occured';

			}
			redirect($redirectPage);
		}

	}

	public function delete($redirectPage, $table, $field, $id)
	{
		$this->db->from($table);
		$this->db->where($field, $id);
		$res = $this->db->delete();
		if ($res) {
			$_SESSION['success'] = 'Deleted';
		} else {
			$_SESSION['error'] = 'An error has occured';

		}
		redirect($redirectPage);

	}

	public function hash($msg)
	{

		$key = 'someKey!@#$%^&*()_+';
		$encrypted_string = $this->encrypt->encode($msg, $key);
		return $encrypted_string;
	}

	public function unhash($msg)
	{

		$key = 'someKey!@#$%^&*()_+';
		$encrypted_string = $this->encrypt->decode($msg, $key);
		return $encrypted_string;
	}

	public function uploadFile($path = 'uploads/', $name = 'files')
	{

		if (isset($_POST['submit']) && !empty($_FILES[$name]['name'])) {
			$fileCount = count($_FILES['files']['name']);
			for ($i = 0; $i < $fileCount; $i++) {
				$_FILES['file']['name'] = $_FILES[$name]['name'][$i];
				$_FILES['file']['type'] = $_FILES[$name]['type'][$i];
				$_FILES['file']['tmp_name'] = $_FILES[$name]['tmp_name'][$i];
				$_FILES['file']['error'] = $_FILES[$name]['error'][$i];
				$_FILES['file']['size'] = $_FILES[$name]['size'][$i];

				//file upload configuration
				$config['upload_path'] = $path;
				$config['allowed_types'] = 'gif|jpg|png|mp4|pdf|jpeg|mp3|JFIF|png|PNG|svg|SVG|zip|rar';

				//load  upload library
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				//upload file to server
				if ($this->upload->do_upload('file')) {
					//uploaded file data
					$fileData = $this->upload->data();
					$uploadData[$i]['image_url'] = base_url() . $path . $fileData['file_name'];
				}
			}

			if (!empty($uploadData)) {
				$dataa = array();
				for ($i = 0; $i < 4; $i++) {
					@$dataa[$i] = $uploadData[$i]["image_url"];
				}

				return $dataa[0];
			}

		}
	}

	public function UpdateStatus($view, $table, $joiner, $field, $field2,$updateTable,$updateStatus,$redirect,$fieldID='id', $option = null, $option2 = null,$joiner2 = null,$field3 = null,$field4 = null,$field5 = null,$img=null)
	{
		$this->db->select('*,' . $option . ',' . $option2 );
		if ($img){
			$this->db->select($table.'.image_url as im_er');
		}
		$this->db->from($table);
		$this->db->join($joiner, $table . '.' . $field . '=' . $joiner . '.' . $field2);
		if($joiner2) {
			$this->db->join($joiner2, $table . '.' . $field3 . '=' . $joiner2 . '.' . $field4);
		}
		if($field5) {
			$this->db->order_by($updateTable . '.' . $field5, 'DESC');
		}
		$this->db->order_by($updateTable . '.' . $fieldID , 'DESC');
		$data = $this->db->get()->result_array();

		$this->load->view($view, array('data' => $data));
		if(isset($_POST['updateStatus'])) {
			$this->db->set('status', $updateStatus);
			$this->db->where($fieldID,$_POST['updateStatus']);
			$res=$this->db->update($updateTable);
			if ($res){
				redirect($redirect);
			}else return false;
		}
		if(isset($_POST['reject'])) {
			$this->db->where($fieldID,$_POST['reject']);
			$res=$this->db->delete($updateTable);
			if ($res){
				redirect($redirect);
			}else return false;
		}
	}
	public function update($status,$fiield,$table,$redirect)
	{
		$id= $this->uri->segment(5);
		$this->db->set('status',$status);
		$this->db->where($fiield,$id);
		$res=$this->db->update($table);
		if ($res){
			redirect($redirect);
		}
	}
	public function getJOin($table, $joiner, $field, $field2, $option = null, $option2 = null, $option3 = null, $option4 = null,$data2=null)
	{
		$this->db->select('*,' . $option . ',' . $option2 . ',' . $option3 . ',' . $option4);
		$this->db->from($table);
		$this->db->where('status',0);
		$this->db->join($joiner, $table . '.' . $field . '=' . $joiner . '.' . $field2);
		$data = $this->db->get()->result_array();
		return $data;
	}

	public function getWithDate($table,$id,$start,$end,$field1,$field2,$field_id)
	{
		$this->db->where($field1.'>=',$start);
		$this->db->where($field2.'<=',$end);
		$this->db->where($field_id,$id);
		$res=$this->db->get($table)->result_array();
		if ($res){
			return $res;
		}else return false;
	}

	public function insert($table,$info)
	{
		$res=$this->db->insert($table,$info);
		if ($res){
			return true;
		}else return false;

	}


}
