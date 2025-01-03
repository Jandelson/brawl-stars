# Brawl Stars (br)

Você conhece o jogo Brawlstars?

Se não conhece fica a dica:

https://supercell.com/en/games/brawlstars/

Projeto:

* São utilizadas duas apis uma oficial e una não oficial
* Api não oficial https://api.brawlapi.com/v1/

* Api official: https://developer.brawlstars.com/#/ (Criar sua conta de developer)
* informar sua chave da api official no arquivo .env

TOKEN_API_BRAWLSTAR=

Iniciar o projeto em seu ambiente local

Depois de realizado o clone do projeto, com docker ou podman instalado.

podman-compose up -d

http://localhost:8000

Conheça os personagens do jogo Brawl Stars

https://brawlstarsbr.herokuapp.com/

![image](https://user-images.githubusercontent.com/1526849/159144528-30e0ea46-2de0-4ed6-8bbd-bc84906b0e74.png)

# Google Gemini

https://ai.google.dev/gemini-api/docs?hl=pt-br

Arquivo .env

GEMINI_API_KEY=

LANGUAGE_IA=pt-br

```
podman exec -it brawlworld /bin/bash

php artisan queue:work --tries=3 --delay=60
```

Ao carregar a página a primeira vez, os dados serão baixados das apis
E um job vai analisar os dados das descrições, chamar o a api do google gemini traduzir o texto e armazenar no banco de dados mysql

No controller os dados do banco de dados são levados para a pagina index que faz referencia ao id do personagem e mostra a descrição traduzida pela IA que foi armanzenada no banco de dados.

* Mudando a linguagem no env LANGUAGE_IA= podemos traduzir os textos para outra linguagem usando a IA.

* Após mudar a linguagem rodar os comandos:
```
podman exec -it brawlworld /bin/bash

 rm -r storage/app/braws.json

php artisan queue:restart

php artisan queue:work --tries=3 --delay=60
```

Recarregar a página.

