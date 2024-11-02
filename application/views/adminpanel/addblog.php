<?php $this->load->view('adminpanel/header');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

  <h2>Add blog</h2><form action="<?= base_url().'admin/blog/addblog_post' ?>" method="post">
    <div class="form-group">
      <input class="form-control" type="text" name="titulo" placeholder="Nome do blog">
    </div>
    <div class="form-group">
      <textarea class="form-control" name="descricao" placeholder="Descrição do blog"></textarea>
    </div>
    <div class="form-group">
      <input class="form-control" type="file" name="imagem">
    </div>
    <button type="submit">Criar</button>
  </form>
</main>

<?php $this->load->view('adminpanel/footer');?>
