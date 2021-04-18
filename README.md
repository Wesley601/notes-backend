# NOTES BACKEND

## Como iniciar
---
- instale o symfony cli
- instale as dependências com um **composer install**
- no projeto rode o comando **bin/console doctrine:database:create** para criar um banco sqlite no projeto
- com o banco criado rode o comando **bin/console doctrine:migrations:migrate** para criar as entidades no banco
- rode o comando **symfony serve --no-tls** para obter um servidor de testes na porta 8000
---

## Rotas

|   Name          |   Method|   Scheme|   Host|   Path                    |
| ----------------| --------| --------| ------| --------------------------|
| _preview_error  | ANY     | ANY     | ANY   | /_error/{code}.{_format}  |
| note_index      | GET     | ANY     | ANY   | /notes/                   |
| note_show       | GET     | ANY     | ANY   | /notes/{id}               |
| note_store      | POST    | ANY     | ANY   | /notes/                   |
| note_update     | PUT     | ANY     | ANY   | /notes/{id}               |
| note_delete     | DELETE  | ANY     | ANY   | /notes/{id}               |
