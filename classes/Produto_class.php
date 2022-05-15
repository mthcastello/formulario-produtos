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
    //SELECT DE TODODS OS PRODUTOS PARA EXIBIR NA PAGINA PRODUTOS
    public function buscarProdutos() // todos os produtos
    {
        $cmd = $this->pdo->query('SELECT *,
       (SELECT nome_imagem from imagens where fk_id_produto = produtos.id_produto LIMIT 1) 
           as foto_capa 
            FROM produtos');

        $cmd->execute();


        if($cmd-> rowCount() > 0)
        {
            $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

        }else
        {
                $dados = array();
        }
        return $dados;
    }

    public function buscarProdutosPorId($id) // apenas um produto
    {
        $cmd = $this->pdo->prepare('SELECT * FROM produtos where id_produto = :id');

        $cmd->bindValue(':id',$id);

        $cmd->execute();


        if($cmd-> rowCount() > 0)
        {
            $dados = $cmd->fetch(PDO::FETCH_ASSOC);

        }else
        {
            $dados = array();
        }
        return $dados;
    }

    public function buscarImagensPorId($id)
    {

        $cmd = $this->pdo->prepare('SELECT nome_imagem FROM imagens WHERE fk_id_produto = :id');

        $cmd->bindValue(':id',$id);

        $cmd->execute();


        if($cmd-> rowCount() > 0)
        {
            $dados = $cmd->fetchAll(PDO::FETCH_ASSOC);

        }else
        {
            $dados = array();
        }
        return $dados;
    }
}