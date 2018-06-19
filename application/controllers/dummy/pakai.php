<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pakai extends MY_Controller {

		public function __construct(){
			parent::__construct();
			$this->load->model('dummy/pakai_model', 'pakai_model');
		}

		public function index(){
			$data['all_users'] =  $this->pakai_model->get_all_users();
			$data['view'] = 'dummy/pakai/pakai_list';
//			$data['view'] = 'dummy/pakai/pakai_add';
//                        $data['dummy'] = $this->pakai_model->get_dummy();
			$this->load->view('admin/layout', $data);
		}
		
		public function add(){
			if($this->input->post('submit')){

                                $this->form_validation->set_rules('no_dummy', 'Nomor Dummy', 'trim|required');
                                $this->form_validation->set_rules('no_meter_rusak', 'Nomor Meter Rusak', 'trim|required');
                                $this->form_validation->set_rules('alasan_rusak', 'Alasan Rusak', 'trim|required');
                                $this->form_validation->set_rules('ptgs_pasang', 'Petugas Pasang', 'trim|required');
                                $this->form_validation->set_rules('sisa_pulsa', 'Sisa Pulsa', 'trim|required');
                                $this->form_validation->set_rules('no_hp_plg', 'No HP pelanggan', 'trim|required');
                                $this->form_validation->set_rules('nama_cc', 'Nama Call Center', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['view'] = 'dummy/pakai/pakai_add';
                                        $data['dummy']= $this->pakai_model->get_dummy();
					$this->load->view('admin/layout', $data);
				}
				else{
					$data = array(
                                                'id_meter' => $this->input->post(''),
                                                'no_dummy' => $this->input->post('no_dummy'),
                                                'no_meter_rusak' => $this->input->post('no_meter_rusak'),
                                                'alasan_rusak' => $this->input->post('alasan_rusak'),
                                                'ptgs_pasang' => $this->input->post('ptgs_pasang'),
                                                'sisa_pulsa' => $this->input->post('sisa_pulsa'),
                                                'no_hp_plg' => $this->input->post('no_hp_plg'),
                                                'nama_cc' => $this->input->post('nama_cc'),
                                                'no_dummy' => $this->input->post('no_dummy'),
                                                'aktivasi' => 'non aktif',
                                                'kembali' => 'belum',
                                                'nama' => $this->session->userdata('name'),
                                                'unit' => $this->session->userdata('unit'),
                                                'id_user' => $this->session->userdata('admin_id'),
                                            
                                            
// UPDATE tbl_metdum_stok SET status=NULL, tgl_pakai='$tgl_pakai', tgl_aktivasi=NULL,tgl_kembali=NULL,"
// . "no_meter_rusak='$no_meter_rusak', posko='$nama' WHERE unit ='$unit' && no_dummy='$no_dummy'");
					);
					$data_stok = array(
                                                'tgl_pakai' => $this->input->post('tgl_pakai'),
                                                'tgl_aktivasi' => $this->input->post(NULL),
                                                'tgl_kembali' => $this->input->post(NULL),                                                'tgl_kembali' => $this->input->post(NULL),
                                                'no_meter_rusak' => $this->input->post('no_meter_rusak'),
                                                'posko' => $this->input->post('name'),
                                            
                                        );
                                        
                                        $data_stok = $this->security->xss_clean($data_stok);
					$data = $this->security->xss_clean($data);
                                        $result_stok= $this->update_stok_model->update_stok;
					$result = $this->pakai_model->add_pakai($data);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Added Successfully!');
						redirect(base_url('dummy/pakai'));
					}
				}
			}
			else{
                                $data['view'] = 'dummy/pakai/pakai_add';
                                $data['dummy']= $this->pakai_model->get_dummy();
                                $this->load->view('admin/layout', $data);
			}
			
		}

		public function edit($id = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('firstname', 'Username', 'trim|required');
				$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required');
				$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');
				$this->form_validation->set_rules('user_role', 'User Role', 'trim|required');

				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->pakai_model->get_user_by_id($id);
					$data['view'] = 'dummy/pakai/pakai_edit';
					$this->load->view('admin/layout', $data);
				}
				else{
					$data = array(
						'username' => $this->input->post('firstname').' '.$this->input->post('lastname'),
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'mobile_no' => $this->input->post('mobile_no'),
						'password' =>  password_hash($this->input->post('password'), PASSWORD_BCRYPT),
						'is_admin' => $this->input->post('user_role'),
						'updated_at' => date('Y-m-d : h:m:s'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->edit_user($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Record is Updated Successfully!');
						redirect(base_url('dummy/pakai'));
					}
				}
			}
			else{
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['view'] = 'dummy/pakai/pakai_edit';
				$this->load->view('admin/layout', $data);
			}
		}

		public function del($id = 0){
			$this->db->delete('ci_users', array('id' => $id));
			$this->session->set_flashdata('msg', 'Record is Deleted Successfully!');
			redirect(base_url('dummy/pakai'));
		}

	}


?>