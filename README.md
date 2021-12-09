# teste_seventh

#Instalação e inicialização do Backend
- Ferramentas utilizadas:
  - php 8.0.12
  - composer 2.1.12
  - SqLite

- Extensoes utilizadas no php.ini
  - extension=curl
  - extension=fileinfo
  - extension=mbstring
  - extension=openssl
  - extension=pdo_sqlite
  
- Abrir o diretório Backend que se encontra no diretório raiz
- Renomear o arquivo .env.example para .env
- Abrir o terminal dentro do diretorio Backend encontrado no diretório raiz e executar os seguinte comandos:

  - composer install
  - php artisan key:generate
  - php artisan migrate:fresh --seed
  
- Para subir o servidor com a porta 8001 que foi previamente configurada no frontend execute o seguinte comando:
  
  - php artisan serve --port 8001
  
#Instalação e inicialização do Frontend
- Ferramentas utilizadas:
  - Vue 3
  - VueCli -4 

- Abrir o diretório Frontend que se encontra no diretório raiz
- Abrir o terminal dentro do diretorio Backend encontrado no diretório raiz e executar o seguinte comando:

  - npm install
  
- Para subir o servidor com a porta 8002 eu criei um arquivo de configuração entao basta executar:
  
  - npm run serve

- Usuarios de teste:
  - admin@seventh.com  123adm456
  - client@seventh.com 123cli456   
