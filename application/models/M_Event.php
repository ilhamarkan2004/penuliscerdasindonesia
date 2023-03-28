<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Event extends CI_Model
{

    private $t_events = 'events';
    private $t_et = 'event_type';

    public function getEvents($event_id = null, $inisial = null, $is_active = null)
    {
        $this->db->select('*, event_type.id as et_id, events.id as e_id, events.desc as e_desc')
            ->from($this->t_events)
            ->join($this->t_et, 'event_type.id = events.event_type_id');
        if ($event_id != null) {
            $this->db->where(['events.id' => $event_id]);
        }

        if ($inisial != null) {
            $this->db->where(['event_type.inisial' => $inisial]);
        }

        if ($is_active != null) {
            if ($is_active == 1 || $is_active == 0) {
                $this->db->where(['events.status' => $is_active]);
            }
        }

        return $this->db->get();
    }

    public function getEventType()
    {
        $this->db->select('id, name_type, inisial')
            ->from($this->t_et);

        return $this->db->get()->result_array();
    }

    public function getEventTypeDetail($inisial)
    {
        $this->db->select('name_type, desc')
            ->from($this->t_et)
            ->where(['inisial' => $inisial]);

        return $this->db->get()->row_array();
    }

    public function postEvent($param)
    {

        $data = [
            'event_type_id' => $param['event_type'],
            'event_name' => $param['event_name'],
            'desc' => $param['desc'],
            'img' => $param['url_img'],
            'link' => $param['link'],
            'start_regist' => $param['start_regist'],
            'end_regist' => $param['end_regist'],
            'status' => $param['status'],
        ];
        $this->db->insert('events', $data);
        return [
            'success' => true
        ];
    }

    public function putEvent($param)
    {
        $data = [
            'event_type_id' => $param['event_type'],
            'event_name' => $param['event_name'],
            'desc' => $param['desc'],
            'img' => $param['url_img'],
            'link' => $param['link'],
            'start_regist' => $param['start_regist'],
            'end_regist' => $param['end_regist'],
            'status' => $param['status'],
        ];
        $this->db->where('id', $param['iE']);
        $this->db->update('events', $data);
        return [
            'success' => true
        ];
    }

    public function deleteEvent($id_event, $ref_file)
    {
        $this->db->trans_start();


        $this->db->delete($this->t_events, ['id' => $id_event]);

        if (file_exists('./' . $ref_file) && $ref_file != '') {
            unlink(FCPATH . $ref_file);
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return [
                'success' => false,
                'message' => 'Gagal ketika hapus data ke databse'
            ];
        } else {
            $this->db->trans_complete();
            return [
                'success' => true,
                'message' => 'Berhasil ubah data'
            ];
        }
    }

    public function cekInisial($inisial)
    {
        $this->db->select('inisial')
            ->from($this->t_et)
            ->where(['inisial' => $inisial]);
        return $this->db->get()->num_rows();
    }
}
