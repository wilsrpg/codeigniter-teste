<?php $this->load->view('adminpanel/cabecalho');?>
<!--<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css" />-->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

  <h2>Novo blog</h2>
  <form action="<?= base_url().'admin/blog/criar' ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <input class="form-control" type="text" name="titulo" placeholder="Nome do blog">
    </div>
    <div class="form-group">
      <!--<p>aki</p>-->
      <textarea id="ckeditor" class="form-control" name="descricao" placeholder="Descrição do blog"></textarea>
    </div>
    <div class="form-group">
      <input class="form-control" type="file" name="imagem" accept=".gif, .jpeg, .jpg, .png">
    </div>
    <div class="form-group">
      <input type="checkbox" name="publicar" id="publicar">
      <label for="publicar">Publicar ao criar</label>
    </div>
    <button type="submit">Criar</button>
  </form>
</main>

<?php $this->load->view('adminpanel/rodape');?>

<!--<script src="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.umd.js"></script>

        <script>
            const {
                ClassicEditor,
                Essentials,
                Bold,
                Italic,
                Font,
                Paragraph
            } = CKEDITOR;

            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                    toolbar: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                } )
                .then( /* ... */ )
                .catch( /* ... */ );
        </script>-->

<!--<script src="https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.umd.js"></script>-->
<!--<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>-->
<!--<script type="module">import coreTranslations from 'ckeditor5/translations/pl.js';</script>-->
<!--<script type="module" src="https://cdn.ckeditor.com/ckeditor5/43.3.1/translations/pt-br.js"></script>-->
<!--<script type="module">
import {ClassicEditor} from 'https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.js';
import ptDoBrasil from 'https://cdn.ckeditor.com/ckeditor5/43.3.1/translations/pt-br.js';
  ClassicEditor
    .create(document.querySelector('#ckeditor'), {translations: [ptDoBrasil]})
    .catch(error => {
        console.error(error);
    });
</script>-->

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create(document.querySelector('#ckeditor'))
    .catch(error => {
        console.error(error);
    });
</script>