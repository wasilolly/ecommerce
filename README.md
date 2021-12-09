<h1>E-commerce </h1>
<ul>
    <li>CRUD resources on Products and Categories</li>
    <li>Front end and Metadata setting</li>
<li>Users can download order receipt</li>
    <li>Admin dashboard to summarize sales</li>
 </ul>
 
<div class="snippet-clipboard-content position-relative overflow-auto" data-snippet-clipboard-copy-content="git clone https://github.com/wasilolly/ecommerce.git
composer install
cp .env.example .env
">
<pre><code>git clone https://github.com/wasilolly/ecommerce.git
composer install
cp .env.example .env
</code></pre>
</div>
<p>Then create the necessary database.</p>
<div class="snippet-clipboard-content position-relative overflow-auto" data-snippet-clipboard-copy-content="php artisan db
create database ecommerce
">
<pre>
<code>php artisan db
create database ecommerce
</code>
</pre>
</div>
<p>And run the initial migrations and seeders.</p>
<div class="snippet-clipboard-content position-relative overflow-auto" data-snippet-clipboard-copy-content="php artisan migrate --seed
">
<pre><code>php artisan migrate --seed
</code></pre>
</div>
