
<?php $__env->startSection('titulo'); ?>
    Lista de Permissão
<?php $__env->stopSection(); ?>
<?php $__env->startSection('conteudo'); ?>
<div class="row">
    <div class="col-xs-2">
        <a id="list" href="<?php echo e(URL::route('permissao.create')); ?>" title="Cadastrar" class="btn btn-primary">Cadastrar</a>
    </div>
</div>
<?php if(!empty($dados) && count($dados) > 0): ?>
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Permissão</h3>
    </div>
    <div class="box-body">
        <table id="table" class="table table-bordered table-hover dataTable">
            <thead>
                <tr>
                  <th>Ordem</th>
                  <th class="col-xs-2">Nome</th>
                  <th>Descrição</th>
                  <th>Ações</th>
                </tr>
            </thead>
            <tbody>
        <?php $__currentLoopData = $dados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><?php echo e($valor->nome); ?></td>
                    <td><?php echo e($valor->descricao); ?></td>
                    <td class="acoes-lista">
                        <a id="edit" href="<?php echo e(URL::route('permissao.edit',$valor->id_permissao)); ?>" title="Editar" class="fa fa-edit"></a>
                        <form action="<?php echo e(action('PermissaoController@destroy', $valor->id_permissao)); ?>" method="POST">
                            <?php echo e(method_field('DELETE')); ?>

                            <?php echo e(csrf_field()); ?>

                            <button id="delete" type='submit' title="Excluir" class="fa fa-fw fa-trash"></button>
                        </form>
                    </td>
                </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
    <div class="sem-dados">
        <span class="sem-dados">Não há Permissão Cadastradas</span>
    </div>    
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("theme.$theme.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sar_web/resources/views/permissao/index.blade.php ENDPATH**/ ?>