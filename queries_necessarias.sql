CREATE DATABASE bd_usuarios;

use bd_usuarios;

CREATE TABLE tb_usuarios(
    id int not null PRIMARY KEY AUTO_INCREMENT,
    nome varchar(100) not null,
    email varchar(100) not null,
    senha varchar(255) not null
);

/* Usuários para testes */
/* gerado em https://www.generatedata.com/ */

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Yoshio","cursus.Integer@seddui.net",md5("consequat")),("Lila","sagittis.Nullam.vitae@luctus.net",md5("vehicula")),("Mark","est.tempor@pedeCumsociis.com",md5("tempor"));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Oren","eget.venenatis.a@lacusCrasinterdum.org",md5("aliquet")),("Clark","neque.Morbi@sitamet.com",md5("pharetra.")),("Ignacia","non.lobortis.quis@egestas.ca",md5("turpis."));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Nasim","nulla.at@lorem.co.uk",md5("laoreet,")),("Salvador","turpis@quamafelis.edu",md5("vitae,")),("Kyla","mollis.non.cursus@tinciduntnunc.co.uk",md5("a"));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Hunter","dui@vitaealiquameros.com",md5("neque")),("Colorado","nulla.Cras.eu@vulputateduinec.edu",md5("molestie")),("Sylvester","dolor.dolor@acipsumPhasellus.org",md5("auctor"));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Dennis","nascetur.ridiculus.mus@pharetra.org",md5("tincidunt")),("Norman","est.vitae.sodales@atortor.net",md5("sit")),("Isabella","faucibus.lectus@ipsumporta.net",md5("lectus"));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Maile","lacus.Aliquam@augueSedmolestie.co.uk",md5("Proin")),("Jin","per.inceptos.hymenaeos@ligulaconsectetuer.org",md5("lacinia")),("Leo","Pellentesque.ultricies@ut.net",md5("et"));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Lynn","ultrices.Vivamus@egestasa.ca",md5("non")),("Mallory","risus.varius@ultrices.co.uk",md5("litora")),("Kimberley","ipsum.Suspendisse@magna.co.uk",md5("dui."));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Gemma","Praesent.eu.nulla@sitamet.org",md5("ut")),("Lavinia","et@maurissagittisplacerat.org",md5("amet,")),("Ria","sed@Pellentesqueultricies.net",md5("lorem"));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Illiana","in.dolor.Fusce@orciluctuset.ca",md5("augue")),("Slade","sagittis@molestiesodales.net",md5("bibendum")),("Shad","fringilla.mi.lacinia@atvelitPellentesque.ca",md5("lacinia."));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Lee","in.aliquet@dignissim.ca",md5("non")),("Chloe","nostra.per@mus.ca",md5("nibh")),("Kelsie","imperdiet.ullamcorper.Duis@dolor.org",md5("Mauris"));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Cedric","libero.dui.nec@Integermollis.org",md5("aliquet")),("Anthony","sit.amet@diameudolor.com",md5("ut,")),("Nissim","metus@InfaucibusMorbi.edu",md5("metus."));

INSERT INTO tb_usuarios (nome,email,senha) VALUES ("Howard","Fusce.fermentum@pedeac.co.uk",md5("Curabitur")),("Octavius","adipiscing.Mauris.molestie@vitae.com",md5("metus.")),("Mannix","sit.amet.consectetuer@mollisnec.co.uk",md5("mauris."));