<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Tambah Data - santriKoding.com</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <?php //var_dump(strlen($validation->listErrors())); ?>
            <?php if(!isset($page)) { ?>
                    <div class="alert alert-danger" role="alert">

                        <?php echo $validation->listErrors() ?>
                    </div>
                <?php } ?>


                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('post/create_upload') ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>TITLE</label>
                                <input type="text" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" name="title" placeholder="Masukkan Title">
                                <div class="invalid-feedback">
                                  <?= $validation->getError('title'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>KONTEN</label>
                               <textarea class="form-control <?= ($validation->hasError('content')) ? 'is-invalid' : ''; ?>" name="content" rows="4" placeholder="Masukkan Konten"></textarea>
                               <div class="invalid-feedback">
                                  <?= $validation->getError('content'); ?>
                                </div>
                            </div>

                             <div class="form-group">
                                <label>Gambar</label>
                              <input type="file" class="form-control <?= ($validation->hasError('userfile')) ? 'is-invalid' : ''; ?>" name="userfile" placeholder="Masukkan Title">
                              <div class="invalid-feedback">
                                  <?= $validation->getError('userfile'); ?>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">SIMPAN</button>
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