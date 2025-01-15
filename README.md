# :pokedex: **pokedex-api**

**Api em Laravel para atender um front de pokedex para brincar**

Ahh mas você vai fazer mais uma api de pokemon?  
**sim**, porque? **porque eu quero.**

## :rocket: **Inicializando o Projeto**

Para inicializar o host sem ter que digitar `http://localhost:80/`, siga os passos abaixo:

1. Vá para `/etc/hosts` e adicione `127.0.0.1 pokedex-api.local`.  
   (Assim fica um pouco mais digno de se usar essa API dentro de outro projeto local).
   
2. Dentro da pasta do projeto, execute:

   ```bash
   docker-compose up -d

3. Altere as permissões do diretório storage para garantir que o Laravel consiga gravar arquivos:

```bash
chmod -R 777 storage
```

:computer: Configuração do Docker e Composer

```bash
docker exec -it laravel-app bash

composer install

php artisan key:generate
```

