<?php $this->load->view('adminpanel/cabecalho');?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading"><?= $blog['titulo']?></h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top" src="<?= base_url().'assets/upload/blogimg/'.$blog['nome_da_imagem'] ?>">
            <div class="card-body">
              <p class="card-text"><?= $blog['descricao']?></p>
              <div class="d-flex justify-content-between align-items-center">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php $this->load->view('adminpanel/rodape');?>
