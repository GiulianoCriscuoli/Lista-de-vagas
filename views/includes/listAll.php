<main>

    <section>
        <h2>Listagem de vagas</h2>
    </section>
    
    <a href="storeWork.php" class="btn btn-success">Cadastrar nova vaga</a>

    <table class="table table-bordered table-hover mt-3 table-dark">
        <thead>
            <tr>
                <td>#ID</td>
                <td>Nome</td>
                <td>Ativo</td>
                <td>Data</td>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>

        <?php if(isset($works)): ?>

            <?php foreach($works as $work): ?>
                <tr>
                    <td><?= $work->id ?></td>
                    <td><?= $work->name ?></td>
                    <td><?= $work->active === 's' ? 'Ativo' : 'Não Ativo' ?></td>
                    <td><?= date('d/m/Y : H:i:s', strtotime($work->date)) ?></td>
                    <td>
                        <a href="listWork.php?id=<?= $work->id; ?>" class="btn btn-sm btn-info">Visualizar</a>
                        <a href="updateWork.php?id=<?= $work->id; ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="deleteWork.php?id=<?= $work->id; ?>" class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        <?php endif; ?>
        </tbody>
    </table>

</main>