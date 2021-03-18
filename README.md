# api-php-puro 
#### Optei por usar o padrão DAO

## Configurações necessárias para executar o programa

### Alterar as configurações no arquivo de config

#### Deixei o banco de dados na raiz do projeto

# endpoints

POST suabase/api/insert.php create user
PUT suabase/api/update?id= update user
DELETE suabase/api/delete?id= delete user
GET suabase/api/user?id= read user

GET suabase/api/states pega todos os estados
GET suabase/api/states?id= pega um unico estado

GET suabase/api/cities pega todas as cidades
GET suabase/api/cities?id= pega uma unica cidade

GET suabase/api/adresses pega todos os endereços
GET suabase/api/adresses?id= pega um unico endereço

GET suabase/api/users-per-city pega os usuários por cidade
GET suabase/api/users-per-state pega os usuários por estado
