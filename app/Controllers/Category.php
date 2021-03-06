<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Controllers\BaseController;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Category extends BaseController
{
    public function index()

    {
        $category = new CategoryModel();

        $data = [

            'categories' => $category->asObject()
                ->paginate(10),
            'pager' => $category->pager


        ];
        $this->_loadDefaultView(lang('Form.categories_list'), $data, 'index');
    }

    public function new()
    {
        $category = new CategoryModel();
        $validation =  \Config\Services::validation();
        $this->_loadDefaultView(lang('Form.category_create'), ['validation' => $validation, 'category' => new CategoryModel(), 'categories' => $category->asObject()->findAll()], 'new');
    }

    public function create()
    {
        $category = new CategoryModel();

        if ($this->validate('categories')) {
            $id = $category->insert([
                'title' => $this->request->getPost('title')
            ]);
            return redirect()->to("/category/$id/edit")->with('message', lang('Form.category_create_success'));
        }
        return redirect()->back()->withInput();
    }
    public function edit($id = null)
    {
        $category = new CategoryModel();
        if ($category->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $validation =  \Config\Services::validation();
        $this->_loadDefaultView(lang('Form.category_update'), [
            'validation' => $validation,
            'category' => $category->asObject()->find($id)
        ], 'edit');
    }
    public function update($id = null)
    {
        $category = new CategoryModel();
        if ($category->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($this->validate('categories')) {
            $category->update($id, [
                'title' => $this->request->getPost('title')
            ]);
            return redirect()->to('/category')->with('message', lang('Form.category_edit_success'));
        }
        return redirect()->back()->withInput();
    }
    public function delete($id = null)
    {
        $category = new CategoryModel();
        if ($category->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $category->delete($id);
        return redirect()->to('/category')->with('message', lang('Form.category_delete_success'));
    }

    private function _loadDefaultView($title, $data, $view)
    {
        $dataHeader = [
            'title' => $title
        ];
        echo view("dashboard/templates/header", $dataHeader);
        echo view("dashboard/category/$view", $data);
        echo view("dashboard/templates/footer");
    }
}
