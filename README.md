# Gerenciador-de-Estabelecimentos
Teste realizado num processo de seleção da empresa FortBrasil

# FRONT-END em VueJS
digite cd manages_establishments

    npm install && npm run dev

--------------------------------------------------------------

# API - PHP / Laravel
digite cd test_api_fortbrasil

Instalar os pacotes composer

    composer install && npm run dev

Copie o arquivo env de exemplo e faça as alterações de configuração necessárias no arquivo .env

    cp .env.example .env

Gerar uma nova chave da aplicação

    php artisan key:generate

Criar as Tabelas

    php artisan:migrate

Iniciar o Servidor

    php artisan serve

