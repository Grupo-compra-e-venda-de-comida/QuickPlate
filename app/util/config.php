<?php

#Nome do arquivo: config.php
#Objetivo: define constantes para serem utilizadas no projeto

//Banco de dados: conexão MySQL
define('DB_HOST', 'localhost');
define('DB_NAME', 'quick_plate');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

//Caminho para adionar imagens, scripts e chamar páginas no sistema
//Deve ter o nome da pasta do projeto no servidor APACHE
define('BASEURL', '/codigos/QuickPlate6.0/app');

//Nome do sistema
define('APP_NAME', 'QuickPlate');

//Página inicial do sistema
define('HOME_PAGE', BASEURL . '/controller/homeController.php?action=home');

//Página de logout do sistema
define('LOGIN_PAGE', BASEURL . '/controller/loginController.php?action=login');

//Página de login do sistema
define('LOGOUT_PAGE', BASEURL . '/controller/loginController.php?action=logout');

//Sessão do usuário
define('SESSAO_USUARIO_ID', "usuarioLogadoId");
define('SESSAO_USUARIO_NOME', "usuarioLogadoNome");
define('SESSAO_USUARIO_TIPO', "usuarioLogadoTipo");