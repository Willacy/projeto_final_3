<form action="/projeto_final_3/livro" method="POST" class="form">
    <div class="form-floating mb-3">
        <input type="text" name="titulo_livro" id="titulo_livro" class="form-control" placeholder="Título do livro"
            required>
        <label for="titulo_livro">Título do Livro</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" name="valor_venda_livro" id="valor_venda_livro" class="form-control"
            placeholder="Valor de Venda" required>
        <label for="valor_venda_livro">Valor de Venda</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" name="valor_aluguel_livro" id="valor_aluguel_livro" class="form-control"
            placeholder="Valor de Aluguel" required>
        <label for="valor_aluguel_livro">Valor de Aluguel</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" name="isbn_livro" id="isbn_livro" class="form-control" placeholder="ISBN" required>
        <label for="isbn_livro">ISBN</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number" name="quantidade_livro" id="quantidade_livro" class="form-control"
            placeholder="Quantidade de Livro" required>
        <label for="quantidade_livro">Quantidade de Livro</label>
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>