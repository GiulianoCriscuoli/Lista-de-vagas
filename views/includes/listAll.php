<main>

    <section>
        <h2>Listagem de vagas</h2>
    </section>
    
    <section class="my-4">
        
        <div class="row">

            <div class="col-md-3">

                <a href="createWork.php" class="btn btn-success">Cadastrar nova vaga</a>

            </div>

            <div class="col-md-7">
                <form method="GET" class="d-flex">

                    <div class="col-md-5">

                        <input class="form-control" type="search" placeholder="Buscar" name="search" 
                        value="<?= isset($search) ? $search : '' ?>">

                    </div>

                    <div class="col-md-3">
                        <select name="active" id="active" class="form-control">
                            <option value="">Todos</option>
                            <option value="s" <?= $activeFilter === 's' ? 'selected' : '' ?>>Ativo</option>
                            <option value="n" <?= $activeFilter === 'n' ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info mx-3">Filtrar</button>

                </form>
            </div>
        </div>

    </section>
    
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
                    <tr style="<?= $work->hotwork  ? 'background: #ffd213; color: #000;' : '' ?>">
                        <td><?= $work->id ?></td>
                        <td><?= $work->name ?></td>
                        <td><?= $work->active === 's' ? 'Ativo' : 'Não Ativo' ?></td>
                        <td><?= date('d/m/Y : H:i:s', strtotime($work->date)) ?></td>
                        <td style="display: flex; justify-content: space-evenly;">
                            <a href="listWork.php?id=<?= $work->id; ?>" class="btn btn-sm btn-info">Visualizar</a>
                            <a href="updateWork.php?id=<?= $work->id; ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="destroyWork.php?id=<?= $work->id; ?>" class="btn btn-sm btn-danger">Excluir</a>
                            <form data-id="<?=$work->id; ?>"action="hotWork.php?id=<?= $work->id; ?>" class="form-group" method="POST">
                                <div class="form-check">
                                    <input 
                                    type="checkbox" 
                                    style="width: 20px; height: 20px;"
                                    class="form-check-input"
                                    value="1"
                                    <?= $work->hotwork  ? 'checked' : '' ?> 
                                    name="hotwork"
                                    title="Destacar a vaga">
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
                    
                <tr>
                    <td>Não foi encontrada nenhuma vaga</td>
                </tr>
                
            <?php endif; ?>
        </tbody>
    </table>
</main>