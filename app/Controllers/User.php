<?php
namespace App\Controllers;
use CodeIgniter\Model;
class User extends BaseController
{

    public function index()
    {
        $title = 'Daftar User';
        $model = new UserModel();
        $users = $model->findAll();
        return view('user/index', compact('users', 'title'));
    }

    public function login()
{
    helper(['form']);
    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    if (!$email || !$password) {
        return view('/user/login');
    }

    $session = session();
    $db = \Config\Database::connect();
    $builder = $db->table('user');
    $login = $builder->where('useremail', $email)->get()->getRowArray();

    if ($login) {
        $pass = $login['userpassword'];
        if (trim($password) === trim($pass)) {
            $login_data = [
                'user_id'    => $login['id'],
                'user_name'  => $login['username'],
                'user_email' => $login['useremail'],
                'logged_in'  => true,
            ];
            $session->set($login_data);
            return redirect()->to('/admin/artikel');
        } else {
            $session->setFlashdata("flash_msg", "Password salah.");
            return redirect()->to('/user/login');
        }
    } else {
        $session->setFlashdata("flash_msg", "Email tidak ditemukan.");
        return redirect()->to('/user/login');
    }
}
}