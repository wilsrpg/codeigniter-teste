<?php $this->load->view('adminpanel/header');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

  <h2>View blog</h2>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Descrição</th>
          <th>Imagem</th>
          <th>Publicado</th>
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
          <td><?= $b['publicado'] ? 'Sim' : 'Não' ?></td>
          <td>
            <button class="bnt btn-info" onclick="editar(`<?=$b['id_do_blog']?>`)">Editar</button>
            <button class="bnt btn-danger" onclick="excluir(`<?=$b['id_do_blog']?>`)">Excluir</button>
            <?php if($b['publicado']): ?>
              <button class="bnt btn-warning" onclick="despublicar(`<?=$b['id_do_blog']?>`)">Despublicar</button>
            <?php else: ?>
              <button class="bnt btn-success" onclick="publicar(`<?=$b['id_do_blog']?>`)">Publicar</button>
            <?php endif ?>
          </td>
        </tr>
        <?php } ?>
      <tbody>
    </table>
  </div>
</main>

<?php $this->load->view('adminpanel/footer');?>

<script>
  function editar(id) {
    window.location.href = window.location+'/editar/'+id;
  }
  function excluir(id) {
    if (confirm('Excluir blog "'+id+'"?'))
      window.location.href = window.location+'/excluir/'+id;
  }
  function publicar(id) {
    if (confirm('Publicar blog "'+id+'"?'))
      window.location.href = window.location+'/publicar/'+id;
  }
  function despublicar(id) {
    if (confirm('Despublicar blog "'+id+'"?'))
      window.location.href = window.location+'/despublicar/'+id;
  }
  <?php
    $msg = '';
    if (isset($_SESSION['criou'])) {
      if ($_SESSION['criou'] === true)
        $msg = "Blog criado com sucesso!";
      else
        $msg = "Falha ao criar blog.";
    }
    if (isset($_SESSION['excluiu'])) {
      if ($_SESSION['excluiu'] === true)
        $msg = "Blog excluído com sucesso!";
      else
        $msg = "Falha ao excluir blog.";
    }
    if (isset($_SESSION['editou'])) {
      if ($_SESSION['editou'] === true)
        $msg = "Blog editado com sucesso!";
      else
        $msg = "Falha ao editar blog.";
    }
    if ($msg)
      echo 'alert("'.$msg.'");';
  ?>
</script>
