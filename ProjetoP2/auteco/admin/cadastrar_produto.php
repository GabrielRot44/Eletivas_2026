<form method="POST" action="salvar_produto.php" enctype="multipart/form-data">

<input type="text" name="nome" class="form-control mb-2" placeholder="Nome" required>

<textarea name="descricao" class="form-control mb-2" placeholder="Descrição"></textarea>

<input type="number" step="0.01" name="preco" class="form-control mb-2" placeholder="Preço" required>

<input type="text" name="categoria" class="form-control mb-2" placeholder="Categoria">

<input type="file" name="imagem" class="form-control mb-2">

<button class="btn btn-success">Salvar</button>

</form>