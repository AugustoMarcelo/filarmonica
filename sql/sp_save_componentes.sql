CREATE PROCEDURE `sp_save_componentes` (
    param_nome VARCHAR(255),
    param_telefone VARCHAR(255),
    param_data_admissao DATE,
    param_tam_camiseta VARCHAR(10),
    param_tam_mangas_curtas TINYINT(2),
    param_tam_mangas_compridas TINYINT(2),
    param_tam_sapato TINYINT(4),
    param_ativo TINYINT(1),
    param_cadastrado_por INT(11),
    param_data_cadastro TIMESTAMP
)
BEGIN
    DECLARE idGenerated INT;

    INSERT INTO tb_componentes (
        nome,
        telefone,
        data_admissao,
        tam_camiseta,
        tam_mangas_curtas,
        tam_mangas_compridas,
        tam_sapato,
        ativo,
        cadastrado_por,
        data_cadastro
    ) VALUES (
        param_nome,
        param_telefone,
        param_data_admissao,
        param_tam_camiseta,
        param_tam_mangas_curtas,
        param_tam_mangas_compridas,
        param_tam_sapato,
        param_ativo,
        param_cadastrado_por,
        param_data_cadastro
    );

    SET idGenerated = LAST_INSERT_ID();

    SELECT * FROM tb_componentes WHERE id = LAST_INSERT_ID();
END