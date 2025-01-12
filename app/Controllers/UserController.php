<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        $data['success'] = session()->getFlashdata('success');
        $data['error'] = session()->getFlashdata('error');
        return view('users/index',$data);
    }

    public function create() {
        return view('users/create', [
            'success' => session()->getFlashdata('success'),
            'error' => session()->getFlashdata('error'),
        ]);
    }
    
    public function store()
    {
        $model = new UserModel();
        
        // Validation rules
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Name is required',
                    'min_length' => 'Name must be at least 3 characters long',
                    'max_length' => 'Name cannot exceed 50 characters'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email address',
                    'is_unique' => 'This email is already registered'
                ]
            ],
            'phone' => [
                'rules' => 'required|min_length[10]|max_length[15]|numeric',
                'errors' => [
                    'required' => 'Phone number is required',
                    'min_length' => 'Phone number must be at least 10 digits',
                    'max_length' => 'Phone number cannot exceed 15 digits',
                    'numeric' => 'Phone number must contain only numbers'
                ]
            ],
            'desc' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Description is required',
                    'min_length' => 'Description must be at least 10 characters long'
                ]
            ],
            'gender' => [
                'rules' => 'required|in_list[male,female,other]',
                'errors' => [
                    'required' => 'Gender is required',
                    'in_list' => 'Please select a valid gender'
                ]
            ],
            'skills' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please select at least one skill'
                ]
            ],
            'profile' => [
                'rules' => 'uploaded[profile]|max_size[profile,1024]|mime_in[profile,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Please select a profile image',
                    'max_size' => 'Profile image size should not exceed 1MB',
                    'mime_in' => 'Only JPG, JPEG and PNG files are allowed'
                ]
            ]
        ];

        // Run validation
        if (!$this->validate($rules)) {
            // If validation fails, return to form with errors
            return redirect()->back()
                           ->withInput()
                           ->with('error', $this->validator->getErrors());
        }

        // If validation passes, process the file upload
        $file = $this->request->getFile('profile');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $profilePath = 'uploads/' . $newName;
        } else {
            $profilePath = null;
        }

        // Save the data
        $success = $model->save([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'desc'    => $this->request->getPost('desc'),
            'profile' => $profilePath,
            'gender'  => $this->request->getPost('gender'),
            'skills'  => implode(',', $this->request->getPost('skills')),
            'status'  => 1,
        ]);

        if ($success) {
            session()->setFlashdata('success', 'User created successfully!');
        } else {
            session()->setFlashdata('error', 'Failed to create user.');
        }

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        if (!$data['user']) {
            session()->setFlashdata('error', 'User not found');
            return redirect()->to('/users');
        }
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();
        
        // Check if user exists
        $user = $model->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'User not found');
            return redirect()->to('/users');
        }

        // Validation rules for update
        $rules = [
            'name' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Name is required',
                    'min_length' => 'Name must be at least 3 characters long',
                    'max_length' => 'Name cannot exceed 50 characters'
                ]
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[users.email,id,$id]",
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email address',
                    'is_unique' => 'This email is already registered'
                ]
            ],
            'phone' => [
                'rules' => 'required|min_length[10]|max_length[15]|numeric',
                'errors' => [
                    'required' => 'Phone number is required',
                    'min_length' => 'Phone number must be at least 10 digits',
                    'max_length' => 'Phone number cannot exceed 15 digits',
                    'numeric' => 'Phone number must contain only numbers'
                ]
            ],
            'desc' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Description is required',
                    'min_length' => 'Description must be at least 10 characters long'
                ]
            ],
            'gender' => [
                'rules' => 'required|in_list[male,female,other]',
                'errors' => [
                    'required' => 'Gender is required',
                    'in_list' => 'Please select a valid gender'
                ]
            ],
            'skills' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Please select at least one skill'
                ]
            ]
        ];

        // Add profile validation only if a new file is uploaded
        if ($this->request->getFile('profile')->isValid()) {
            $rules['profile'] = [
                'rules' => 'max_size[profile,1024]|mime_in[profile,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Profile image size should not exceed 1MB',
                    'mime_in' => 'Only JPG, JPEG and PNG files are allowed'
                ]
            ];
        }

        // Run validation
        if (!$this->validate($rules)) {
            // If validation fails, return to form with errors
            return redirect()->back()
                           ->withInput()
                           ->with('error', $this->validator->getErrors());
        }

        // Process file upload if new file is provided
        $file = $this->request->getFile('profile');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $profilePath = 'uploads/' . $newName;
        } else {
            $profilePath = $user['profile'];
        }

        // Update the data
        $success = $model->update($id, [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'desc'    => $this->request->getPost('desc'),
            'profile' => $profilePath,
            'gender'  => $this->request->getPost('gender'),
            'skills'  => implode(',', $this->request->getPost('skills')),
            'status'  => 1,
        ]);

        if ($success) {
            session()->setFlashdata('success', 'User updated successfully!');
        } else {
            session()->setFlashdata('error', 'Failed to update user.');
        }

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/users');
    }
}
