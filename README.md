# CRUD MVC com PHP e PDO

#### Versão 1.0 
![N|Solid](https://raw.githubusercontent.com/mfabiodias/php-pdo-crud/master/view/images/layout/upsert-products.png)
<br />
![N|Solid](https://raw.githubusercontent.com/mfabiodias/php-pdo-crud/master/view/images/layout/list-products.png)
  - Requer PHP >= 7 e MySQL >= 5.6;
  - Contemplam as quatro operações básicas (CREATE, READ, UPDATE, DELETE);
  - Utilizado padrão MVC para criação do CRUD;
  - Utilizado Bootstrap 4 para Front-End;
  - Nenhum Framework foi utilizado para criação do Back-End;
  - Utilizado MySQL como base de dados;

<br />Ver sistema em funcionamento no Heroku: <br />

[https://php-pdo-crud-mysql.herokuapp.com/](https://php-pdo-crud-mysql.herokuapp.com)<br />

#### Passos para criação do banco de dados;
  - Crie o Schema/Database;
  - Defina o Schema/Database como padrão;
  - Crie a tabela;
  - Crie as triggers (Responsável por gerar o valor com desconto em cada Insert/Update);
  - Opcional: Crie usuário e senha para acesso ao crud;

<br />

#### Configuração do arquivo conexão do banco de dados (config.php)
  - Defina o drive. (MySQL, PostgreSQL e etc.);
  - Defina usuário;
  - Defina senha;
  - Defina base de dados;