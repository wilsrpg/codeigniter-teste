<?php $this->load->view('adminpanel/header');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

  <h2>View blog</h2>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>#</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Imagem</th>
          <th>Opções</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (count($blogs) == 0)
            echo '<tr><td colspan="5">Nenhum blog</td></tr>';
          foreach ($blogs as $b) {
        ?>
        <tr>
          <td><?= $b['id_do_blog'] ?></td>
          <td><?= $b['titulo_do_blog'] ?></td>
          <td><?= $b['descricao_do_blog'] ?></td>
          <td><img class="img-fluid" width="50" src="<?= base_url().'assets/upload/blogimg/'.$b['nome_da_imagem_do_blog'] ?>"></td>
          <td>
            <a href="<?= base_url().'blog/editarblog/'.$b['id_do_blog'] ?>" class="bnt btn-info">Editar</a>
            <a href="<?= base_url().'blog/excluirblog/'.$b['id_do_blog'] ?>" class="bnt btn-danger">Excluir</a>
          </td>
        </tr>
        <?php } ?>
      <tbody>
    </table>
  </div>
</main>

<?php $this->load->view('adminpanel/footer');?>
