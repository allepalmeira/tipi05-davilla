START TRANSACTION;

-- =====================================================
-- 1) AJUSTES ESTRUTURAIS
-- =====================================================

-- Categoria: permite ativar/inativar e ordenar no menu
ALTER TABLE tbl_categoria
ADD COLUMN status_categoria VARCHAR(10) NOT NULL DEFAULT 'ATIVO' AFTER descricao_categoria,
ADD COLUMN ordem_categoria INT NOT NULL DEFAULT 0 AFTER status_categoria;

-- Produto: permite destacar produto na home e controlar ordem
ALTER TABLE tbl_produtos
ADD COLUMN destaque_produto VARCHAR(3) NOT NULL DEFAULT 'NAO' AFTER status_produto,
ADD COLUMN ordem_produto INT NOT NULL DEFAULT 0 AFTER destaque_produto;

-- Banner: permite que o banner seja totalmente dinâmico
ALTER TABLE tbl_banner
ADD COLUMN titulo_banner VARCHAR(80) NOT NULL AFTER nome_banner,
ADD COLUMN subtitulo_banner VARCHAR(120) DEFAULT NULL AFTER titulo_banner,
ADD COLUMN descricao_banner TEXT DEFAULT NULL AFTER subtitulo_banner,
ADD COLUMN texto_botao_banner VARCHAR(30) DEFAULT NULL AFTER descricao_banner,
ADD COLUMN link_botao_banner VARCHAR(120) DEFAULT NULL AFTER texto_botao_banner,
ADD COLUMN ordem_banner INT NOT NULL DEFAULT 0 AFTER link_botao_banner;

-- =====================================================
-- 2) CATEGORIAS
-- =====================================================

INSERT INTO tbl_categoria
(
    id_categoria,
    nome_categoria,
    descricao_categoria,
    status_categoria,
    ordem_categoria
)
VALUES
(1, 'Bolos Fit', 'Bolos artesanais com proposta mais leve, ideais para vitrine e encomendas especiais.', 'ATIVO', 1),
(2, 'Doces Fit', 'Doces delicados e saborosos para presentear, celebrar ou adoçar o dia com equilíbrio.', 'ATIVO', 2),
(3, 'Tortas Fit', 'Tortas leves e especiais, vendidas por fatia ou sob encomenda.', 'ATIVO', 3),
(4, 'Bebidas', 'Bebidas quentes e cremosas para acompanhar a experiência da confeitaria.', 'ATIVO', 4),
(5, 'Kits Presente', 'Kits especiais para presentear com praticidade, charme e sabor.', 'ATIVO', 5);

-- =====================================================
-- 3) BANNERS
-- =====================================================

INSERT INTO tbl_banner
(
    id_banner,
    nome_banner,
    titulo_banner,
    subtitulo_banner,
    descricao_banner,
    texto_botao_banner,
    link_botao_banner,
    ordem_banner,
    foto_banner,
    status_banner
)
VALUES
(1,
 'home-vitrine',
 'Confeitaria saudável com sabor de verdade',
 'Bolos, doces e kits especiais para momentos que merecem carinho',
 'A The Gusta une apresentação, leveza e praticidade em uma experiência artesanal pensada para quem quer comer bem sem abrir mão do sabor.',
 'Ver cardápio',
 '/cardapio',
 1,
 'banner/home-vitrine-the-gusta.png',
 'ATIVO'),

(2,
 'home-encomenda',
 'Encomendas especiais para celebrar com mais leveza',
 'Pedidos feitos com cuidado para aniversários, presentes e datas especiais',
 'Organize seu pedido com mais praticidade e encontre opções que combinam com o seu momento.',
 'Fazer pedido',
 '/pedidos',
 2,
 'banner/home-encomendas-the-gusta.png',
 'ATIVO'),

(3,
 'home-cafe',
 'Seu café da tarde pode ser ainda mais especial',
 'Combinações perfeitas entre bolos, doces e bebidas',
 'Uma vitrine pensada para encantar no visual, no sabor e na experiência.',
 'Entrar em contato',
 '/contato',
 3,
 'banner/home-cafe-the-gusta.png',
 'ATIVO');

-- =====================================================
-- 4) PRODUTOS
-- =====================================================

INSERT INTO tbl_produtos
(
    id_produto,
    nome_produto,
    id_categoria,
    descricao_produto,
    tamanho_produto,
    unid_med_produto,
    valor_produto,
    foto_produto,
    status_produto,
    destaque_produto,
    ordem_produto
)
VALUES
(1, 'Bolo Banana Fit', 1, 'Fatia de bolo de banana com canela, textura macia e preparo artesanal.', 'Médio', 'FT', 14.90, 'produto/bolo-banana-fit.png', 'ATIVO', 'SIM', 1),
(2, 'Bolo Cacau Fit', 1, 'Fatia de bolo de cacau com cobertura leve e sabor marcante.', 'Médio', 'FT', 15.90, 'produto/bolo-cacau-fit.png', 'ATIVO', 'SIM', 2),
(3, 'Mini Bolo Cenoura', 1, 'Mini bolo de cenoura com cobertura de chocolate e apresentação delicada.', 'Pequeno', 'UN', 18.90, 'produto/mini-bolo-cenoura.png', 'ATIVO', 'NAO', 3),

(4, 'Brownie Fit', 2, 'Brownie artesanal com textura macia e uma proposta mais equilibrada.', 'Pequeno', 'UN', 8.90, 'produto/brownie-fit.png', 'ATIVO', 'SIM', 4),
(5, 'Brigadeiro Fit', 2, 'Brigadeiro especial com sabor intenso e porção individual.', 'Pequeno', 'UN', 4.50, 'produto/brigadeiro-fit.png', 'ATIVO', 'NAO', 5),
(6, 'Caixa 4 Doces Fit', 2, 'Caixa com 4 doces variados para presentear ou experimentar.', 'Pequeno', 'CX', 24.90, 'produto/caixa-4-doces-fit.png', 'ATIVO', 'SIM', 6),

(7, 'Torta Limão Fit', 3, 'Fatia de torta de limão com leveza, frescor e cremosidade.', 'Médio', 'FT', 16.50, 'produto/torta-limao-fit.png', 'ATIVO', 'SIM', 7),
(8, 'Cheesecake Fit', 3, 'Cheesecake com frutas vermelhas e apresentação elegante para vitrine.', 'Grande', 'UN', 18.90, 'produto/cheesecake-fit.png', 'ATIVO', 'NAO', 8),

(9, 'Cafe Expresso', 4, 'Café expresso encorpado para acompanhar doces e bolos.', 'Pequeno', 'ML', 6.50, 'produto/cafe-expresso.png', 'ATIVO', 'NAO', 9),
(10, 'Cappuccino Cremoso', 4, 'Cappuccino cremoso com toque especial da casa.', 'Grande', 'ML', 11.90, 'produto/cappuccino-cremoso.png', 'ATIVO', 'SIM', 10),

(11, 'Kit Presente Fit', 5, 'Kit com mini bolo e doces selecionados para presentear com charme.', 'Grande', 'UN', 54.90, 'produto/kit-presente-fit.png', 'ATIVO', 'SIM', 11),
(12, 'Kit Cafe Saudavel', 5, 'Kit com bebida e doces especiais para uma experiência acolhedora.', 'Grande', 'UN', 59.90, 'produto/kit-cafe-saudavel.png', 'ATIVO', 'NAO', 12);

COMMIT;