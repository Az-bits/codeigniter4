<?php namespace App\Controllers;
use App\Models\UserModel;
use App\Controllers\BaseController;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Client extends BaseController
{
    public function index()

    {
        $user = new UserModel();
    
        $data = [
            'users' => $user->asObject()
            ->paginate(10),
            'pager' => $user->pager
        ];
        $this->_loadDefaultView('Listado de usuarios', $data, 'index');
    }

    public function new()
    {
        $user = new UserModel();
        $validation =  \Config\Services::validation();
        $this->_loadDefaultView('Crear usuario', ['validation'=>$validation,'user'=>new UserModel()], 'new');
    }
   
    public function create()
    {
        $user = new UserModel();
        helper("user");
        if($this->validate('users')){     
            $id = $user->insert([
                'username'=>$this->request->getPost('username'),
                'email'=>$this->request->getPost('email'),
                'type'=>'admin',
                'password'=>hashPassword($this->request->getPost('password')),

            ]);
            return redirect()->to("/client")->with('message', 'Usuario creado con éxito.');
        }
        return redirect()->back()->withInput();
       
    }
    public function edit($id = null)
    {
        $user = new UserModel();

        if ($user->find($id)==null)
        {
            throw PageNotFoundException::forPageNotFound();
        }
        $validation =  \Config\Services::validation();
        $this->_loadDefaultView('Actualizar usuario', ['validation'=>$validation,
        'user'=>$user->asObject()->find($id)], 'edit');
    }
    public function update($id = null)
    {
        helper("user");
        $user = new UserModel();
        if ($user->find($id)==null)
        {
            throw PageNotFoundException::forPageNotFound();
        }   
        if($this->validate('users_update')){     
            $user->update($id, [
                'password'=>hashPassword($this->request->getPost('password'))
            ]);
            return redirect()->to('/client')->with('message', 'Usuario editado con éxito.');
    
        }
        return redirect()->back()->withInput();
       
    }
    public function delete($id = null)
    {
        $user = new UserModel();
        if ($user->find($id)==null)
        {
            throw PageNotFoundException::forPageNotFound();
        }
        $user->delete($id);
        return redirect()->to('/client')->with('message', 'Usuario eliminado con éxito.');
    }
     
    private function _loadDefaultView($title, $data, $view)
    {
        $dataHeader = [
            'title' => $title
        ];
        echo view("dashboard/templates/header", $dataHeader);
        echo view("dashboard/user/$view", $data);
        echo view("dashboard/templates/footer");
    }
   
}
