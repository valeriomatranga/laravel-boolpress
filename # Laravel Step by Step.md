# Laravel Step by Step

## [FASE 1] Installazione Framework, autenticazione e creazione db

Installiamo il Framework tramite composer

```bash
mkdir my-laravel-project
cd my-laravel-project
composer create-project --prefer-dist laravel/laravel:^7.0 .
```

### [GIT] Initial Commit

Facciamo un commit iniziale della repo con il Framework appena installato

```bash
git init
git add .
git commit -m"Initial Commit"
```

### Avviamo il server di Laravel

visualizziamo la pagina di welcome di laravel

```bash
php artisan serve
```

### Installiamo Laravel UI e lo scaffolding per l'autenticazione

Seguiamo la [Documentazione](https://laravel.com/docs/7.x/frontend) ed Installiamo lo scaffolding

```bash

composer require laravel/ui:^2.4
php artisan ui bootstrap --auth
// Istalliamo le dipendenze con npm e compiliamo gli assets
npm install
npm run dev
```


Ora lo scaffolding di autenticazione é istallato e possiamo registrare un utente e loggarlo ma prima dobbiamo creare e collegare il database ed eseguire le migrazioni.

### Creaiamo un database da riga di comando

eseguire il comando mysql per accedere alla riga di comando SQL

```bash
mysql -uroot -p
```

Per utenti windows la password é root mentre per mac é vuota (quindi premi enter).

#### Crea il db ed esci

```mysql
CREATE DATABASE database_name_here;
exit;
```

### Collegare il database

Compiliamo il file .env con i dettagli del database

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=inserisci_la_porta_del_db_qui(default 3306)
DB_DATABASE=inserisci_il_nome_del_db_qui
DB_USERNAME=inserisci_il_nome_dell_utente_mysql(solitamente root)
DB_PASSWORD=inserisci_la_password(root per windows, lascia vuoto su Mac)

```

### Effettuiamo la migration

Ora migrare le tabelle di default create da laravel.

```bash
php artisan migrate
```

### [GIT] Commit del progetto con autenticazione

```bash
git add . 
git commit -m"Install laravel ui and compile assets"
```

## [FASE 2] Riorganizziamo la pagina del backoffice

In questa fase creaiamo un gruppo di rotte per il back office e modifichiamo il controller che lo gestisce.

### Definiamo le rotte

definiamo un gruppo di rotte per il backoffice nel file `routes/web.php` assegnando a tutte le rotte un prefisso, nome, namespace ed un middleware

```php
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    // Definire qui le rotte per il back office
});
```

### Modifichiamo la rotta home e aggiungiamola al gruppo admin

La rotta definita da laravel `home` ci viene mostrata quando l'utente effettua il login. Modifichiamola ed usiamola come rotta principale del gruppo `admin`.

```php
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
});
```

### [GIT] Facciamo un commit del gruppo di rotte creato

### Spostiamo l'HomeController nel namespace Admin/

```bash
cd app/Http/Controllers/
mkdir Admin
mv HomeController.php Admin/HomeController.php
```

ora modifichiamo il namespace del controller, importiamo la classe Controller e cancelliamo il constructor perche? La middleware l'abbiamo giá applicata a tutte le rotte del gruppo admin.

Questo é il controller in Admin/HomeController.php

```php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; // Importa la classe Controller
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
```

Poiché abbiamo cambiato il namespace alla classe, l'autoloader deve essere cancellato e ricreato.

```bash
composer dump-autoload
```

### Effettuiamo una registrazione di prova

Registriamo un utente tramite il form all'indirizzo
localhost:8000/register

#### SQL Error?

Prova a riavviare artisan serve

#### 404 ?

Abbiamo spostato la rotta `/home` e chiamata `admin/`
Modifichiamo il file routeServiceProvider in `app/Providers`.

La riga 24 ora diventa cosi:

```php
public const HOME = '/admin';
```

### [GIT] Facciamo un commit

Committa le modifiche sull' HomeController e al RouteServiceProvider

## [FASE 3] I Layouts

Ora organizziamo i layouts per il backoffice.

### Definiamo i layouts per il guest e l'admin

Iniziamo duplicando il file layouts/app.blade.php e chiamiamolo admin.blade.php, questa sará la base per tutte le pagine del backoffice.

la view `home.blade.php` ora estenderá il layout `admin.blade.php`.

Rielaborare il design aggiungendo in layouts/admin una griglia con sidebar
ed eliminando la colonna con il container dalla view home lasciando solo la card.

Esempio sezione `main` file admin.blade.php

```html

