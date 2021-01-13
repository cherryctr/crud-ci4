<?php
 public function create_upload()
    {
        session();

        // load model
        $article = new PostModel();

        $db      = \Config\Database::connect();
        $builder = $db->table('posts');

        // validation

        if (!$this->validate([
            
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
            'preview_image' => [
                'rules' => 'uploaded[userfile]|max_size[userfile,1024]|mime_in[userfile,image/jpg,image/jpeg,image/svg,image/webp,image/png]|is_image[userfile]',
                'errors' => [
                    'uploaded' => 'Preview image is required! Please choose an image first!',
                    'max_size' => 'The size of this image is too large. The image must have less than 1MB size',
                    'mime_in' => 'Your upload does not have a valid image format',
                    'is_image' => 'Your file is not allowed! Please use an image!'
                ]
            ],
            'post' => $postModel->find($id),
           
        ])) {

            // return redirect()->to('/article/newpost')->withInput();
            echo 'gagal';
        }
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