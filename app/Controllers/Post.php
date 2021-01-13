<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostModel;

class Post extends Controller
{


    protected $PostModel;

    function __construct(){
        helper('form');
        $this->PostModel = new PostModel();
    }
    /**
     * index function
     */
    public function index()
    {
        //model initialize
        $postModel = new PostModel();

        //pager initialize
        //  $data = [
        //     'users' => $userModel->paginate(6),
        //     'pager' => $userModel->pager
        // ];
        $pager = \Config\Services::pager();

        $data = array(
            'posts' => $postModel->paginate(5, 'post'),
            'pager' => $postModel->pager,
           
        );

        return view('post-index', $data);
    }

     /**
     * create function
     */
    public function create()
    {
        $data = [
            'page' => 'First',
            'validation' => \Config\Services::validation()
        ];
        return view('post-create',$data);
    }


     
    public function create_upload()
    {
        // session();
        helper(['form', 'url']);
        // load model
        $article = new PostModel();
        $validation =  \Config\Services::validation();
        $db      = \Config\Database::connect();
        $builder = $db->table('posts');
        // validation

        $validation = $this->validate([
            'title' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Judul Post.'
                ]
            ],
            'content'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan konten Post.'
                ]
            ],

            'userfile' => [
                'rules' => 'uploaded[userfile]|max_size[userfile,1024]|mime_in[userfile,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[userfile]|required',
                'errors' => [
                    'uploaded' => 'Preview image is required! Please choose an image first!',
                    'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
                    'mime_in' => 'Your upload does not have a valid image format',
                    'is_image' => 'Your file is not allowed! Please use an image!'
                ]
            ],
            
        ]);

        if(!$validation) {

            //render view with error validation message
            return view('post-create', [
                'validation' => $this->validator
            ]);

        } else {

        // if (!$this->validate([
            
        //       'title' => [
        //         'rules'  => 'required',
        //         'errors' => [
        //             'required' => 'Masukkan Judul Post.'
        //         ]
        //     ],
        //     'content'    => [
        //         'rules'  => 'required',
        //         'errors' => [
        //             'required' => 'Masukkan konten Post.'
        //         ]
        //     ],
            
           
        // ])) 
        

            // session()->setFlashdata('message', 'Data masih kosong');
            // return redirect()->to('/post/create')->withInput();
            // echo 'gagal';
        // }
                // get image
        $previewImage = $this->request->getFile('userfile');
        // name
        $imageName = $previewImage->getRandomName();
        // moving
        $previewImage->move('upload', $imageName);

        // $slug = url_title($this->request->getPost('title'), '-', true);
        $article = [
            // 'author' => $this->request->getPost('author'),
            'title' => $this->request->getPost('title'),
            // 'slug' => $slug,
            'content' => $this->request->getPost('content'),
            // 'date_create' => $this->request->getPost('date_create'),
            'image' => $imageName,
            // 'content' => $this->request->getPost('content')
        ];

        
        $save = $builder->insert($article);
      //  var_dump('article');exit;
        return $this->response->redirect(site_url('post'));
       }
    }


    /**
     * store function
     */
    public function store()
    {
        //load helper form and URL
        helper(['form', 'url']);
         
        //define validation
        $validation = $this->validate([
            'title' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Judul Post.'
                ]
            ],
            'content'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan konten Post.'
                ]
            ],

            // 'image'    => [
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => 'Masukkan konten Post.'
            //     ]
            // ],
        ]);

        if(!$validation) {

            //render view with error validation message
            return view('post-create', [
                'validation' => $this->validator
            ]);

        } else {

            //model initialize
            $postModel = new PostModel();
            
            //insert data into database
            $postModel->insert([
                'title'   => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Post Berhasil Disimpan');

            return redirect()->to(base_url('post'));
        }

    }

    /**
     * edit function
     */
    public function edit($id)
    {
        //model initialize
        $postModel = new PostModel();

        $data = array(
            'post' => $postModel->find($id),
            'page' => 'First',
            'validation' => \Config\Services::validation()
       
        );

        return view('post-edit', $data);
    }

    /**
     * update function
     */
    public function update($id)
    {
        //load helper form and URL
        helper(['form', 'url']);
         
        //define validation
        $validation = $this->validate([
            'title' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Judul Post.'
                ]
            ],
            'content'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan konten Post.'
                ]
            ],
        ]);

        if(!$validation) {

            //model initialize
            $postModel = new PostModel();

            //render view with error validation message
            return view('post-edit', [
                'post' => $postModel->find($id),
                'validation' => $this->validator
            ]);

        } else {

            //model initialize
            $postModel = new PostModel();
            
            //insert data into database
            $postModel->update($id, [
                'title'   => $this->request->getPost('title'),
                'content' => $this->request->getPost('content'),
            ]);

            //flash message
            session()->setFlashdata('message', 'Post Berhasil Diupdate');

            return redirect()->to(base_url('post'));
        }

    }