<main class="py-4 d-flex">
  <div class="container">
      <div class="row">
          <div class="col-sm-3">
                <aside>
                  <ul class="nav flex-column">
                          <li class="nav-item nav-pills">
                              <a class="nav-link {{Route::currentRouteName() === 'admin.dashboard' ? 'active' : ''}}" href="{{route('admin.dashboard')}}">Dashboard</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Posts</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Users</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Categories</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#">Tags</a>
                          </li>
                      </ul>
              </aside>
          </div>
          <div class="col-sm-9">
              @yield('content')
          </div>
          
      </div>
  </div>       
</main>
```

### [GIT] Suddivisione Layouts di base

## [FASE 4] Implementiamo il CRUD lato ADMIN

In questa fase creaiamo le rotte, modelli, migrazioni, controllers e views per l'utente autenticato.

### Creiamo le rotte di tipo resources per i posts ed il controller

Nel file web.php

```php
Route::middleware('auth')->namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('posts', PostController::class); // <-- Rotta resources per i posts
});
```

### MODEL, MIGRATION, SEEDER, CONTROLLER

Creare il modello, la migrazione con il seeder ed il controller di tipo resource
nel namespace Admin.

```bash
php artisan make:model -ms Post
php artisan make:controller -r --model=Post Admin/PostController
```

### Prepariamo la migrazione ed il seeder

Migrazione in `...create_posts_table.php`

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('image');
    $table->string('title');
    $table->text('body');
    $table->timestamps();
});

```

Seeder in `...PostSeeeder.php`

```php
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Post;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 15; $i++) { 
            $post = new Post();
            $post->title = $faker->sentence(3);
            $post->image = $faker->imageUrl(640, 300, 'Posts', true, $post->title);
            $post->body = $faker->text();
            $post->save();
        }
    }
}

```

Aggiunta del seeder al seeder principale

```php
$this->call([PostSeeder::class]);
```

### Migrazione e seeding

```php
php artisan migrate --seed
```

### [GIT] Commit della struttura Model, Controller, Migration e Seeder

### Implementazione cRud Admin metodo index e show

Implementiamo una tabella per l'admin dove vedere tutti i posts
in Admin/PostController.php

```php
public function index()
{
    $posts = Post::all()->sortByDesc('id');
    return view('admin.posts.index', compact('post'));
}
```

Crea la view in views/admin/posts/index.blade.php con la tabella, e le azioni per 
la visualizzazione, modifica e cancellazione dei posts.

```html

@extends('layouts.admin')

@section('content')

<h1>All posts</h1>
<table class="table table-striped table-inverse table-responsive">
  <thead class="thead-inverse">
    <tr>
      <th>ID</th>
      <th>IMAGE</th>
      <th>TITLE</th>
      <th>ACTIONS</th>
    </tr>
    </thead>
    <tbody>
    
     @foreach($posts as $post)
       <tr>
        <td scope="row">{{$post->id}}</td>
        <td> <img width="100" src="{{$post->image}}" alt="{{$post->title}}"> </td>
        <td> {{$post->title}} </td>
        <td> 
          <a href="{{route('admin.posts.show', $post->id)}}">
            <i class="fas fa-eye fa-sm fa-fw"></i> View 
          </a>
          <a href="{{ route('admin.posts.edit', $post->id)}}">
            <i class="fas fa-pencil-alt fa-sm fa-fw"></i> Edit 
          </a>
          <a href="#">
            <i class="fas fa-trash fa-sm fa-fw"></i> Delete
          </a>
        </td>
      </tr>
     @endforeach
    </tbody>
</table>
@endsection
```

### [GIT] commit

### Implementa metodo show nel Admin/PostController e crea la view

```php
  public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }
```

Crea una view in admin/posts/show.blade.php

```html
@extends('layouts.admin')

@section('content')

<img src="{{$post->image}}" alt="">
<h1>{{$post->title}}</h1>
<p>{{$post->body}}</p>

<a href="{{route('admin.posts.index')}}"><i class="fas fa-arrow-left fa-sm fa-fw"></i> Back</a>
<a href="{{route('admin.posts.edit', $post->id)}}">Edit</a>


@endsection
```

### [GIT] commit

Esegui un commit del lavoro a questo punto

### Implementa Crud metodi Create e Store con validazione

Implement the create metod in the Admin/PostController

```php
 public function create()
    {
        return view('admin.posts.create');
    }
```

Create a view

