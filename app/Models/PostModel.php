<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    /**
     * table name
     */
    protected $table = "posts";

    /**
     * allowed Field
     */
    protected $allowedFields = [
        'title',
        'content'
    ];

    // public function get_upload(){
    //     return $this->db->table('posts')->get()->getResultArray();
    // }

    // public function insert_gambar($data){
    //     return $this->db->table('posts')->insert_gambar();
    // }

    // public function get_uploads()
    // {
    //     return $this->table->get()->getResultArray();
    // }
    // public function insert_gambar($data)
    // {
    //     return $this->table->insert($data);
    // }
}
