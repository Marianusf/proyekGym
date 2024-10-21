<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'idmember';
    protected $allowedFields = ['idmember', 'username', 'email', 'password', 'full_name', 'birth_date', 'adress', 'no_telepon', 'membership_end_date', 'membership_status', 'potoprofil'];
    public function getMemberByIdr($idmember)
    {
        return $this->find($idmember);
    }


    public function updateMembership($idmember, $days)
    {
        $member = $this->find($idmember);
        if ($member) {
            $newEndDate = date('Y-m-d', strtotime($member['membership_end_date'] . " + $days days"));
            $this->update($idmember, [
                'membership_end_date' => $newEndDate,
                'membership_status' => 'active'
            ]);
        }
    }

    public function login($username, $password)
    {
        $user = $this->where('username', $username)
            ->where('password', $password)
            ->findAll();

        return $user; // Mengembalikan array pengguna atau null jika tidak ditemukan
    }
    public function getMembers()
    {
        $allMembers = $this->findAll();
        return $allMembers;
    }

    public function getMember($id)
    {
        return $this->find($id);
    }

    public function updateMember($id, $data)
    {
        $this->update($id, $data);
    }

    public function deleteMember($id)
    {
        $this->delete($id);
    }
    public function searchMembers($keyword, $limit)
    {
        $builder = $this->db->table($this->table);

        // Jika ada keyword, tambahkan kondisi pencarian
        if (!empty($keyword)) {
            $builder->like('full_name', $keyword);
        }

        // Ambil data dengan limit yang diberikan
        return $builder->limit($limit)->get()->getResultArray();
    }
    public function getAccount($username, $password)
    {
        return $this->where('username', $username)
            ->where('password', $password)
            ->first();
    }
    public function saveMember($data)
    {
        return $this->save($data);
    }
    public function getpoto($id)
    {
        return $this->find($id)->potoprofil;
    }
    public function getJumlahMemberAktif()
    {
        return $this->where('membership_status', 'active')->countAllResults();
    }

    // Method untuk mendapatkan jumlah member tidak aktif berdasarkan 'membership_status'
    public function getJumlahMemberTidakAktif()
    {
        return $this->where('membership_status', 'inactive')->countAllResults();
    }
}
