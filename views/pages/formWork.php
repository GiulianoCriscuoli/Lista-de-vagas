<main>

    <h2><?= isset($_GET['id']) ? 'Atualizar' : 'Cadastrar' ?> uma nova vaga</h2>

    <section>
        <a href="../../index.php" class="btn btn-info mb-3">Voltar</a>
    </section>

    <form method="POST">

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" value="<?= isset($work->name) ? $work->name : '' ?>">
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea name="description" class="form-control"><?= isset($work->description) ? $work->description : ''?></textarea>
        </div>

        <div class="fom-group">
            <label for="active">Status</label>
        </div>

        <div class="form-check form-check-inline">
            <input type="radio" name="active" value="s" checked> <span>Ativo</span> 
        </div>

        <div class="form-check form-check-inline">
            <input type="radio" name="active" value="n" <?= $work->active === 'n' ? 'checked' : '' ?>> <span>Inativo</span> 
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-success">ENVIAR</button>
        </div>
    </form>

</main>