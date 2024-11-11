<?php $this->load->view('adminpanel/cabecalho');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">


<section class="jumbotron text-center">
    <div class="container">
      <h1>Album example</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">

      <div class="row">
      <?php foreach($blogs as $b): ?>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <!--<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?= base_url().'assets/upload/blogimg/'.$b['nome_da_imagem_do_blog'] ?>">
            <div class="card-body">
              <p class="card-text"><?= $b['titulo_do_blog']?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-outline-secondary"
                    href="<?= base_url().'admin/blog/ver/'.$b['id_do_blog']?>">Ver</a>
                  <button type="button" class="btn btn-sm btn-outline-secondary"
                    onclick="editar(`<?=$b['id_do_blog']?>`)">Editar</button>
                </div>
                <small class="text-muted">?</small>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</main>

<?php $this->load->view('adminpanel/rodape');?>

<script>
  function editar(id) {
    window.location.href = '<?= base_url()?>'+'admin/blog/editar/'+id;
  }
</script>
