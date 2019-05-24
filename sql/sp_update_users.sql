CREATE PROCEDURE `sp_update_users` (
    param_id INT(11),
    param_user VARCHAR(255),
    param_email VARCHAR(255),
    param_ativo TINYINT(4)
)
BEGIN

    UPDATE tb_tocatas
    SET user = param_user,
        email = param_email,
        ativo = param_ativo
    WHERE id = param_id;

    SELECT * FROM tb_users WHERE id = param_id;
END