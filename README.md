# Aniversariantes
Módulo PHP para utilização em Joomla (qualquer versão) nas Intranet do Exército Brasileiro importando planilha gerada pelo SiCaPEx

# Banco de dados
Crie um usuário para o banco de dados:

CREATE USER 'aniversariantes'@'localhost' IDENTIFIED BY 'senha';

GRANT ALL PRIVILEGES ON aniversariantes . * TO 'aniversariantes'@'localhost';

FLUSH PRIVILEGES;

Crie o arquivo aniversariantes.ini para conexão ao banco de dados com os seguintes dados:

[database]

servername = localhost

username = aniversariantes

password = senha

dbname = aniversariantes

Crie o banco de dados executando o script Aniversariantes/Projeto/BD/Aniversariantes.sql

# Sistema
Mova o diretório Aniversariantes/ que está dentro de Fonte PHP/ para o servidor web que irá executar a aplicação

# Como executar o sistema?
http://localhost/Aniversariantes/Controller/AniversarianteController.php -> Exibe os aniversariantes cadastrados por mês, permitindo a navegação mês a mês
Para utilização no Joomla, qualquer versão, pode ser adicionado via iframe, por exemplo:

<iframe width="100%" height="1024px" style="border: 0; margin: 0; padding: 0;" src="http://localhost/Aniversariantes/Controller/AniversarianteController.php" sandbox="" scrolling="no"></iframe> 


http://localhost/Aniversariantes/Controller/AniversarianteController.php?action=admin -> Acesso a página de administração para importação da planilha do SiCaPEx

# Considerações
Futuramente este módulo será integrado ao sistema SCC, onde será administrado exclusivamente por usuários das Relações Públicas
