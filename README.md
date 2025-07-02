<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

  <h1>📄 Sistema de Processos Digitais</h1>

  <p>Este projeto é uma aplicação Laravel com Blade e Bootstrap que permite o cadastro, aprovação e gerenciamento de processos, com envio automático de e-mails para signatários e registro de histórico de alterações.</p>

  <h2>🚀 Tecnologias Utilizadas</h2>
  <ul>
    <li>PHP 8.3 (via Docker)</li>
    <li>Laravel 10.x</li>
    <li>MySQL</li>
    <li>Blade + Bootstrap</li>
    <li>Docker e Docker Compose</li>
    <li>Laravel Sanctum (autenticação)</li>
    <li>Laravel Queue (com driver database)</li>
    <li>SMTP para envio de e-mails</li>
    <li>NPM (para assets estáticos)</li>
  </ul>

  <h2>📦 Pré-requisitos</h2>
  <ul>
    <li>Docker e Docker Compose instalados</li>
    <li>Node.js e NPM</li>
  </ul>

  <h2>⚙️ Passos para rodar o projeto</h2>
  <ol>
    <li>Clone o repositório:
      <pre><code>git clone https://github.com/andre-albuquerque01/challenge-ideatech.git</code></pre>
    </li>
    <li>Copie o arquivo de ambiente:
      <pre><code>cp .env.example .env</code></pre>
    </li>
    <li>Gere a chave da aplicação:
      <pre><code>./vendor/bin/sail artisan key:generate</code></pre>
    </li>
    <li>Instala os pacotes:
      <pre><code>composer install</code></pre>
    </li>
    <li>Suba os containers:
      <pre><code>./vendor/bin/sail up -d</code></pre>
    </li>
    <li>Instale as dependências JS:
      <pre><code>npm install</code></pre>
    </li>
    <li>Compile os assets:
      <pre><code>npm run dev</code></pre>
    </li>
    <li>Execute as migrations:
      <pre><code>./vendor/bin/sail artisan migrate</code></pre>
    </li>
    <li>Crie o link simbólico para acesso ao storage:
      <pre><code>./vendor/bin/sail artisan storage:link</code></pre>
    </li>
  </ol>

  <h2>📧 Configuração de E-mail</h2>
  <p>Você precisa configurar as seguintes variáveis no arquivo <code>.env</code> para envio de e-mails:</p>
  <pre><code>
MAIL_MAILER=smtp
MAIL_HOST=smtp.exemplo.com
MAIL_PORT=587
MAIL_USERNAME=seu_usuario
MAIL_PASSWORD=sua_senha
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu@email.com
MAIL_FROM_NAME="Nome do Remetente"
  </code></pre>

  <h3>📤 Envio de E-mails para Signatários</h3>
  <p>Ao cadastrar um novo processo, todos os signatários cadastrados recebem um e-mail com link para <strong>aprovar</strong> ou <strong>reprovar</strong> o processo.</p>

  <h2>⚙️ Variáveis de ambiente adicionais</h2>
  <p>Certifique-se de incluir as variáveis personalizadas no final do seu <code>.env</code>:</p>
  <pre><code>
TOKEN_NAME=processo-token
PATH_PROCESS=http://localhost
  </code></pre>

  <h2>📨 Execução de Filas</h2>
  <ol>
    <li>Configure o driver de fila no <code>.env</code>:
      <pre><code>QUEUE_CONNECTION=database</code></pre>
    </li>
    <li>Gere a tabela de jobs:
      <pre><code>./vendor/bin/sail artisan queue:table
./vendor/bin/sail artisan migrate</code></pre>
    </li>
    <li>Rode o worker da fila:
      <pre><code>./vendor/bin/sail artisan queue:work</code></pre>
    </li>
  </ol>

  <h2>🔐 Autenticação</h2>
  <p>O sistema utiliza <strong>Laravel Sanctum</strong> para autenticação. As rotas protegidas requerem login com email e senha via Blade.</p>

  <h2>📁 Estrutura do Projeto</h2>
  <ul>
    <li><code>resources/views</code>: Views Blade com Bootstrap</li>
    <li><code>app/Services</code>: Lógica de negócios</li>
    <li><code>app/Jobs</code>: Jobs assíncronos</li>
    <li><code>app/Mail</code>: Mails para envio</li>
  </ul>
