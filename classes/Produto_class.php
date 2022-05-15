<?php


class Produto_class
{
    private $pdo;

    public function __construct($dbname,$host,$user,$senha)
    {
     try
     {
        $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user);


     }catch (PDOException $e)
     {
         echo 'Erro com banco de dados: '.$e->getMessage();
     }catch (Exception $e){
         echo 'Erro genérico: '.$e->getMessage();
     }
    }



    public function enviarProduto($nome, $descricao, $fotos = array())
    {
        //INSERIR O PRODUTO (TABELA PRODUTO)
        $cmd = $this->pdo->prepare('INSERT INTO produtos (nome_produto, descricao) values (:n, :d)');
        $cmd->bindValue(':n', $nome);
        $cmd->bindValue(':d', $descricao);
        $cmd->execute();
        $id_produto = $this->pdo->LastInsertId(); // assim que inserir o produto já pega o Id dele

        // INSERIR AS IMAGENS DO PRODUTO (TABELA IMAGENS)
        if (count($fotos) > 0)// se veio imagens
            {
                for($i=0; $i < count($fotos); $i++){


                    $nome_foto = $fotos[$i];

                    $cmd = $this->pdo->prepare('INSERT INTO imagens (nome_imagem, fk_id_produto) values(:n, :fk)');
                    $cmd->bindValue(':n',$nome_foto);
                    $cmd->bindValue(':fk', $id_produto);
                    $cmd->execute();
                }
                }



    }

    public function buscarProdutos() // todos os produtos
    {

    }

    public function buscarProdutoPorId($id) // apenas um produto
    {

    }

    public function buscarImagensPorId($id)
    {

    }
}