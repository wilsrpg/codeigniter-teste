<?php $this->load->view('adminpanel/header');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

  <h2>Editar blog</h2>
  <form action="<?= base_url().'admin/blog/salvar/'.$id ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <input class="form-control" type="text" name="titulo" placeholder="<?= $titulo?>" value="<?= $titulo?>">
    </div>
    <div class="form-group">
      <textarea id="ckeditor" class="form-control" name="descricao" placeholder="<?= $descricao?>"><?= $descricao?></textarea>
    </div>
    <img class="img-fluid" width="200" src="<?= base_url().'assets/upload/blogimg/'.$nome_da_imagem ?>">
    <img class="img-fluid" width="200" accept=".gif, .jpeg, .jpg, .png" id="previsualizacao">
    <p id="erro_formato"></p>
    <div class="form-group">
      <input class="form-control" type="file" name="imagem" id="imagem" onchange="previsualizar()">
    </div>
    <button type="submit">Salvar</button>
  </form>
</main>

<?php $this->load->view('adminpanel/footer');?>

<script>
  function previsualizar() {
    let imagem = document.getElementById('imagem');
    let previsualizacao = document.getElementById('previsualizacao');
    let erro_formato = document.getElementById('erro_formato');
    let tipos = ["image/gif", "image/jpeg", "image/png"];
    if (tipos.includes(imagem.files[0].type)) {
      previsualizacao.src = URL.createObjectURL(imagem.files[0]);
      erro_formato.textContent = '';
    } else {
      previsualizacao.src = '';
      erro_formato.textContent = 'Formato não suportado.';
    }
  }
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create(document.querySelector('#ckeditor'))
    .catch(error => {
        console.error(error);
    });
</script>