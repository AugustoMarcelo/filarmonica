CREATE PROCEDURE `sp_password_recovery` (
    param_user_id INT(11),
    param_user_ip VARCHAR(20)
)
BEGIN
    INSERT INTO tb_password_recovery (user_id, user_ip)
    VALUES (param_user_id, param_user_ip);

    SELECT * FROM tb_password_recovery WHERE recovery_id = LAST_INSERT_ID();
END