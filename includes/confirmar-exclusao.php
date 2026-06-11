<main>  

   <h2 class="mt-3">Excluir Vaga</h2>
   
    <form method="post">

        <div class="form-group">
            <p>Tem certeza que deseja excluir a vaga <strong><?=$obVaga->titulo?></strong>?</p>    
        </div>

        <div class="form-group">
    <a href="index.php" class="btn btn-success"> Cancelar </a>
</div>
    
            <button type="submit" name = "excluir" class="btn btn-danger">Excluir</button>
        </div>

    </form>    



</main> 