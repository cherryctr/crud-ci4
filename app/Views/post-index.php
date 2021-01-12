<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Data Post - santriKoding.com</title>
  </head>
  <body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <?php if(!empty(session()->getFlashdata('message'))) : ?>

                <div class="alert alert-success">
                    <?php echo session()->getFlashdata('message');?>
                </div>
                    
                <?php endif ?>

                <a href="<?php echo base_url('post/create') ?>" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>NO</th>
                            <th>TITLE</th>
                            <th>CONTENT</th>
                            <!-- <th>IMAGES</th> -->
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=1; foreach($posts as $key => $post) : ?>

                            <tr>
                                <td><?php echo $x; ?></td>
                                <td><?php echo $post['title'] ?></td>
                                <td><?php echo $post['content'] ?></td>
                                <!-- <td><img src="<?php echo base_url('public/upload/'.$post['image']); ?>"></td> -->
                                <td class="text-center">
                                    <a href="<?php echo base_url('post/edit/'.$post['id']) ?>" class="btn btn-sm btn-primary">EDIT</a>
                                    <a href="<?php echo base_url('post/delete/'.$post['id']) ?>" class="btn btn-sm btn-danger">HAPUS</a>
                                </td>
                            </tr>

                        <?php $x++; endforeach ?>
                    </tbody>
                </table>
                <?php echo $pager->links('post', 'bootstrap_pagination') ?>
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