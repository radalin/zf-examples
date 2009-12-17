CREATE TABLE user_emails (id BIGINT AUTO_INCREMENT, address VARCHAR(100) NOT NULL, is_active INT DEFAULT 0 NOT NULL, description TEXT, user_id BIGINT NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE user (id BIGINT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, password VARCHAR(60) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE user_emails ADD CONSTRAINT user_emails_user_id_user_id FOREIGN KEY (user_id) REFERENCES user(id);
