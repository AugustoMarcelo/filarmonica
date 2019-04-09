CREATE PROCEDURE `sp_save_tocatas` (
    param_local VARCHAR(255),
    param_data_tocata DATE,
    param_horario VARCHAR(10),
    param_observacoes VARCHAR(255),
    param_cadastrado_por INT(11),
    param_data_cadastro TIMESTAMP
)
BEGIN
    DECLARE idGenerated INT;

    INSERT INTO tb_tocatas (
        local,
        data_tocata,
        horario,
        observacoes,
        cadastrado_por,
        data_cadastro
    ) VALUES (
        param_local,
        param_data_tocata,
        param_horario,
        param_observacoes,
        param_cadastrado_por,
        param_data_cadastro
    );

    SET idGenerated = LAST_INSERT_ID();

    SELECT * FROM tb_tocatas WHERE id = LAST_INSERT_ID();
END