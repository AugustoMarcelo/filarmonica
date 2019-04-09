CREATE PROCEDURE `sp_save_frequencia` (
    param_tocata INT(11),
    param_componente INT(11),
    param_presenca TINYINT(1),
    param_cadastrado_por INT(11),
    param_data_cadastro TIMESTAMP
)
BEGIN
    INSERT INTO tb_frequencias (
        tocata_id,
        componente_id,
        presenca,
        cadastrado_por,
        data_cadastro
    ) VALUES (
        param_tocata,
        param_componente,
        param_presenca,
        param_cadastrado_por,
        param_data_cadastro
    );
END