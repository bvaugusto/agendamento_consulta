Passo a passo para configurar a aplicação no servidor local

1 - Descompactar o arquivo agendamento.rar dentro da pasta www/ ou htdocs/ do seu servidor web.

2 - Em seu banco de dados execute o "Execute o SQL Script", vá até a pasta pasta agendamento\script\agendamento.sql para realizar a importanção do banco de dados.

3 - A configuração do banco de dados está padrão localhost '127.0.0.1' usuário root e senha em branco.
Para configurar o canco em seu SGDB basta editar o arquivo agendamento\application\config\database.php e configurar as variáveis;
$db['default']['hostname'] = 'localhost';

$db['default']['username'] = 'root';

$db['default']['password'] = '';

$db['default']['database'] = 'agendamento';

Lembrando que o banco utilizado é o 'mysql'.
