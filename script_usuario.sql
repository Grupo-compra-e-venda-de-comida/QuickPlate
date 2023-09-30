CREATE TABLE IF NOT EXISTS usuario (
  id_usuario INT NOT NULL AUTO_INCREMENT,
  email_usuario VARCHAR(50) NOT NULL,
  senha_usuario VARCHAR(25) NOT NULL,
  tipo_usuario VARCHAR(1) NOT NULL, /* A = ADM V = Vendedor C = Cliente */
  nome VARCHAR(50) NOT NULL,
  ativo VARCHAR(1) NOT NULL, /* I=INATIVO, A=ATIVO */

  PRIMARY KEY (`id_usuario`)
);

/* VENDEDOR */
CREATE TABLE IF NOT EXISTS vendedor (
  id_vendedor INT NOT NULL AUTO_INCREMENT,
  tipo_pessoa VARCHAR(1) NOT NULL,  /* F=Física, J=Jurícica */ 
  cpf_cnpj VARCHAR(20) NOT NULL,
  id_usuario INT NOT NULL,
  CONSTRAINT pk_vendedor PRIMARY KEY (id_vendedor)  
);
ALTER TABLE vendedor ADD CONSTRAINT fk_usuario_vendedor FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario);


/* CLIENTE */
CREATE TABLE IF NOT EXISTS cliente (
  id_cliente INT NOT NULL AUTO_INCREMENT,
  cpf VARCHAR(20) NOT NULL,
  id_usuario INT NOT NULL,
  CONSTRAINT pk_cliente PRIMARY KEY (id_cliente)
);
ALTER TABLE cliente ADD CONSTRAINT fk_usuario_cliente FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario);



INSERT INTO usuario (email_usuario, senha_usuario, tipo_usuario, nome, ativo) VALUES ("admin@gmail.com", "senhaADM", "A", "Adminsitrador", 'A');

INSERT INTO usuario (email_usuario, senha_usuario, tipo_usuario, nome, ativo) VALUES ("cliente@gmail.com", "senhaCLI", "C", "Cliente", 'A');
INSERT INTO cliente (cpf, id_usuario) VALUES ("11111111111", (SELECT id_usuario FROM usuario WHERE email_usuario = 'cliente@gmail.com'));

INSERT INTO usuario (email_usuario, senha_usuario, tipo_usuario, nome, ativo) VALUES ("vendedor@gmail.com", "senhaVEN", "V", "Vendedor", 'A');
INSERT INTO vendedor (tipo_pessoa, cpf_cnpj, id_usuario) VALUES ("F", "22222222222", (SELECT id_usuario FROM usuario WHERE email_usuario = 'vendedor@gmail.com'));



/* Produto */
CREATE TABLE produto
(
    id_produto INT NOT NULL AUTO_INCREMENT,
    nome_produto varchar(60) NOT NULL,
    preco_produto DECIMAL(10,2) NOT NULL,
    categoria_produto varchar(1) NOT NULL,
    detalhes text(120) NOT NULL,
    id_vendedor INT NOT NULL,
    CONSTRAINT pk_produto PRIMARY KEY (id_produto)
);
ALTER TABLE produto ADD CONSTRAINT fk_vendedor_produto FOREIGN KEY (id_vendedor) REFERENCES vendedor (id_vendedor);

/* Pedido */
CREATE TABLE pedido
(
    id_pedido INT NOT NULL AUTO_INCREMENT,
    id_vendedor INT NOT NULL,
    id_cliente INT NOT NULL,
    status VARCHAR(1) NOT NULL,  /* P = PROCESSANDO PEDIDO C = PEDIDO CONCLUÌDO */
    descricao VARCHAR(200) NOT NULL,
    CONSTRAINT pk_pedido PRIMARY KEY (id_pedido)
);
ALTER TABLE pedido ADD CONSTRAINT fk_vendedor_pedido FOREIGN KEY (id_vendedor) REFERENCES vendedor (id_vendedor);
ALTER TABLE pedido ADD CONSTRAINT fk_cliente_pedido FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente);

/* Itens do Pedido */
CREATE TABLE pedido_item 
(
	  id_item INT NOT NULL AUTO_INCREMENT,
    id_pedido INT NOT NULL,
    id_produto INT NOT NULL,
    valor INT NOT NULL,
    quantidade INT NOT NULL,
    total INT NOT NULL,
    CONSTRAINT pk_pedido_item PRIMARY KEY (id_item)
);
ALTER TABLE pedido_item ADD CONSTRAINT fk_produto_pedido_item FOREIGN KEY (id_produto) REFERENCES produto (id_produto);
ALTER TABLE pedido_item ADD CONSTRAINT fk_pedido_pedido_item FOREIGN KEY (id_pedido) REFERENCES pedido (id_pedido);

/* Review */
CREATE TABLE review
(
    id_review INT NOT NULL AUTO_INCREMENT,
    id_pedido INT NOT NULL,
    avaliacao INT NOT NULL,
    comentario VARCHAR(120),
    CONSTRAINT pk_review PRIMARY KEY (id_review)
);
ALTER TABLE review ADD CONSTRAINT fk_pedido_review FOREIGN KEY (id_pedido) REFERENCES pedido (id_pedido);

