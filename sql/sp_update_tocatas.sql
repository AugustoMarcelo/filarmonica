CREATE PROCEDURE `sp_update_tocatas` (
    param_id INT(11),
    param_local VARCHAR(255),
    param_data_tocata DATE,
    param_horario VARCHAR(10),
    param_observacoes VARCHAR(255),
    param_atualizado_por INT(11),
    param_data_atualizacao TIMESTAMP
)
BEGIN

    UPDATE tb_tocatas
    SET local = param_local,
        data_tocata = param_data_tocata,
        horario = param_horario,
        observacoes = param_observacoes,
        atualizado_por = param_atualizado_por,
        data_atualizacao = param_data_atualizacao
    WHERE id = param_id;

    SELECT * FROM tb_tocatas WHERE id = param_id;
END