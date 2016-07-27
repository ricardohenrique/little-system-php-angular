-- Tabela de contatos
CREATE TABLE `contato` (
    `id_contato` mediumint(8) unsigned NOT NULL auto_increment,
    `nome` tinytext NOT NULL,
    PRIMARY KEY (`id_contato`)
) ENGINE=InnoDB;

-- Tabela de tipos de email
CREATE TABLE `contato_email_tipo` (
    `id_contato_email_tipo` tinyint(3) unsigned NOT NULL auto_increment,
    `nome` tinytext NOT NULL,
    PRIMARY KEY (`id_contato_email_tipo`)
) ENGINE=InnoDB;

-- Tabela de relacionamento entre contatos e email
CREATE TABLE `contato_email` (
    `id_contato_email` mediumint(8) unsigned NOT NULL auto_increment,
    `id_contato_email_tipo` tinyint(3) unsigned NOT NULL,
    `id_contato` mediumint(8) unsigned NOT NULL,
    `email` tinytext NOT NULL,
    PRIMARY KEY (`id_contato_email`),
    KEY (`id_contato`),
    KEY (`id_contato_email_tipo`),
    CONSTRAINT `contato_email_ibfk_1` FOREIGN KEY (`id_contato`) REFERENCES `contato` (`id_contato`) ON UPDATE CASCADE,
    CONSTRAINT `contato_email_ibfk_2` FOREIGN KEY (`id_contato_email_tipo`) REFERENCES `contato_email_tipo` (`id_contato_email_tipo`) ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela de tipos de telefone
CREATE TABLE `contato_telefone_tipo` (
    `id_contato_telefone_tipo` tinyint(3) unsigned NOT NULL auto_increment,
    `nome` tinytext NOT NULL,
    PRIMARY KEY (`id_contato_telefone_tipo`)
) ENGINE=InnoDB;

-- Tabela de relacionamento entre contatos e telefone
CREATE TABLE `contato_telefone` (
    `id_contato_telefone` mediumint(8) unsigned NOT NULL auto_increment,
    `id_contato_telefone_tipo` tinyint(3) unsigned NOT NULL,
    `id_contato` mediumint(8) unsigned NOT NULL,
    `ddd` char(2) NOT NULL,
    `telefone` varchar(9) NOT NULL,
    PRIMARY KEY (`id_contato_telefone`),
    KEY (`id_contato`),
    KEY (`id_contato_telefone_tipo`),
    CONSTRAINT `contato_telefone_ibfk_1` FOREIGN KEY (`id_contato`) REFERENCES `contato` (`id_contato`) ON UPDATE CASCADE,
    CONSTRAINT `contato_telefone_ibfk_2` FOREIGN KEY (`id_contato_telefone_tipo`) REFERENCES `contato_telefone_tipo` (`id_contato_telefone_tipo`) ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Populando a tabela de contatos
INSERT INTO `contato` (`id_contato`, `nome`) VALUES
(1, 'Contato #1'),
(2, 'Contato #2'),
(3, 'Contato #3'),
(4, 'Contato #4'),
(5, 'Contato #5');

-- Populando a tabela de tipos de email
INSERT INTO `contato_email_tipo` (`id_contato_email_tipo`, `nome`) VALUES
(1, 'Pessoal'),
(2, 'Trabalho');

-- Populando a tabela de emails dos contatos
INSERT INTO `contato_email` (`id_contato`, `id_contato_email_tipo`, `email`) VALUES
(1, 1, 'contato1_email1@exemplo.com'),
(2, 1, 'contato2_email1@exemplo.com'),
(2, 2, 'contato2_email2@exemplo.com');

-- Populando a tabela de tipos de telefone
INSERT INTO `contato_telefone_tipo` (`id_contato_telefone_tipo`, `nome`) VALUES
(1, 'Celular'),
(2, 'Residencial'),
(3, 'Trabalho');

-- Populando a tabela de telefones dos contatos
INSERT INTO `contato_telefone` (`id_contato`, `id_contato_telefone_tipo`, `ddd`, `telefone`) VALUES
(1, 1, '21', '911111111'),
(3, 3, '11', '12345678'),
(4, 1, '11', '944444444'),
(4, 2, '11', '22222222'),
(4, 3, '11', '44444444');

-- Query Solicitada
SELECT 
    contato.id_contato as contato_id, 
    contato.nome as contato_nome, 
    contato_email.email as email_contato,
    contato_email_tipo.nome as contato_email_tipo,
    contato_telefone.telefone as contato_telefone,
    contato_telefone_tipo.nome as contato_telefone_tipo
from contato
left join contato_email on (contato.id_contato = contato_email.id_contato)
left join contato_email_tipo on (contato_email.id_contato_email_tipo = contato_email_tipo.id_contato_email_tipo)
left join contato_telefone on (contato.id_contato = contato_telefone.id_contato)
left join contato_telefone_tipo on (contato_telefone.id_contato_telefone_tipo = contato_telefone_tipo.id_contato_telefone_tipo)
order by contato.id_contato;