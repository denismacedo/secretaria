# Projeto Secretaria

Para desenvolvimento desse projeto precisamos ter instalado o Docker e o Docker Composer.

Antes de iniciar precisamos de uma cópia do banco de dados no formato SQL, que deverá ser colocada na pasta `mysql/initial_data`.

Para iniciar os servidores vamos executar dentro da pasta principal o seguinte comando:

```
docker-compose up
```

Isso irá executar os 03 serviços:

Um servidor apache com o Sistema da Secretaria

```
http://localhost:8080/
```

Um servidor Nginx com o PhpMyAdmin

```
http://localhost:8000/
```

E o banco de dados MySQL que estará disponivel na porta 3306, contendo a base criada a partir do script colocado na pasta `mysql\initial_data`.