public function update_files($id)
{
    $article = new PostModel();
    helper(['form', 'url']);
    $validation =  \Config\Services::validation();
    // old title

    $validation = $this->validate([
            'title' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan Judul Post.'
                ]
            ],
            'content'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Masukkan konten Post.'
                ]
            ],

            'userfile' => [
                'rules' => 'uploaded[userfile]|max_size[userfile,1024]|mime_in[userfile,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[userfile]',
                'errors' => [
                    'uploaded' => 'Preview image is required! Please choose an image first!',
                    'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
                    'mime_in' => 'Your upload does not have a valid image format',
                    'is_image' => 'Your file is not allowed! Please use an image!'
                ]
            ],
            
        ]);


    if(!$validation) {

            //model initialize
            $postModel = new PostModel();

            //render view with error validation message
            return view('post-edit', [
                'post' => $postModel->find($id),
                'validation' => $this->validator
            ]);

        } else {

    // if (!$this->validate([
       
    //     'title' => 'required',
    //     // 'content' => 'required|min_length[100]',
    //     'image' => [
    //         'rules' => 'max_size[preview_image,1024]|mime_in[preview_image,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[preview_image]',
    //         'errors' => [
    //             'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
    //             'mime_in' => 'Your upload does not have a valid image format',
    //             'is_image' => 'Your file is not allowed! Please use an image!'
    //         ]
    //     ],
    //     'content' => 'required'
    // ]));

    // get image
    $previewImage = $this->request->getFile('userfile');
    // var_dump($this->request->getPost('olduserfile'));exit;
    // Check image if user have not uploaded image
    if ($previewImage->getError() == 4) {
        // name
        $imageName = $this->request->getPost('olduserfile');
    } else {
        // generate name
        $imageName = $previewImage->getRandomName();
        // moving
        $previewImage->move('upload', $imageName);

        // delete old image
        unlink('upload/' . $this->request->getPost('olduserfile'));
    }

    // $slug = url_title($this->request->getPost('title'), '-', true);

    $article->update($id, [
        // 'author' => $this->request->getPost('author'),
        'title' => $this->request->getPost('title'),
        // 'slug' => $slug,
        // 'description' => $this->request->getPost('description'),
        // 'last_update' => $this->request->getPost('last_update'),
        'image' => $imageName,
        'content' => $this->request->getPost('content')
    ]);

    // var_dump($article);exit;
    session()->setFlashdata('message', 'Post Berhasil Diupdate');
    return $this->response->redirect(site_url('post'));
   }
  }


  public function delete($id)
{
    $article = new PostModel();

    // finding image
    $post = $article->find($id);

    // delete image
    if ($post['image'] == true) {
        unlink('upload/' . $post['image']);
    }
    $article->delete($id);

    session()->setFlashdata('message', 'Post Berhasil Dihapus');
    return $this->response->redirect(site_url('post'));
}
}