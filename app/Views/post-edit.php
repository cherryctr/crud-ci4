<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Edit Data - santriKoding.com</title>
  </head>
  <body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
               <?php if(!isset($page)) { ?>
                    <div class="alert alert-danger" role="alert">

                        <?php echo $validation->listErrors() ?>
                    </div>
                <?php } ?>


                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('post/update_files/'.$post['id']) ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" class="id" value="<?php echo $post['id'] ?>">
                            <div class="form-group">
                                <label>TITLE</label>
                                <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" name="title" value="<?php echo $post['title'] ?>" placeholder="Masukkan Title">
                                <div class="invalid-feedback">
                                  <?= $validation->getError('title'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>KONTEN</label>
                               <textarea class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : ''; ?>" name="content" rows="4" placeholder="Masukkan Konten"><?php echo $post['content'] ?></textarea>
                               <div class="invalid-feedback">
                                  <?= $validation->getError('content'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Gambar</label>
                              <input type="file" class="form-control <?= ($validation->hasError('userfile')) ? 'is-invalid' : ''; ?>" name="userfile" placeholder="Masukkan Title"\><br>

                              <input type="hidden" class="form-control" name="olduserfile" value="<?php echo $post['image']; ?>" \><br>
                              <?php  
                                        if($post['image'] == false) {
                                            echo '<div class="alert alert-danger" role="alert">
                                                    gambar tidak ada
                                             </div>';
                                        }else{
                                            
                                            echo "<img src='".base_url('upload').'/'.$post['image']."' width=150px; height=100px;>";
                                        }
                                      
                                ?>
                                <div class="invalid-feedback">
                                  <?= $validation->getError('userfile'); ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>