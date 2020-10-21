<p><strong>Instala&ccedil;&atilde;o:</strong></p>
<p>1 - Fa&ccedil;a o download do arquivo, rode o servidor php e o mysql em sua m&aacute;quina.</p>
<p>2 - Rode o comando <em>composer install&nbsp;</em>para gerar as depend&ecirc;ncias do projeto, via composer.</p>
<p>3 - Crie um banco de dados em seu SGBD com o nome de sua preferência</p>
<p>4 - Por padr&atilde;o, o git ignora o arquivo de configura&ccedil;&atilde;o do laravel (.env) por motivos de seguran&ccedil;a. Copie o conte&uacute;do do arquivo <em>.env.example</em> para um arquivo chamado <em>.env </em>e altere a informa&ccedil;&atilde;o de DB_DATABASE para <em>nome de sua preferência</em>. Certifique-se que suas propriedades est&atilde;o conforme o arquivo .env original:</p>
<p>DB_CONNECTION=mysql<br />DB_HOST=127.0.0.1<br />DB_PORT=3306<br />DB_DATABASE=<em>nome de sua preferência</em><br />DB_USERNAME=root<br />DB_PASSWORD=</p>
<p>5 - Ap&oacute;s configurar o <em>.env</em>, seu arquivo estar&aacute; com algumas informa&ccedil;&otilde;es pendentes, tamb&eacute;m por quest&otilde;es de seguran&ccedil;a. Portanto:</p>
<p>- rode o comando&nbsp;<em>php artisan key:generate&nbsp;</em>para gerar a sua APP_KEY</p>
<p>- rode o comando&nbsp;<em>php artisan jwt:secret&nbsp;</em>para gerar o seu&nbsp;JWT_SECRET (chave do JWT em sua m&aacute;quina).</p>
<p>6 - No seu terminal, na pasta do projeto, rode o comando&nbsp;<em>php artisan migrate --seed</em>&nbsp;para criar as tabelas do sistema em seu banco de dados e popul&aacute;-las com as seeds do projeto.</p>
<p>- Por padr&atilde;o, o projeto ir&aacute; gerar 1 usu&aacute;rio cujo login &eacute;: '&nbsp;<em>adm@admin.com&nbsp;</em>' e senha: '&nbsp;<em>senha@123&nbsp;</em>'. Ir&aacute; gerar tamb&eacute;m 10 produtos fict&iacute;cios neste usu&aacute;rio.</p>
<p>7 - Suba o servidor, via apache ou Laravel CLI com o comando&nbsp;<em>php artisan serve</em>.</p>
<p>8 - Pronto, a API est&aacute; rodando. Certifique-se do local em que est&aacute; rodando, pois &eacute; por este endere&ccedil;o que ir&aacute; acessar seus recursos.</p>
<p>---</p>
<p><strong>Endpoints:</strong></p>
<p>/<br />api/auth/login<br />api/auth/logout<br />api/auth/me<br />api/auth/refresh<br />api/auth/users<br />api/product/create<br />api/product/delete/{id}<br />api/product/show/{id}<br />api/product/teste<br />api/product/update/{id}<br />api/user/create<br />api/user/delete<br />api/user/show<br />api/user/update</p>
