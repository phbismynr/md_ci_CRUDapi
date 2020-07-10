<?php  

defined('BASEPATH') OR exit('No direct script access allowed');   

class ServerApi extends CI_Controller {   
    public function add()   
    {   
        $name   = $this->input->post('name');   
        $hp     = $this->input->post('hp');   
        $alamat = $this->input->post('alamat');   

        $data['staff_name']   = $name;   
        $data['staff_hp']     = $hp;   
        $data['staff_alamat'] = $alamat;   
        $q = $this->db->insert('tb_staff', $data);   

        if ($q) {   
            $response['pesan']  = 'insert berhasil';   
            $response['status'] = 200;   
        } else {   
            $response['pesan']  = 'insert error';   
            $response['status'] = 404;   
        }
        echo json_encode($response);   
    }   

    public function update()   
    {   
        $id     = $this->input->post('id');   
        $name   = $this->input->post('name');   
        $hp     = $this->input->post('hp');   
        $alamat = $this->input->post('alamat');   
        $this->db->where('staff_id', $id);   
        
        $data['staff_name']   = $name;   
        $data['staff_hp']     = $hp;   
        $data['staff_alamat'] = $alamat;   
        $q = $this->db->update('tb_staff', $data);   
         
        if ($q) {   
            $response['pesan']  = 'update berhasil';   
            $response['status'] = 200;   
        } else {   
            $response['pesan']  = 'update error';   
            $response['status'] = 404;   
        }   
        echo json_encode($response);   
    }   

    public function delete()   
    {   
        $id = $this->input->post('id');   
        $this->db->where('staff_id', $id);   
        $status = $this->db->delete('tb_staff');   

        if ($status == true) {   
            $response['pesan'] = 'hapus berhasil';   
            $response['status'] = 200;   
        } else {   
            $response['pesan'] = 'hapus error';   
            $response['status'] = 404;   
        }   
        echo json_encode($response);   
    } 

    public function getData()   
    {   
        $q = $this->db->get('tb_staff');   

        if ($q -> num_rows() > 0) {   
            $response['pesan']  = 'data ada';   
            $response['status'] = 200;   
            // 1 row   
            $response['staff'] = $q->row();   
            $response['staff'] = $q->result();   
        } else {  
            $response['pesan']  = 'data tidak ada';   
            $response['status'] = 404;   
        }   
        echo json_encode($response);   
    }   

    public function search(){
        $name   = $this->input->post('name'); 
        $q = $this->db->query('SELECT * FROM tb_staff WHERE staff_name LIKE "%'.$name.'%"');  
         
        if ($q -> num_rows() > 0) {   
            $response['pesan']  = 'data ada';   
            $response['status'] = 200;   
            // 1 row   
            $response['staff'] = $q->row();   
            $response['staff'] = $q->result();   
        } else {  
            $response['pesan']  = 'data tidak ada';   
            $response['status'] = 404;   
        }   
        echo json_encode($response);  
    }
} 
 
/**
 * 
 * CREATE TABLE `android_api2`.`as` ( 
 *      `id` INT(11) NOT NULL AUTO_INCREMENT , 
 *      `name` VARCHAR(255) NOT NULL , 
 *      `lainnya` VARCHAR(255) NOT NULL , 
 *      PRIMARY KEY (`id`)) ENGINE = InnoDB;
 * 
 * INSERT INTO `tb_staff` (`staff_id`, `staff_name`, `staff_hp`, `staff_alamat`) 
 * VALUES (NULL, 'Ismi Nururrizqi', '08987159874', 'tegalwangi talang tegal'), 
 *        (NULL, 'uhuk', '0284375982347', 'apasih yah keder')
 * 
 * http://localhost/android_api2/index.php/serverapi/getdata
 * 
 */