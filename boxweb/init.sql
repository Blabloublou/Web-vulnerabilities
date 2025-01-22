CREATE DATABASE IF NOT EXISTS boxweb;
USE boxweb;

CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL,
                       password VARCHAR(50) NOT NULL,
                       points INT DEFAULT 0
);

CREATE TABLE vulnerabilities (
                                 id INT AUTO_INCREMENT PRIMARY KEY,
                                 validated BOOLEAN DEFAULT FALSE,
                                 defi VARCHAR(255) DEFAULT 'test',
                                 level VARCHAR(255) DEFAULT 'test'


);

INSERT INTO users (username, password) VALUES ('admin', 'password123');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'xss', 'easy');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'xss', 'easy');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'xss', 'moyen');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'xss', 'moyen');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'xss', 'hard');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'xss', 'hard');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'xss', 'extreme');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'sqli', 'easy');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'sqli', 'easy');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'sqli', 'moyen');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'sqli', 'moyen');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'sqli', 'hard');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'sqli', 'hard');
INSERT INTO vulnerabilities (validated, defi, level) VALUES (FALSE, 'sqli', 'extreme');