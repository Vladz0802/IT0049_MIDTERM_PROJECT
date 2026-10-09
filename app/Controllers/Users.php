<?php

namespace App\Controllers;

use App\Libraries\ImageUploader;
use App\Models\SaleModel;
use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index(): string
    {
        return view('users/index', [
            'title'  => 'User Accounts',
            'active' => 'users',
            'users'  => (new UserModel())->findAll(),
        ]);
    }

    public function new(): string
    {
        return view('users/new', ['title' => 'Add User', 'active' => 'users']);
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|alpha_numeric|min_length[4]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[3]|max_length[100]',
            'password'  => 'required|min_length[8]|max_length[72]', // bcrypt only uses the first 72 bytes
        ];

        $file = $this->request->getFile('avatar');
        $sent = ImageUploader::wasSent($file);

        if ($sent) {
            $rules['avatar'] = ImageUploader::rules('avatar');
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        (new UserModel())->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'avatar'     => $sent ? (new ImageUploader('avatars'))->store($file) : null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/users')->with('success', 'User added.');
    }

    public function edit($id): string
    {
        $user = (new UserModel())->find($id);
        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('users/edit', [
            'title'  => 'Edit User',
            'active' => 'users',
            'user'   => $user,
        ]);
    }

    public function update($id)
    {
        $model = new UserModel();
        $user  = $model->find($id);
        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        $rules = [
            // is_unique skips this user's own row
            'username'  => "required|alpha_numeric|min_length[4]|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|min_length[3]|max_length[100]',
            'password'  => 'permit_empty|min_length[8]|max_length[72]', // blank = keep the current password
        ];

        $file = $this->request->getFile('avatar');
        $sent = ImageUploader::wasSent($file);

        if ($sent) {
            $rules['avatar'] = ImageUploader::rules('avatar');
        }

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        $newPassword = (string) $this->request->getPost('password');
        if ($newPassword !== '') {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if ($sent) {
            $data['avatar'] = (new ImageUploader('avatars'))->store($file, $user['avatar']);
        }

        $model->update($id, $data);

        // Keep the navbar in sync if people edit their own account
        if ((int) $id === (int) session()->get('userId')) {
            session()->set(['username' => $data['username'], 'fullName' => $data['full_name']]);
        }

        return redirect()->to('/users')->with('success', 'User updated.');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $user  = $model->find($id);
        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ((int) $id === (int) session()->get('userId')) {
            return redirect()->to('/users')->with('error', "You can't delete the account you're logged in with.");
        }

        // Sales record who sold them; deleting that staff member would break the records.
        if ((new SaleModel())->existsWhere(['sold_by' => (int) $id])) {
            return redirect()->to('/users')->with('error', $user['full_name'] . ' has recorded sales and can\'t be deleted.');
        }

        $model->delete($id);
        (new ImageUploader('avatars'))->delete($user['avatar']);

        return redirect()->to('/users')->with('success', 'User deleted.');
    }
}
