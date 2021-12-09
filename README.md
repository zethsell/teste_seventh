# teste_seventh

#Instalação e inicialização do Backend
- Abrir o diretório Backend que se encontra no diretório raiz
- Renomear o arquivo .env.example para .env
- Abrir o terminal dentro do diretorio Backend encontrado no diretório raiz e executar os seguinte comandos:

  - composer install
  - php artisan key:generate
  - php artisan migrate:fresh --seed
  
- Para subir o servidor com a porta 8001 que foi previamente configurada no frontend execute o seguinte comando:
  
  - php artisan serve --port 8001
  
#Instalação e inicialização do Frontend
- Abrir o diretório Frontend que se encontra no diretório raiz
- Abrir o terminal dentro do diretorio Backend encontrado no diretório raiz e executar o seguinte comando:

  - npm install
  
- Para subir o servidor com a porta 8001 que foi previamente configurada no frontend execute o seguinte comando:
  
  - npm run serve
