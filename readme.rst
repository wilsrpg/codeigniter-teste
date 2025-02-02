Aplicação web de gerenciamento de blog, desenvolvida com o intuito de aprender e praticar o framework CodeIgniter.

Playlist do tutorial: `https://www.youtube.com/playlist?list=PLh89M5lS1CIDetqylMQsXxCHbjk5XDegC <https://www.youtube.com/playlist?list=PLh89M5lS1CIDetqylMQsXxCHbjk5XDegC>`_

Para testar localmente, é necessário um servidor PHP instalado e executando na máquina. Após clonar o repositório na pasta ``htdocs`` do servidor, é necessário renomear o arquivo ``.env.example`` para ``.env`` e adicionar uma string de conexão com um banco de dados MongoDB à variável de ambiente ``DB_CONN``. Feito isso, execute o comando:

.. code-block::

 composer install

Em seguida, basta acessar a página do projeto (por padrão, `localhost/codeigniter-teste/ <http://localhost/codeigniter-teste/>`_; entre com quaisquer credenciais)