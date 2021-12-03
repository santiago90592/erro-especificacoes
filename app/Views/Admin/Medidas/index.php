<?php echo  $this->extend('Admin/layout/principal'); ?>
<?php echo $this->section('titulo'); ?> <?php echo $titulo; ?> <?php echo $this->endSection(); ?>
<?php echo $this->section('estilos'); ?>

<!-- enviamos os estilos para template principal-->

<link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>"/>

<?php echo $this->endSection(); ?>
<?php echo $this->section('conteudo'); ?>

 <div class="row">
            
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $titulo;?> </h4>

                  <div class="ui-widget">
                      <input id="query" name="query" placeholder="Pesquise por uma medida de produto" class="form-control bg-light mb-5">
                  </div>

                  <a href="<?php echo site_url("admin/medidas/criar"); ?>" class="btn btn-success float-right mb-5">
                     <i class="mdi mdi-plus btn-icon-prepend"></i>
                     Registar
                  </a>
                  
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Nome</th>
                          <th>Data de criação</th>
                          <th>Ativo</th>
                          <th>Situação</th>
                        </tr>
                      </thead>
                      <tbody>


                      	<?php foreach ($medidas as $medida) : ?>

                        <tr>

                          <td>
                            <a href="<?php echo site_url("admin/medidas/show/$medida->id"); ?>"><?php echo $medida->nome; ?></a>
                                                      
                            </td>
                          <td><?php echo $medida->criado_em->humanize(); ?></td>

                                                    
                          <td><?php echo ($medida->ativo && $medida->deletado_em == null ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Nao</label>'); ?></td>

                          <td>
                           <?php echo ($medida->deletado_em == null ? '<label class="badge badge-primary">Disponivel</label>' : '<label class="badge badge-danger">Excluido</label>'); ?>

                           <?php if($medida->deletado_em != null) : ?>

                            <a href="<?php echo site_url("admin/medidas/desfazerexclusao/$medida->id"); ?>" class="badge badge-dark ml-2">
                              <i class="mdi mdi-undo btn-icon-prepend"></i>
                               Desfazer
                            </a>

                           <?php endif; ?>
                              
                            </td>
                        </tr>
                        
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                  <div class="mt-3">
                    <?php echo $pager->links() ?>
                  </div>
                </div>
              </div>
            </div>

          </div>

<?php echo $this->endSection(); ?>


<?php echo $this->section('scripts'); ?>

<!-- enviamos os scripts para template principal-->

<script src="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>

<script>
  
  $(function (){

    $( "#query" ).autocomplete({


      source: function (request, response){

        $.ajax({

          url: "<?php echo site_url('admin/medidas/procurar'); ?>",
          dataType: "json",
          data:{
               term: request.term
          },
          success: function (data){

            if(data.length < 1){

              var data = [
              {
                label: 'Mdedida não encontrada',
                value: -1
              }
              ];

            }
            response(data); // aqui tem valor no data
          },    


        }); // fim ajax

      },
      minLenght: 1,
      select: function (event, ui){

        if(ui.item.value == -1){

          $(this).val("");
          return false;

        }else{

          window.location.href = '<?php echo site_url('admin/medidas/show/'); ?>' + ui.item.id;
        }

      }
    }); // fim auto complete

  });

</script>

<?php echo $this->endSection(); ?>