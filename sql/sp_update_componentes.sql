CREATE PROCEDURE `sp_update_componentes` (
    param_id INT(11),
    param_nome VARCHAR(255),
    param_telefone VARCHAR(255),
    param_data_admissao DATE,
    param_tam_camiseta VARCHAR(10),
    param_tam_mangas_curtas TINYINT(2),
    param_tam_mangas_compridas TINYINT(2),
    param_tam_sapato TINYINT(4),
    param_ativo TINYINT(1),
    param_atualizado_por INT(11),
    param_data_atualizacao TIMESTAMP
)
BEGIN
    UPDATE tb_componentes 
    SET nome = param_nome, 
        telefone = param_telefone, 
        data_admissao = param_data_admissao,
        tam_camiseta = param_tam_camiseta, 
        tam_mangas_curtas = param_tam_mangas_curtas,
        tam_mangas_compridas = param_tam_mangas_compridas,
        tam_sapato = param_tam_sapato,
        ativo = param_ativo,
        atualizado_por = param_atualizado_por,
        data_atualizacao = param_data_atualizacao
    WHERE id = param_id;

    SELECT * FROM tb_componentes WHERE id = param_id;
END