```html
@extends('layouts.admin')

@section('content')

<h1>Create a new post</h1>

<form action="{{route('admin.posts.store')}}" method="post">
  <!-- Token non lo scordare altrimenti error! -->
  @csrf
<div class="form-group">
  <label for="title">Title</label>
  <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelperr" placeholder="Add a title" value="{{old('title')}}">
  <small id="titleHelperr" class="form-text text-muted">Type a title for the post, max 255 characters</small>
</div>  

<div class="form-group">
  <label for="image">Cover Image</label>
  <input type="text" class="form-control" name="image" id="image" aria-describedby="imageHelperr" placeholder="Add an image" value="{{old('image')}}">
  <small id="imageHelperr" class="form-text text-muted">Type a image url for the post, max 255 characters</small>
</div>  

<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" name="body" id="body" rows="5"> {{ old('body')}}</textarea>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection

```

### [GIT] Commit your work

### Implement store method con validazione

```php
  public function store(Request $request)
    {
        //ddd($request->all());

        $validatedData = $request->validate([
            'title' => 'required | max:255 | min:5',
            'body' => 'required', // poteva essere nullable se impostato cosi in migration.
            'image' => 'required'
        ]);
        Post::create($validatedData);
        return redirect()->back();
    }
```

### Impementa messaggi di errore validazione 
nella view create o in un parziale

```html
@if($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
```

### Add Fillable properties in the Post model

inside app\Post.php

```php
   protected $fillable = ['title', 'body', 'image'];
```

### [GIT] commit your work

### Implement the edit and update methods

Implement the edit method

```php
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }
```

Duplicate and edit the create.blade.php form

```html
@extends('layouts.admin')

@section('content')

<h1>Edit post</h1>
@if($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<form action="{{route('admin.posts.update', $post->id)}}" method="post">
  @csrf
 @method('PUT')
<div class="form-group">
  <label for="title">Title</label>
  <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelperr" placeholder="Add a title" value="{{$post->title}}">
  <small id="titleHelperr" class="form-text text-muted">Type a title for the post, max 255 characters</small>
</div>  

<div class="form-group">
  <label for="image">Cover Image</label>
  <input type="text" class="form-control" name="image" id="image" aria-describedby="imageHelperr" placeholder="Add an image" value="{{$post->image}}">
  <small id="imageHelperr" class="form-text text-muted">Type a image url for the post, max 255 characters</small>
</div>  

<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" name="body" id="body" rows="5"> {{ $post->body}}</textarea>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
```

Implement the controller update method and validate data

```php
public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required | max:255 | min:5',
            'body' => 'required', // poteva essere nullable se impostato cosi in migration.
            'image' => 'required'
        ]);
        $post->update($validatedData);
        return redirect()->route('admin.posts.index');
    }

```

### [GIT] Commit you work

### Implement the cruD delete method

Implement the destroy method

```php
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index');

    }
```

add a delete form

```php
 <form action="{{route('admin.posts.destroy', $post->id)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger"><i class="fas fa-trash fa-xs fa-fw"></i></button>
  </form>

```

## [GIT] Commit your work

## [FASE-5] Ora Implementa la parte front per l'utente.

### Le rotte

```php
/* Altre Pagine non connesse ad un entitá/modello  */
Route::get('/', 'PageController@index');
Route::get('about', 'PageController@about');
Route::get('contacts', 'PageController@contacts');

/* Posts per l'utente */
Route::get('posts', 'PostController@index')->name('posts.index');
Route::get('posts/{post}', 'PostController@show')->name('posts.show');

```

### Crea i controllers

```bash
php artisan make:controller -m Post PostController
php artisan make:controller PageController
```

### Implementa i metodi per i posts

```php
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        
        return view('guests.posts.index', compact('posts'));
    }

   
    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('guest.posts.show', compact('post'));
    }
```

### Implementa le views per i guests

in guests/posts/index.blade.php

```html
@extends('layouts.app')


@section('content')

<div class="container">
  <div class="row">

    @foreach($posts as $post)
    
    <div class="post col-md-4">
      <a href="{{ route('posts.show', $post->id) }}">
        <img src="{{$post->image}}" class="img-fluid" alt="">
      </a>
      <h1> {{$post->title}}</h1>  
    </div>
    @endforeach

  </div>
  {{$posts->links()}}
</div>


@endsection

```

In guests/posts/show.blade.php

```html
@extends('layouts.app')


@section('content')


<div class="container">
  <img src="{{$post->image}}" alt="">

<h1>

  {{$post->title}}
</h1>

</div>

@endsection
```

## [GIT] commit your work
