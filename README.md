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
http://localhost/AniversarianteController.php -> Exibe os aniversariantes cadastrados por mês, permitindo a navegação mês a mês
Para utilização no Joomla, qualquer versão, pode ser adicionado via <iframe style="border:0" src="http://localhost/AniversarianteController.php"></iframe> 

http://localhost/AniversarianteController.php?action=admin -> Acesso a página de administração para importação da planilha do SiCaPEx

# Considerações
Futuramente este módulo será integrado ao sistema SCC, onde será administrado exclusivamente por usuários das Relações Públicas
