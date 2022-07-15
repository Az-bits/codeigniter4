<?php

namespace App\Controllers;

use App\Models\MovieModel;
use App\Models\CategoryModel;
use App\Models\MovieImageModel;
use App\Controllers\BaseController;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Movie extends BaseController
{
    public function index()

    {
        /* $config = new \Config\Web();
        echo $config->siteEmail;
        $config = config('Config\\App');
        echo $config->sitename;
        $this->cachePage(30);
        if(!$movies = cache('movies')){
            echo 'cache no existe';
            $movies = $movie->asObject()
            ->select('movies.*, categories.title as category')
            ->join('categories','categories.id = movies.category_id')
            ->paginate(10);
            cache()->save('movies',$movies,30);

        }else{
            echo 'cache existe';
        }
        echo lang("Form.name");
        $movies = $movie->asObject()
        ->select('movies.*, categories.title as category')
        ->join('categories','categories.id = movies.category_id')
        ->getCompiledSelect();
        // ->paginate(10);
        echo $movies;*/
        $movie = new MovieModel();
        $data = [

            'movies' => $movie->asObject()
                ->select('movies.*, categories.title as category')
                ->join('categories', 'categories.id = movies.category_id')
                ->paginate(10),
            'pager' => $movie->pager
        ];
        $this->_loadDefaultView(lang('Form.movies_list'), $data, 'index');
    }

    public function new()
    {
        $category = new CategoryModel();
        $validation =  \Config\Services::validation();
        $this->_loadDefaultView(
            lang('Form.movie_create'),
            ['validation' => $validation, 'movie' => new MovieModel(), 'categories' => $category->asObject()->findAll()],
            'new'
        );
    }

    public function create()
    {
        $movie = new MovieModel();

        if ($this->validate('movies')) {
            $id = $movie->insert([
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'category_id' => $this->request->getPost('category_id'),
            ]);
            return redirect()->to("/movie/$id/edit")->with('message', lang('Form.movie_create_success'));
        }
        return redirect()->back()->withInput();
    }
    public function edit($id = null)
    {
        $movie = new MovieModel();
        $images = new MovieImageModel();
        $category = new CategoryModel();
        if ($movie->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $validation =  \Config\Services::validation();
        $this->_loadDefaultView(lang('Form.movie_update'), [
            'validation' => $validation,
            'movie' => $movie->asObject()->find($id), 'categories' => $category->asObject()
                ->findAll(), 'images' => $images->getByMovieId($id)
        ], 'edit');
    }
    public function update($id = null)
    {
        $movie = new MovieModel();
        if ($movie->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        if ($this->validate('movies')) {
            $movie->update($id, [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'category_id' => $this->request->getPost('category_id'),
            ]);
            // cache()->delete('movies');  
            $this->_upload($id);
            return redirect()->to('/movie')->with('message', lang('Form.movie_edit_success'));
        }
        return redirect()->back()->withInput();
    }
    public function delete($id = null)
    {
        $movie = new MovieModel();
        if ($movie->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $movie->delete($id);
        return redirect()->to('/movie')->with('message', lang('Form.movie_edit_delete'));
    }
    public function delete_image($imageId)
    {
        $imageModel = new MovieImageModel();
        $image = $imageModel->asObject()->find($imageId);
        if ($image == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $imgRute = WRITEPATH . 'uploads/movies/' . $image->movie_id . '/' . $image->image;
        if (!file_exists($imgRute)) {
            throw PageNotFoundException::forPageNotFound();
        }
        $imageModel->delete($imageId);
        unlink($imgRute);
        return redirect()->back()->with('message', lang('Form.image_delet_success'));
    }
    public function show($id = null)
    {
        $movieModel = new MovieModel();
        $imageModel = new MovieImageModel();
        $movie = $movieModel->asObject()->find($id);

        if ($movie == null) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->_loadDefaultView(
            $movie->title,
            [
                'movie' => $movie,
                'images' => $imageModel->getByMovieId($id)
            ],
            'show'
        );
    }

    private function _loadDefaultView($title, $data, $view)
    {
        $dataHeader = [
            'title' => $title
        ];
        echo view("dashboard/templates/header", $dataHeader);
        echo view("dashboard/movie/$view", $data);
        echo view("dashboard/templates/footer");
    }
    private function _upload($movieId)
    {
        $images = new MovieImageModel();
        if ($imagefile = $this->request->getFile('image')) {
            if ($imagefile->isValid() && !$imagefile->hasMoved()) {
                $newName = $imagefile->getRandomName();
                $imagefile->move(WRITEPATH . 'uploads/movies/' . $movieId, $newName);
                $images->save([
                    'movie_id' => $movieId,
                    'image' => $newName
                ]);
            }
        }
    }
}
