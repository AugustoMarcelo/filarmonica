CREATE PROCEDURE `sp_delete_tocatas` (
    param_tocata_id INT(11)
)
BEGIN
    DELETE FROM tb_frequencias WHERE tocata_id = param_tocata_id;

    DELETE FROM tb_tocatas WHERE id = param_tocata_id;
END