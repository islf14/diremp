## DIRECTORIO DE EMPRESAS

En el presente proyecto se usa:

- Laravel.
- Vite.
- React.
- Bootstrap

Para correr el proyecto:

- Instalar dependencias de Laravel:

```bash
composer install
```

- Instalar dependencias de Node:

```bash
npm install
```

- Correr el proyecto:

```bash
php artisan serve
npm run dev
```

Para acceder al proyecto, abrir el navegador y dirigirse a la siguiente URL:

```
http://localhost:8000
```

Para pasar a producción, se debe compilar los assets de Vite:

```bash
npm run build
```

Para correr el proyecto con docker, se debe tener instalado docker y docker-compose. Luego, se debe correr el siguiente comando:

```bash
docker-compose up -d
```
