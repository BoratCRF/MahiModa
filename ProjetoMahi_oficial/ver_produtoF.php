
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Inclui o link para a fonte Roboto da Google Fonts -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once('header.php'); ?>

<!-- INICIO DETALHES DO PRODUTO-->
<div class="corpo-cat">
    <div class="row">
    
        <div class="col-2">
            <img src="img/femino1(1).jpg" alt="" id="produtoimg">
        </div>
            <!--<div class="img-linha">-->
                <div class="col-2">
                <p>Calça Jogger Estilo Afro </p>
                <h4>R$ 79,99</h4>
                <form action="" method="post">

                <select name="" id="">
                    <option value=""> Tamanhos</option>
                    <option value=""> P</option>       
                    <option value=""> M</option>     
                    <option value=""> G</option>         
                </select>

                 <input type="number" name="" value="1">
                <button type="submit" class="btn">Adicionar ao carrinho</button>
                 </form>
                 <h3>Descrição:</h3>
                 <p> coloque aqui</p>

    

     

    


                </div>

            
        </div>
    </div>
</div> 
<!-- incluindo em php o arquivo footer -->
<?php include_once('footer.php'); ?>

</body>
</html>

